<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;

class Landing extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "store";
    }

    public function index()
    {
        return $this->loadView("landing");
    }
}
