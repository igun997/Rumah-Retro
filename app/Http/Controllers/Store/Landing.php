<?php

namespace App\Http\Controllers\Store;

use App\Casts\LevelAccount;
use App\Casts\OrderStatus;
use App\Casts\ProductionStatus;
use App\Casts\StatusAccount;
use App\Casts\TypeStatus;
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
        $title = "Selamat Datang Di Tukang Ikan";
        $products = Product::where(["ready_to_sell"=>1])->get();
        return $this->loadView("landing",compact("title","products"));
    }

    public function about()
    {
        $title = "Tukang Ikan - About Us";
        $products = Product::all();
        return $this->loadView("about",compact("title","products"));
    }

    public function contact()
    {
        $title = "Tukang Ikan - Contact Us";
        $products = Product::all();
        return $this->loadView("contact",compact("title","products"));
    }
    public function product()
    {
        $title = "Tukang Ikan - Produk Kami";
        $products = Product::all();
        return $this->loadView("product",compact("title","products"));
    }
    public function detail_product($id)
    {
        $title = "Tukang Ikan - Produk Kami";
        $data = Product::where('id',$id)->first();
        // return $data;
        return $this->loadView("detail_product",compact("title","data"));
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
            "total"=>$req->total,
            "notes"=>$notes,
            "type"=>TypeStatus::ONLINE,
            "additional_price"=>$additional_price,
            "status"=>OrderStatus::WAITING_PAYMENT,
        ]);
        if ($create_order) {
            $order_id = $create_order->id;
            $failed = false;
            foreach ($myCart as $index => $item) {
                $min = Product::find($item->id);
                if ($item->quantity >= $min->min_order){
                    $itemOrder = OrderItem::create([
                        "order_id" => $order_id,
                        "product_id" => $item->id,
                        "qty" => $item->quantity,
                        "price" => $item->price,
                    ]);
                    if (!$itemOrder) {
                        $failed = true;
                    }
                }else{
                    $failed = true;
                    $create_order->delete();
                    return back()->withErrors(['msg'=>"Minimal Order Produk $min->name Adalah ".$min->min_order." Pcs"]);
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
        $cart = [];
        if (session()->get("id") !== null){
            $cart = Cart::session(session()->get("id"))->getContent();

        }
        return $this->loadView("detail",compact("title","cart"));
    }

    public function cart_action(Request $req,$id)
    {
        if (session()->get("id") === null){
            return  $this->failBack(false);
        }
        $product = Product::findOrFail($id);
        if ($req->min_order){
            $qty = $req->min_order;
        }else{
            $qty =1;
        }
        $cart = Cart::session(session()->get("id"))->add([
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $qty,
            'attributes' => [

            ],
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

    public function checkout(Request $req,$id)
    {
        $req->validate([
            "name"=>""
        ]);
    }

}
