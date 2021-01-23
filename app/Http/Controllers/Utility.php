<?php

namespace App\Http\Controllers;

use App\Casts\LevelAccount;
use App\Casts\OngkirHelper;
use App\Models\Handler;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use Igun997\Utility\Excel;
use Illuminate\Http\Request;
use PDF;

class Utility extends Controller
{

    public function getProvinsi($id=null)
    {
        return response()->json(["code"=>200,"data"=>OngkirHelper::getProvinsi($id)]);
    }
    public function getKota($id=null)
    {
        return response()->json(["code"=>200,"data"=>OngkirHelper::getKota($id)]);
    }
    public function getKecamatan($id=null)
    {
        return response()->json(["code"=>200,"data"=>OngkirHelper::getKecamatan($id)]);
    }

    public function cek_ongkir(Request $req)
    {
        $req->validate([
            "dest"=>"numeric|required",
            "berat"=>"numeric|required",
            "expedisi"=>"required",
        ]);
        return response()->json(["code"=>200,"data"=>OngkirHelper::cek_ongkir($req->dest,$req->berat,$req->expedisi)]);
    }
}
