<?php

namespace App\Http\Controllers;

use App\Casts\LevelAccount;
use App\Casts\OrderStatus;
use App\Casts\StatusAccount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Traits\ViewTrait;
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
                    return $this->successBack();
                }

            }else{
                $crete_user->delete();
            }
        }
        return  $this->failBack();
    }
}
