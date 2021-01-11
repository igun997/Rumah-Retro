<?php

namespace App\Http\Controllers;

use App\Casts\LevelAccount;
use App\Casts\OrderStatus;
use App\Casts\ProductionStatus;
use App\Casts\StatusAccount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductionMaterial;
use App\Models\User;
use App\Traits\ViewTrait;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;

class Penjualan extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "penjualan";
        $this->middleware("gateway:5");
    }

    public function index()
    {
        $title = "Penjualan Produk";
        $produk = Product::all();
        $history = Order::all();
        $current_cart = Cart::session(session()->get("id"))->getContent();
//        dd($current_cart->toArray());

        return $this->loadView("index",compact("title","produk","current_cart","history"));
    }

    public function cart_action(Request $req)
    {
        $req->validate([
            "product_id"=>"required",
            "qty"=>"required|numeric"
        ]);
        $produk = Product::findOrFail($req->product_id);
        Cart::session(session()->get("id"))->add([
            'id' => $req->product_id,
            'name' => $produk->name,
            'price' => $produk->price,
            'quantity' => $req->qty,
            'attributes' => array(),
            'associatedModel' => $produk
        ]);
        return $this->successBack();
    }

    public function cart_delete($id)
    {
        Cart::session(session()->get("id"))->remove($id);
        return $this->successBack();
    }

    public function cart_finish(Request $req)
    {
        $req->validate([
            "name"=>"required",
            "notes"=>"min:2",
            "alamat"=>"min:2",
            "additional_price"=>"numeric|nullable",
        ]);
        $cart = Cart::session(session()->get("id"));
        $myCart = $cart->getContent();
        if (empty($myCart)){
            return $this->failBack();
        }
        $crete_user = User::create(["name"=>$req->name,"alamat"=>$req->alamat,"status"=>StatusAccount::INACTIVE,"level"=>LevelAccount::PELANGGAN]);
        if ($crete_user){
            $user_id = $crete_user->id;
            $total = str_replace(",","",$cart->getTotal());
            $total += ($req->additional_price ?? 0);
            $notes = "";
            $additional_price = 0;
            if ($req->has("notes")){
                $notes = $req->notes;
            }
            if ($req->has("additional_price")){
                $additional_price = $req->additional_price;
            }
            $create_order = Order::create([
                "user_id"=>$user_id,
                "total"=>$total,
                "notes"=>$notes,
                "additional_price"=>$additional_price,
                "status"=>OrderStatus::PROCESSING,
            ]);
            if ($create_order){
                $order_id = $create_order->id;
                $failed = false;
                foreach ($myCart as $index => $item) {
                    $itemOrder = OrderItem::create([
                        "order_id"=>$order_id,
                        "product_id"=>$item->id,
                        "qty"=>$item->quantity,
                        "price"=>$item->price,
                    ]);
                    if (!$itemOrder){
                        $failed = true;
                    }
                }
                if (!$failed){
                    $cart->clear();
                    $create = Production::create(["name"=>$crete_user->name,"notes"=>$create_order->notes,"status"=>ProductionStatus::CREATED,"due_date"=>Carbon::now()->addDays(14)]);
                    if ($create){
                        $con = true;
                        foreach ($create_order->order_items as $index => $order_item) {
                            $create_item = ProductionMaterial::create(["production_id"=>$create->id,"qty"=>$order_item->qty,"product_id"=>$order_item->product_id]);
                            if (!$create_item){
                                $con = false;
                            }
                        }
                        if (!$con){
                            $create->delete();
                            return  $this->failBack(false);
                        }
                    }
                    return $this->successBack();
                }

            }else{
                $crete_user->delete();
            }
        }
        return  $this->failBack();
    }

    public function update_status(Request $req,$id)
    {
        $req->validate([
            "status"=>"required"
        ]);
        $order = Order::findOrFail($id);
        $order->status = $req->status;
        $order->save();
        if($req->status == OrderStatus::PROCESSING){
            $create = Production::create(["name"=>$order->user->name,"notes"=>$order->notes,"status"=>ProductionStatus::CREATED,"due_date"=>Carbon::now()->addDays(14)]);
            if ($create){
                $con = true;
                $biaya_produksi = 0;
                foreach ($order->order_items as $index => $order_item) {
                    $create_item = ProductionMaterial::create(["production_id"=>$create->id,"qty"=>$order_item->qty,"product_id"=>$order_item->product_id]);
                    if (!$create_item){
                        $con = false;
                    }
                    $p = Product::find($order_item->product_id);
                    $_p = 0;
                    foreach ($p->materials as $index => $product_material) {
                        $_p += ($product_material->pivot->qty * $product_material->price);
                    }
                    $biaya_produksi += ($_p * $order_item->qty);
                }
                if (!$con){
                    $create->delete();
                    $order->status = OrderStatus::CONFIRMED;
                    $order->save();
                    return  $this->failBack(false);
                }
                $create->total = $biaya_produksi;
                $create->save();
            }
        }
        return $this->successBack(false);
    }

    public function detail($id)
    {
        $order = Order::findOrFail($id);
        $title = "Detail Pesanan";
        return $this->loadView("detail",compact("title","order"));
    }
}
