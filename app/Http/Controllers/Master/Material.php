<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Traits\ViewTrait;
use App\Models\Material as MaterialModel;
use Illuminate\Http\Request;

class Material extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "master.material";
        $this->middleware("gateway:0");
    }

    public function index()
    {
        $data = MaterialModel::all();
        $title = "Data Bahan Baku";
        return $this->loadView("index",compact("title","data"));
    }

    public function add()
    {
        $title = "Tambah Bahan Baku";
        $route = route("master.material.add_action");
        return $this->loadView("form",compact("title","route"));
    }

    public function update($id)
    {
        $title = "Ubah Bahan Baku";
        $route = route("master.material.update_action",$id);
        $data = MaterialModel::where(["id"=>$id]);
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
            "img"=>"required|mimes:jpg,png,gif",
        ]);
        $data = $req->all();
        if ($req->has("img")){
            $newFile = md5($req->file("img")->getFilename().rand(10,99)).".".$req->file("img")->getClientOriginalExtension();
            $data["img"] = $req->file("img")->storePubliclyAs("public/product",$newFile);
            $data["img"] = str_replace("public/",url("storage")."/",$data["img"]);
        }
        $create = MaterialModel::create($data);
        if ($create){
            return $this->successRedirect("master.material.list");
        }
        return  $this->failBack();
    }

    public function update_action(Request $req,$id)
    {
        $req->validate([
            "name"=>"required",
            "img"=>"mimes:jpg,png,gif",
        ]);
        $data = $req->all();
        if ($req->has("img")){
            $newFile = md5($req->file("img")->getFilename().rand(10,99)).".".$req->file("img")->getClientOriginalExtension();
            $data["img"] = $req->file("img")->storePubliclyAs("public/product",$newFile);
            $data["img"] = str_replace("public/",url("storage")."/",$data["img"]);
        }else{
            unset($data["img"]);
        }
        $create = MaterialModel::where(["id"=>$id])->update($data);
        if ($create){
            return $this->successRedirect("master.material.list");
        }
        return  $this->failBack();
    }

    public function delete($id)
    {
        MaterialModel::find($id)->delete();
        return $this->successBack();
    }
}
