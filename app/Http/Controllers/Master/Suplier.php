<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Traits\ViewTrait;
use App\Models\Suplier as SuplierModel;
use Illuminate\Http\Request;

class Suplier extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "master.suplier";
        $this->middleware("gateway:0");
    }

    public function index()
    {
        $data = SuplierModel::all();
        $title = "Data Suplier";
        return $this->loadView("index",compact("title","data"));
    }

    public function add()
    {
        $title = "Tambah Suplier";
        $route = route("master.suplier.add_action");
        return $this->loadView("form",compact("title","route"));
    }

    public function update($id)
    {
        $title = "Ubah Suplier";
        $route = route("master.suplier.update_action",$id);
        $data = SuplierModel::where(["id"=>$id]);
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

        $create = SuplierModel::create($req->all());
        if ($create){
            return $this->successRedirect("master.suplier.list");
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

        $create = SuplierModel::where(["id"=>$id])->update($req->all());
        if ($create){
            return $this->successRedirect("master.suplier.list");
        }
        return  $this->failBack();
    }

    public function delete($id)
    {
        SuplierModel::find($id)->delete();
        return $this->successBack();
    }
}
