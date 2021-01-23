<?php

namespace App\Casts;
use \Steevenz\Rajaongkir;

class OngkirHelper
{
    private static function init()
    {
        return new Rajaongkir(env("RAKIR"), Rajaongkir::ACCOUNT_PRO);
    }

    /**
     * Cek Ongkos Kirim
     * @param int $city_id
     * @param int $subdistrict
     * @param int $berat
     * @return array|bool
     */
    public static function cek_ongkir($dest=574,$berat=40,$expedisi="jne",$origin=344)
    {
        $ongkir = self::init()->getCost(['subdistrict' => $origin], ['subdistrict' => $dest],
            [
                'length' => 50,
                'width'  => 50,
                'height' => 50,
                'weight' => $berat,
            ], $expedisi);

        return $ongkir;
    }

    /**
     * Get Provinsi
     * @param null $id
     * @return array|bool
     */
    public static function getProvinsi($id=null)
    {
        return self::init()->getProvinces($id);
    }

    /**
     * Get Kota
     * @param null $id
     * @return array|bool
     */
    public static function getKota($id=null)
    {
        return self::init()->getCities($id);
    }

    /**
     * Get Kecamatan
     * @param null $id
     * @return array|bool
     */
    public static function getKecamatan($id=null)
    {
        return self::init()->getSubdistricts($id);
    }


}
