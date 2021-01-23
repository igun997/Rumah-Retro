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
    Route::get("/about","Landing@about")->name("about");
    Route::get("/contact","Landing@contact")->name("contact");
    Route::get("/product","Landing@product")->name("product");
    Route::get("/detail_product/{id}","Landing@detail_product")->name("detail_product");

    Route::get("/cart","Landing@cart")->name("cart");
    Route::post("/cart/{id}","Landing@cart_action")->name("cart_action");
    Route::post("/cart_update/{id}","Landing@cart_update")->name("cart_update");
    Route::get("/cart_finish","Landing@cart_finish")->name("cart_finish");

    Route::get("/provinsi/{id?}","\App\Http\Controllers\Utility@getProvinsi")->name("provinsi");
    Route::get("/kota/{id?}","\App\Http\Controllers\Utility@getKota")->name("kota");
    Route::get("/kecamatan/{id?}","\App\Http\Controllers\Utility@getKecamatan")->name("kecamatan");
    Route::get("/cek_ongkir","\App\Http\Controllers\Utility@cek_ongkir")->name("cek_ongkir");
});
Route::get("/login","Auth@index")->name("login");
Route::get("/template",function (){
    return view("template.jadwal");
});
Route::post("/login","Auth@login")->name("login.post");
Route::post("/register","Auth@register_action")->name("register.post");
Route::get("/register","Auth@register")->name("register");
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
    Route::get("/confirm/{id}","Pemesanan@confirm")->name("confirm");
    Route::get("/sending/{id}","Pemesanan@sending")->name("sending");
    Route::get("/done/{id}","Pemesanan@done")->name("done");
});

Route::prefix("penjualan")->name("penjualan.")->group(function (){
    Route::get("/","Penjualan@index")->name("list");
    Route::post("/cart","Penjualan@cart_action")->name("cart_action");
    Route::get("/cart","Penjualan@cart")->name("cart");
    Route::get("/cart/delete/{id}","Penjualan@cart_delete")->name("cart_delete");
    Route::post("/cart/finished","Penjualan@cart_finish")->name("cart_finish");

    Route::get("/detail/{id}","Penjualan@detail")->name("detail");
    Route::get("/update_status/{id}","Penjualan@update_status")->name("update_status");
});

Route::prefix("orders")->name("orders.")->group(function (){
    Route::get("/","OrdersPelanggan@index")->name("list");
    Route::get("/waiting","OrdersPelanggan@index_waiting")->name("list_waiting");
    Route::get("/confirmed","OrdersPelanggan@index_confirmed")->name("list_confirmed");
    Route::get("/process","OrdersPelanggan@index_process")->name("list_process");
    Route::get("/shiping","OrdersPelanggan@index_shiping")->name("list_shiping");
    Route::get("/complete","OrdersPelanggan@index_complete")->name("list_complete");
    Route::get("/cancel","OrdersPelanggan@index_cancel")->name("list_cancel");
    Route::post("/upload/{id}","OrdersPelanggan@upload")->name("upload");
    Route::get("/detail/{id}","OrdersPelanggan@detail")->name("detail");
});

Route::prefix("produksi")->name("produksi.")->group(function (){
    Route::get("/","Produksi@index")->name("list");
    Route::get("/detail/{id}","Produksi@detail")->name("detail");
    Route::get("/update_status/{id}","Produksi@update_status")->name("update_status");
});


