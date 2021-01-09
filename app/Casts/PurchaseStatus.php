<?php


namespace App\Casts;


class PurchaseStatus
{
    const CREATED = 0;
    const CONFIRMED = 1;
    const PROCESSING = 2;
    const SHIPPING = 3;
    const COMPLETED = 4;
    const CANCELED = 5;

    public static function lang($level)
    {
        if ($level == self::CREATED){
            return "Dibuat";
        }elseif ($level == self::CONFIRMED){
            return "Pengadaan Di Konfirmasi Pemilik";
        }elseif ($level == self::PROCESSING){
            return "Sedang Di Proses";
        }elseif ($level == self::SHIPPING){
            return "Sedang Dikirimkan";
        }elseif ($level == self::COMPLETED){
            return "Pengadaan Selesai";
        }elseif ($level == self::CANCELED){
            return "Pengadaan Dibatalkan";
        }else{
            return  FALSE;
        }
    }

}
