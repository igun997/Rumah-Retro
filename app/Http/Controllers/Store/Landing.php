<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\ViewTrait;
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
            'quantity' => $req->qty
        ]);
        return $this->successBack(false);
    }
    public function cart_delete($id)
    {
        $cart = Cart::session(session()->get("id"))->remove($id);
        return $this->successBack(false);
    }
}
