<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Traits\ViewTrait;
use App\Models\Size as SizeModel;
use Illuminate\Http\Request;

class Sizes extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "master.size";
        $this->middleware("gateway:0|2");
    }

    public function index()
    {
        $data = SizeModel::all();
        $title = "Data Ukuran";
        return $this->loadView("index",compact("title","data"));
    }

    public function add()
    {
        $title = "Tambah Ukuran";
        $route = route("master.size.add_action");
        return $this->loadView("form",compact("title","route"));
    }

    public function update($id)
    {
        $title = "Ubah Ukuran";
        $route = route("master.size.update_action",$id);
        $data = SizeModel::where(["id"=>$id]);
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
        ]);

        $create = SizeModel::create($req->all());
        if ($create){
            return $this->successRedirect("master.size.list");
        }
        return  $this->failBack();
    }

    public function update_action(Request $req,$id)
    {
        $req->validate([
            "name"=>"required",
        ]);

        $create = SizeModel::where(["id"=>$id])->update($req->all());
        if ($create){
            return $this->successRedirect("master.size.list");
        }
        return  $this->failBack();
    }

    public function delete($id)
    {
        SizeModel::find($id)->delete();
        return $this->successBack();
    }
}
