<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;

class AlamatControl extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->middleware("gateway:1|2|3|4|5");
        $this->base = "alamat";
    }

    public function index()
    {
        $find = User::findOrFail(session()->get("id"));
        $data = [
            "title"=>"Alamat Pengiriman",
            "info"=>$find
        ];
        return $this->loadView("index",$data);
    }

    public function add_action(Request $req)
    {
        $find = User::findOrFail(session()->get("id"));
        $find->alamat = $req->alamat;
        $find->alamat2 = $req->alamat2;
        if ($find->save()){
            return $this->successBack(false);
        }
        return $this->failBack(false);
    }
}

