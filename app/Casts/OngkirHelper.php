<?php

namespace App\Casts;
use \Steevenz\Rajaongkir;

class OngkirHelper
{
    private static function init()
    {
        return new Rajaongkir(env("RAKIR"), Rajaongkir::ACCOUNT_PRO);
    }

    public static function cek_ongkir($city_id=501,$subdistrict=574,$berat=40)
    {
        $ongkir = self::init()->getCost(['city' => $city_id], ['subdistrict' => $subdistrict],
            [
                'length' => 50,
                'width'  => 50,
                'height' => 50,
                'weight' => $berat,
            ], 'jne');

        return $ongkir;
    }
}
