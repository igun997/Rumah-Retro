<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class StatusAccount implements CastsAttributes
{
    CONST INACTIVE = 0;
    CONST ACTIVE = 1;
    const DELETED = 2;

    public static function lang($level)
    {
        if ($level == StatusAccount::ACTIVE){
            return "Aktif";
        }elseif ($level == StatusAccount::INACTIVE){
            return "Tidak Aktif";
        }elseif ($level == StatusAccount::DELETED){
            return "Di Hapus";
        }else{
            return  FALSE;
        }
    }
}
