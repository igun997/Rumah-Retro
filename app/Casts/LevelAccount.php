<?php

namespace App\Casts;


class LevelAccount
{
    const  ADMIN = 0;
    const  PEMILIK = 1;
    const  GUDANG = 2;
    const  PRODUKSI = 3;
    const  PELANGGAN = 4;


    public static function lang($level)
    {
        if ($level == LevelAccount::ADMIN){
            return "Admninistrator";
        }elseif ($level == LevelAccount::PEMILIK){
            return "Pemilik";
        }elseif ($level == LevelAccount::GUDANG){
            return "Gudang";
        }elseif ($level == LevelAccount::PRODUKSI){
            return "Produksi";
        }elseif ($level == LevelAccount::PELANGGAN){
            return "Pelanggan";
        }else{
            return  FALSE;
        }
    }

    public static function redirect()
    {
        return route("dashboard");
    }

}
