<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Traits\ViewTrait;
use App\Models\Suplier as SuplierModel;
use Illuminate\Http\Request;

class Rekening extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "master.rekening";
        $this->middleware("gateway:0|2");
    }

    public function index()
    {
        $data = \App\Models\Rekening::first();
        $title = "Data Rekening";
        if (isset($data->id)){
            $route = route("master.rekening.update",$data->id);
        }else{
            $route = route("master.rekening.add");
        }
        return $this->loadView("index",compact("title","data","route"));
    }

    public function update_action(Request $req,$id)
    {
        $find = \App\Models\Rekening::findOrFail($id);
        if ($find->update($req->all())){
            return $this->successBack();
        }
        return $this->failBack();
    }

    public function add(Request $req)
    {
        \App\Models\Rekening::firstOrCreate($req->all());
        return back();
    }
}
