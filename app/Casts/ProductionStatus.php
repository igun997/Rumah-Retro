<?php


namespace App\Casts;


class ProductionStatus
{
    const CREATED = 0;
    const CONFIRMED = 2;
    const PROCESSING = 3;
    const CANCELED = 4;
    const COMPLETED = 5;
    const CONFIRMED_BY_GUDANG = 6;

    public static function lang($level)
    {
        if ($level == self::CREATED){
            return "Dibuat";
        }elseif ($level == self::CONFIRMED){
            return "Di Konfirmasi Bag. Produksi";
        }elseif ($level == self::PROCESSING){
            return "Sedang Di Proses";
        }elseif ($level == self::CANCELED){
            return "Produksi Di Batalkan";
        }elseif ($level == self::COMPLETED){
            return "Produksi Telah Selesai";
        }elseif ($level == self::CONFIRMED_BY_GUDANG){
            return "Di Konfirmasi Gudang";
        }else{
            return  FALSE;
        }
    }

}
