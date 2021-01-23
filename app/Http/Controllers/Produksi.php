<?php

namespace App\Http\Controllers;

use App\Casts\LevelAccount;
use App\Casts\ProductionStatus;
use App\Models\Material;
use App\Models\Production;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;

class Produksi extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "produksi";
        $this->middleware("gateway:".LevelAccount::PRODUKSI."|".LevelAccount::GUDANG);
    }

    public function index()
    {
        $title = "Produksi";
        $produksi = Production::all();
        return $this->loadView("index",compact("title","produksi"));
    }

    public function detail($id)
    {
        $title = "Detail Produksi";
        $production = Production::findOrFail($id);
        return $this->loadView("detail",compact("title","production"));
    }

    public function update_status(Request $req,$id)
    {
        $req->validate([
            "status"=>"required"
        ]);

        $produksi = Production::find($id);
        $produksi->status = $req->status;
        $produksi->save();
        if (ProductionStatus::PROCESSING == $req->status){
            //Material Decrease
            foreach ($produksi->production_materials as $index => $production_material) {
                foreach ($production_material->product->materials as $index => $material) {
                    $m = Material::find($material->id);
                    $m->stok = ($m->stok - ($material->pivot->qty*$production_material->qty));
                    $m->save();
                }
            }
        }
        return $this->successBack();
    }
}
