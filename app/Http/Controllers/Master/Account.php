<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;
use App\Models\User;
class Account extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "master.account";
        $this->middleware("gateway:0");
    }

    public function index()
    {
        $data = User::all();
        $title = "Data Akun";
        return $this->loadView("index",compact("title","data"));
    }

    public function add()
    {
        $title = "Tambah Akun";
        $route = route("master.account.add_action");
        return $this->loadView("form",compact("title","route"));
    }

    public function update($id)
    {
        $title = "Ubah Akun";
        $route = route("master.account.update_action",$id);
        $data = User::where(["id"=>$id]);
        if ($data->count() === 0){
            return $this->failBack();
        }
        $data = $data->first();
        return $this->loadView("form",compact("title","route","data"));
    }

    public function add_action(Request  $req)
    {
        $req->validate([
            "name"=>"required",
            "alamat"=>"required",
            "no_hp"=>"required",
        ]);

        $create = User::create($req->all());
        if ($create){
            return $this->successRedirect("master.account.list");
        }
        return  $this->failBack();
    }

    public function update_action(Request $req,$id)
    {
        $req->validate([
            "name"=>"required",
            "alamat"=>"required",
            "no_hp"=>"required",
        ]);

        $create = User::where(["id"=>$id])->update($req->all());
        if ($create){
            return $this->successRedirect("master.account.list");
        }
        return  $this->failBack();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return $this->successBack();
    }
}
