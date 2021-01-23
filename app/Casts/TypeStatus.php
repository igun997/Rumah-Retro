<?php


namespace App\Casts;


class TypeStatus
{
    const OFFLINE = 0;
    const ONLINE = 1;

    public static function lang($level)
    {
        if ($level == self::OFFLINE){
            return "Transaksi Offline";
        }elseif ($level == self::ONLINE){
            return "Transaksi Online";
        }else{
            return  FALSE;
        }
    }

}
