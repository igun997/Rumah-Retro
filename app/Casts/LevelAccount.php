<?php

namespace App\Casts;


class LevelAccount
{
    const  ADMIN = 0;
    const  PEMILIK = 1;
    const  GUDANG = 2;
    const  PRODUKSI = 3;
    const  PELANGGAN = 4;
    const  KASIR = 5;


    public static function lang($level)
    {
        if ($level == LevelAccount::ADMIN){
            return "Admninistrator";
        }elseif ($level == LevelAccount::PEMILIK){
            return "Pemilik";
        }elseif ($level == LevelAccount::GUDANG){
            return "Gudang";
        }elseif ($level == LevelAccount::PELANGGAN){
            return "Pelanggan";
        }elseif ($level == LevelAccount::KASIR){
            return "Kasir";
        }else{
            return  FALSE;
        }
    }

    public static function redirect()
    {
        return route("dashboard");
    }

}
