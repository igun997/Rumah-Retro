<?php

namespace App\Http\Controllers;

use App\Casts\LevelAccount;
use App\Models\Order;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class OrdersPelanggan extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->middleware("gateway:".LevelAccount::PELANGGAN);
        $this->base = "orders";
    }

    public function index()
    {
        $title = "History Pemesanan";
        $history = Order::where(["user_id"=>session()->get("id")])->get();
        return $this->loadView("index",compact("title","history"));
    }

    public function upload(Request $req,$id)
    {
        $req->validate([
            "file"=>"mimes:jpg,jpeg,png,gif,pdf"
        ]);
        $order = Order::findOrFail($id);
        if ($req->has("file")){
            $newFile = md5($req->file("file")->getFilename().rand(10,99)).".".$req->file("file")->getClientOriginalExtension();
            $order->bukti = $req->file("file")->storePubliclyAs("public/bukti",$newFile);
            $order->bukti = str_replace("public/",url("storage")."/",$order->bukti);
        }
        if ($order->save()){
            return $this->successBack(false);
        }
        return $this->failBack(false);
    }
}
