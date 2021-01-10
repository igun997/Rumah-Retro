<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::namespace("Store")->name("store.")->group(function (){
    Route::get("/","Landing@index")->name("landing");
});
Route::get("/login","Auth@index")->name("login");
Route::get("/template",function (){
    return view("template.jadwal");
});
Route::post("/login","Auth@login")->name("login.post");
Route::get("/logout","Auth@logout")->name("logout");


Route::get("/dashboard","Dashboard@index")->middleware("gateway:0|1|2|3|4|5")->name("dashboard");
//Admin

Route::prefix("master")->name("master.")->namespace("Master")->group(function(){
    Route::prefix("suplier")->name("suplier.")->group(function (){
        Route::get("/","Suplier@index")->name("list");
        Route::get("/add","Suplier@add")->name("add");
        Route::get("/update/{id}","Suplier@update")->name("update");
        Route::get("/delete/{id}","Suplier@delete")->name("delete");
        Route::post("/update/{id}","Suplier@update_action")->name("update_action");
        Route::post("/add","Suplier@add_action")->name("add_action");
    });

    Route::prefix("size")->name("size.")->group(function (){
        Route::get("/","Sizes@index")->name("list");
        Route::get("/add","Sizes@add")->name("add");
        Route::get("/update/{id}","Sizes@update")->name("update");
        Route::get("/delete/{id}","Sizes@delete")->name("delete");
        Route::post("/update/{id}","Sizes@update_action")->name("update_action");
        Route::post("/add","Sizes@add_action")->name("add_action");
    });

    Route::prefix("material")->name("material.")->group(function (){
        Route::get("/","Material@index")->name("list");
        Route::get("/add","Material@add")->name("add");
        Route::get("/update/{id}","Material@update")->name("update");
        Route::get("/delete/{id}","Material@delete")->name("delete");
        Route::post("/update/{id}","Material@update_action")->name("update_action");
        Route::post("/add","Material@add_action")->name("add_action");
    });


    Route::prefix("produk")->name("product.")->group(function (){
        Route::get("/","Product@index")->name("list");
        Route::get("/add","Product@add")->name("add");
        Route::get("/update/{id}","Product@update")->name("update");
        Route::get("/delete/{id}","Product@delete")->name("delete");
        Route::post("/update/{id}","Product@update_action")->name("update_action");
        Route::post("/add","Product@add_action")->name("add_action");

        Route::get("/add/{id}/material","Product@add_material")->name("add_material");
        Route::get("/delete/material/{id}","Product@delete_material")->name("delete_material");
        Route::get("/update/{id}/material/{id_second}","Product@update_material")->name("update_material");
        Route::post("/add/{id}/material","Product@add_material_action")->name("add_material_action");
        Route::post("/update/{id}/material/{id_second}","Product@update_material_action")->name("update_material_action");

    });

    Route::prefix("akun")->name("account.")->group(function (){
        Route::get("/","Account@index")->name("list");
        Route::get("/add","Account@add")->name("add");
        Route::get("/update/{id}","Account@update")->name("update");
        Route::get("/delete/{id}","Account@delete")->name("delete");
        Route::post("/update/{id}","Account@update_action")->name("update_action");
        Route::post("/add","Account@add_action")->name("add_action");
    });
});

Route::prefix("pemesanan")->name("pemesanan.")->group(function (){
    Route::get("/","Pemesanan@index")->name("list");
    Route::get("/add","Pemesanan@add")->name("add");
    Route::post("/add_action","Pemesanan@add_action")->name("add_action");
    Route::get("/material/{id}","Pemesanan@material")->name("material");
    Route::post("/material/{id}","Pemesanan@material_action")->name("material_action");
    Route::get("/material/{id}/delete/{ids}","Pemesanan@material_delete")->name("material_delete");
    Route::get("/detail/{id}","Pemesanan@detail")->name("detail");
    Route::get("/cancel/{id}","Pemesanan@cancel")->name("cancel");
    Route::get("/proses/{id}","Pemesanan@proses")->name("proses");
    Route::get("/sending/{id}","Pemesanan@sending")->name("sending");
    Route::get("/done/{id}","Pemesanan@done")->name("done");
});


