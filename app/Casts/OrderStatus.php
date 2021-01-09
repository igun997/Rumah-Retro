<?php


namespace App\Casts;


class OrderStatus
{
    const WAITING_PAYMENT = 0;
    const CONFIRMED = 2;
    const PROCESSING = 3;
    const SHIPPING = 4;
    const COMPLETED = 5;
    const CANCELED = 6;

    public static function lang($level)
    {
        if ($level == self::WAITING_PAYMENT){
            return "Menunggu Pembayaran";
        }elseif ($level == self::CONFIRMED){
            return "Pembayaran Di Konfirmasi";
        }elseif ($level == self::PROCESSING){
            return "Sedang Di Proses";
        }elseif ($level == self::SHIPPING){
            return "Sedang Dikirimkan";
        }elseif ($level == self::COMPLETED){
            return "Pesanan Selesai";
        }elseif ($level == self::CANCELED){
            return "Pesanan Dibatalkan";
        }else{
            return  FALSE;
        }
    }

}
