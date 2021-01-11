<?php

namespace App\Http\Controllers\Store;

use App\Casts\LevelAccount;
use App\Casts\OrderStatus;
use App\Casts\ProductionStatus;
use App\Casts\StatusAccount;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductionMaterial;
use App\Models\User;
use App\Traits\ViewTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;
class Landing extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "store";
    }

    public function index()
    {
        $title = "Selamat Datang Di Rumah Retro";
        $products = Product::all();
        return $this->loadView("landing",compact("title","products"));
    }

    public function cart_finish(Request $req)
    {
        $cart = Cart::session(session()->get("id"));
        $myCart = $cart->getContent();
        if (empty($myCart)){
            return $this->failBack();
        }
        $user_id = session()->get("id");
        $instance = User::find($user_id);
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
            "status"=>OrderStatus::WAITING_PAYMENT,
        ]);
        if ($create_order) {
            $order_id = $create_order->id;
            $failed = false;
            foreach ($myCart as $index => $item) {
                $itemOrder = OrderItem::create([
                    "order_id" => $order_id,
                    "product_id" => $item->id,
                    "qty" => $item->quantity,
                    "price" => $item->price,
                ]);
                if (!$itemOrder) {
                    $failed = true;
                }
            }
            if (!$failed) {
                $cart->clear();
                return $this->successRedirect("orders.list");
            }
            return $this->failBack(false);
        }
        return $this->failBack(false);
    }
    public function cart()
    {
        $title = "Keranjang Belanja";
        $cart = Cart::session(session()->get("id"))->getContent();
        return $this->loadView("detail",compact("title","cart"));
    }

    public function cart_action($id)
    {
        if (session()->get("id") === null){
            return  $this->failBack(false);
        }
        $product = Product::findOrFail($id);
        $cart = Cart::session(session()->get("id"))->add([
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [],
            'associatedModel' => $product
        ]);
        return $this->successBack(false);
    }

    public function cart_update(Request $req,$id)
    {
        $req->validate([
            "qty"=>"numeric|min:1|required"
        ]);
        $cart = Cart::session(session()->get("id"))->update($id,[
            'quantity' => $req->qty -  Cart::session(session()->get("id"))->get($id)->quantity
        ]);
        return $this->successBack(false);
    }
    public function cart_delete($id)
    {
        $cart = Cart::session(session()->get("id"))->remove($id);
        return $this->successBack(false);
    }
}
