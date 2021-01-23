<?php

namespace App\Http\Controllers;

use App\Casts\PurchaseStatus;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\PurchaseMaterial;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;

class Pemesanan extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "pemesanan";
        $this->middleware("gateway:2|1");
    }

    public function index()
    {
        $title = "Pemesanan Bahan Baku";
        $data = Purchase::orderBy("id","desc")->get();
        return $this->loadView("index",compact("title","data"));
    }

    public function detail($id)
    {
        $data = Purchase::where(["id"=>$id]);
        if ($data->count() === 0){
            return $this->failBack(false);
        }
        $data = $data->first();
        $title = "Detail Pemesanan Bahan Baku";
        return $this->loadView("detail",compact("data","title","id"));
    }

    public function cancel($id)
    {
        Purchase::find($id)->update(["status"=>PurchaseStatus::CANCELED]);
        return $this->successBack(false);
    }

    public function proses($id)
    {
        Purchase::find($id)->update(["status"=>PurchaseStatus::PROCESSING]);
        return $this->successBack(false);
    }

    public function sending($id)
    {
        Purchase::find($id)->update(["status"=>PurchaseStatus::SHIPPING]);
        return $this->successBack(false);
    }
    public function confirm($id)
    {
        Purchase::find($id)->update(["status"=>PurchaseStatus::CONFIRMED]);
        return $this->successBack(false);
    }

    public function done($id)
    {
        Purchase::find($id)->update(["status"=>PurchaseStatus::COMPLETED]);
        $po = Purchase::where(["id"=>$id])->first();
        foreach ($po->materials as $index => $material) {
            $mat = Material::find($material->id);
            $mat->stok += $material->pivot->qty;
            $mat->save();
        }
        return $this->successBack(false);
    }

    public function add()
    {
        $title = "Tambah PO";
        $route = route("pemesanan.add_action");
        return $this->loadView("form",compact("title","route"));
    }

    public function add_action(Request  $req)
    {
        $req->validate([
            "tgl_po"=>"required"
        ]);

        $create = Purchase::create(["total"=>0,"po_date"=>$req->tgl_po,"notes"=>$req->notes,"status"=>PurchaseStatus::CREATED]);
        if ($create){
            return $this->successRedirect("pemesanan.material",true,[$create->id]);
        }
        return $this->failBack();
    }

    public function material($id)
    {
        $data = Purchase::where(["id"=>$id]);
        if ($data->count() === 0){
            return $this->failBack(false);
        }
        $data = $data->first();
        $title = "Tambahkan Bahan Baku";
        $route = route("pemesanan.material_action",$id);
        $data_material = \App\Models\Material::all();
        return $this->loadView("material",compact("data","title","route","data_material"));
    }

    public function material_action(Request $req,$id)
    {
        $req->validate([
            "material_id"=>"required",
            "qty"=>"required|min:1|numeric",
        ]);
        $material = Material::where(["id"=>$req->material_id])->first();
        $po = Purchase::find($id);
        $data = [
          "material_id"=>$req->material_id,
          "qty"=>$req->qty,
          "purchase_id"=>$id,
          "price"=>($material->price * $req->qty),
        ];

        $create = PurchaseMaterial::create($data);
        if ($create){
            $po->total += ($material->price * $req->qty);
            $po->save();
            return $this->successBack();
        }
        return $this->failBack();
    }

    public function material_delete($id,$ids)
    {
        PurchaseMaterial::where(["id"=>$ids])->delete();
        return $this->successBack(false);
    }
}
