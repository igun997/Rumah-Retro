<?php

namespace App\Http\Controllers;

use App\Casts\LevelAccount;
use App\Casts\ScheduleStatus;
use App\Casts\ScheduleType;
use App\Models\Schedule;
use App\Models\User;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "dashboard";
    }

    public function index()
    {

        $data = [
            "title"=>"Dashboard"
        ];
        return $this->loadView("home",$data);
    }
}
