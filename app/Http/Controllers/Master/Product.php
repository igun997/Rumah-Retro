<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Traits\ViewTrait;
use App\Models\Product as ProductModel;
use App\Models\ProductMaterial;
use Illuminate\Http\Request;

class Product extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "master.product";
        $this->middleware("gateway:0|2");
    }

    public function index()
    {
       $data = ProductModel::all();
        $title = "Data Produk";
        return $this->loadView("index",compact("title","data"));
    }
    public function index_material($id)
    {
        $product = ProductModel::where(["id"=>$id]);
        if ($product->count() === 0){
            return $this->failBack();
        }
        $data = ProductMaterial::where(["product_id"=>$id])->get();
        $title = "Data Material Produk ".$product->first()->name;
        return $this->loadView("index_material",compact("title","data"));
    }


    public function add()
    {
        $title = "Tambah Produk";
        $route = route("master.product.add_action");
        return $this->loadView("form",compact("title","route"));
    }

    public function add_material(Request $req,$id)
    {
        $product = ProductModel::where(["id"=>$id]);
        if ($product->count() === 0){
            return $this->failBack();
        }
        $data = ProductMaterial::where(["product_id"=>$id])->get();
        $data_material = \App\Models\Material::all();
        $title = "Tambah Material Produk ".$product->first()->name;
        $route = route("master.product.add_material",$id);
        $updated = null;
        if($req->has("comp")){
            $route = route("master.product.update_material_action",[$id,$req->comp]);
            $updated = ProductMaterial::where(["id"=>$req->comp]);
            if ($updated->count() === 0){
                return $this->failBack();
            }
            $updated = $updated->first();
        }
        return $this->loadView("form_material",compact("title","route","data","id","data_material","updated"));
    }

    public function add_material_action(Request $req,$id)
    {
        $req->validate([
            "material_id"=>"required",
            "qty"=>"required|numeric|min:1"
        ]);
        $material = \App\Models\Material::where(["id"=>$req->material_id]);
        if ($material->count() === 0){
            return $this->failBack();
        }
        $total_all = $material->first()->stok;
        $used = 0;
        $_a = ProductMaterial::where(["material_id"=>$req->material_id])->get();
        foreach ($_a as $index => $item) {
            $used += $item->qty;
        }
        $total_all = $total_all - $used;

        if($total_all < $req->qty){
            return $this->failBack();
        }

        $payload = [
            "material_id"=>$req->material_id,
            "qty"=>$req->qty,
            "product_id"=>$id,
        ];

        $create = ProductMaterial::create($payload);
        if ($create){
            return $this->successBack();
        }
        return $this->failBack();
    }

    public function update_material_action(Request $req,$id,$myId)
    {
        $req->validate([
            "material_id"=>"required",
            "qty"=>"required|numeric|min:1"
        ]);
        $obj = ProductMaterial::where(["id"=>$myId])->first();
        $material = \App\Models\Material::where(["id"=>$req->material_id]);
        if ($material->count() === 0){
            return $this->failBack();
        }
        $total_all = $material->first()->stok + ($obj->qty);
        $used = 0;
        $_a = ProductMaterial::where(["material_id"=>$req->material_id])->get();
        foreach ($_a as $index => $item) {
            $used += $item->qty;
        }
        $total_all = $total_all - $used;

        if($total_all < $req->qty){
            return $this->failBack();
        }

        $payload = [
            "material_id"=>$req->material_id,
            "qty"=>$req->qty,
            "product_id"=>$id,
        ];

        $create = ProductMaterial::where(["id"=>$myId])->update($payload);
        if ($create){
            return $this->successBack();
        }
        return $this->failBack();
    }
    public function update($id)
    {
        $title = "Ubah Produk";
        $route = route("master.product.update_action",$id);
        $data = ProductModel::where(["id"=>$id]);
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
            "img"=>"required|mimes:jpg,jpeg,png,gif",
        ]);
        $data = $req->all();
        if ($req->has("img")){
            $newFile = md5($req->file("img")->getFilename().rand(10,99)).".".$req->file("img")->getClientOriginalExtension();
            $data["img"] = $req->file("img")->storePubliclyAs("public/product",$newFile);
            $data["img"] = str_replace("public/",url("storage")."/",$data["img"]);
        }
        $create = ProductModel::create($data);
        if ($create){
            return $this->successRedirect("master.product.list");
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
        $create = ProductModel::where(["id"=>$id])->update($data);
        if ($create){
            return $this->successRedirect("master.product.list");
        }
        return  $this->failBack();
    }

    public function delete($id)
    {
        ProductModel::find($id)->delete();
        return $this->successBack();
    }
    public function delete_material($id)
    {
        ProductMaterial::find($id)->delete();
        return $this->successBack();
    }
}
