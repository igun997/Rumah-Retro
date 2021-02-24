<?php

namespace App\Http\Controllers;

use App\Casts\LevelAccount;
use App\Models\Material;
use App\Models\Order;
use App\Models\Production;
use App\Models\User;
use App\Traits\ViewTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanControl extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->middleware("gateway:1|2|3|4|5");
        $this->base = "laporan";
    }

    public function index()
    {
        $title = "Laporan";
        return $this->loadView("master_laporan",compact("title"));
    }

    public function generate(Request $req)
    {
        $req->validate([
            "type"=>"required",
            "start"=>"date|required",
            "end"=>"date|required",
        ]);
        $start = Carbon::createFromFormat("Y-m-d",$req->start);
        $end = Carbon::createFromFormat("Y-m-d",$req->end);

        switch ($req->type){
            case "penjualan":
                $d = [$start->format("Y-m-d"),$end->format("Y-m-d")];

                $data = Order::whereBetween("created_at",$d)->get();
                return $this->loadView("penjualan",compact("data","req"));
                break;
            case "bahan_baku":
                $d = [$start->format("Y-m-d"),$end->format("Y-m-d")];

                $data = Material::whereBetween("created_at",$d)->get();
                return $this->loadView("bahan_baku",compact("data","req"));
                break;
            case "pengguna":
                $d = [$start->format("Y-m-d"),$end->format("Y-m-d")];
                $data = User::where(["level"=>LevelAccount::PELANGGAN])->whereBetween("created_at",$d)->get();
                return $this->loadView("pengguna",compact("data","req"));
                break;
            case "produksi":
                $d = [$start->format("Y-m-d"),$end->format("Y-m-d")];
                $data = Production::whereBetween("created_at",$d)->get();
                return $this->loadView("produksi",compact("data","req"));
                break;
            default:
                return $this->failBack();
                break;
        }

    }

}
