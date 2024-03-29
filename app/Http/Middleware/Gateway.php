<?php

namespace App\Http\Middleware;

use App\Casts\LevelAccount;
use App\Casts\ScheduleType;
use App\Casts\StatusAccount;
use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;

class Gateway
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$is_must = null)
    {
        $level = session()->get("level");
        if ($level === NULL || $is_must === NULL){
            if ($request->ajax()){
                return response()->json(["msg"=>"Anda Belum Login "],400);
            }
            return  redirect("/")->withErrors(["msg"=>"Anda Belum Login"]);

        }else{
            $exploded = explode("|",$is_must);

            if (in_array($level,$exploded)){
                $is_must = $level;
//                Config::set("adminlte.sidebar_collapse",true);
                Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e){
                    $e->menu->add([
                        "text"=>"Beranda",
                        "url"=>"dashboard",
                        "icon"=>"fa fa-home"
                    ]);
                });

                if ($level == LevelAccount::ADMIN){
                    Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e){
                        $e->menu->add([
                            "text"=>"Data Suplier",
                            "url"=>"master/suplier",
                            "icon"=>"fa fa-file"
                        ]);
                        $e->menu->add([
                            "text"=>"Data Ukuran",
                            "url"=>"master/size",
                            "icon"=>"fa fa-file"
                        ]);
                        $e->menu->add([
                            "text"=>"Data Pakan",
                            "url"=>"master/material",
                            "icon"=>"fa fa-file"
                        ]);
                        $e->menu->add([
                            "text"=>"Data Produk",
                            "url"=>"master/produk",
                            "icon"=>"fa fa-file"
                        ]);
                        $e->menu->add([
                            "text"=>"Data Rekening",
                            "url"=>"master/rekening",
                            "icon"=>"fa fa-file"
                        ]);
                        $e->menu->add([
                            "text"=>"Data Akun",
                            "url"=>"master/akun",
                            "icon"=>"fa fa-file"
                        ]);

                    });
                }elseif ($level == LevelAccount::PEMILIK){
                    Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e) {
                        $e->menu->add([
                            "text" => "Pemesanan",
                            "url" => "pemesanan",
                            "icon" => "fa fa-file"
                        ]);
                        $e->menu->add([
                            "text" => "Laporan",
                            "url" => "laporan",
                            "icon" => "fa fa-file"
                        ]);
                    });
                }elseif ($level == LevelAccount::GUDANG){
                    Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e){
                        $e->menu->add([
                            "text"=>"Data Suplier",
                            "url"=>"master/suplier",
                            "icon"=>"fa fa-file"
                        ]);
                        $e->menu->add([
                            "text"=>"Data Ukuran",
                            "url"=>"master/size",
                            "icon"=>"fa fa-file"
                        ]);
                        $e->menu->add([
                            "text"=>"Data Pakan",
                            "url"=>"master/material",
                            "icon"=>"fa fa-file"
                        ]);
                        $e->menu->add([
                            "text"=>"Data Produk",
                            "url"=>"master/produk",
                            "icon"=>"fa fa-file"
                        ]);



                        $e->menu->add([
                            "text"=>"Pemesanan Pakan",
                            "url"=>"pemesanan",
                            "icon"=>"fa fa-file"
                        ]);

                        $e->menu->add([
                            "text" => "Laporan Pemesanan",
                            "url" => "laporan",
                            "icon" => "fa fa-file"
                        ]);

                    });
                }elseif ($level == LevelAccount::PELANGGAN){
                    Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e){
                        $e->menu->add([
                            "text"=>"Kembali Ke Toko",
                            "url"=>"/",
                            "icon"=>"fa fa-shopping-cart"
                        ]);
                    });
                    Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e) {
                        $e->menu->add([
                            "text" => "Pesanan",
                            "url" => "orders",
                            "icon" => "fa fa-file",
                            'submenu' => [
                                [
                                    'text' => 'Menunggu Pembayaran',
                                    'url'  => 'orders/waiting',
                                ],
                                [
                                    'text' => 'Pembayaran Di Konfirmasi',
                                    'url'  => 'orders/confirmed',
                                ],
                                [
                                    'text' => 'Di Proses',
                                    'url'  => 'orders/process',
                                ],
                                [
                                    'text' => 'Pengiriman',
                                    'url'  => 'orders/shiping',
                                ],
                                [
                                    'text' => 'Complete',
                                    'url'  => 'orders/complete',
                                ],
                                [
                                    'text' => 'Di Batalkan',
                                    'url'  => 'orders/cancel',
                                ],
                            ],
                        ]);
                    });
                    Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e){
                        $e->menu->add([
                            "text"=>"Alamat Pengiriman",
                            "url"=>"/alamat",
                            "icon"=>"fa fa-users"
                        ]);
                    });
                }elseif ($level == LevelAccount::KASIR){
                    Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e) {
                        $e->menu->add([
                            "text" => "Pesanan",
                            "url" => "penjualan",
                            "icon" => "fa fa-file",
                            'submenu' => [
                                [
                                    'text' => 'POS',
                                    'url'  => 'penjualan?type=pos',
                                ],
                                [
                                    'text' => 'Transaksi Online',
                                    'url'  => 'penjualan?type=online',
                                ],
                                [
                                    'text' => 'Transaksi Offline',
                                    'url'  => 'penjualan?type=offline',
                                ]
                            ]
                        ]);
                    });

                }

                Event::listen("JeroenNoten\LaravelAdminLte\Events\BuildingMenu",function ($e){
                    $e->menu->add([
                        "text"=>"Logout",
                        "url"=>"logout",
                        "icon"=>"fa fa-sign-out-alt"
                    ]);

                });
            }

            if ($level == $is_must){
                return $next($request);
            }else{
                if ($request->ajax()){
                    return response()->json(["msg"=>"Anda tidak memiliki akses ke halaman ini  "],400);
                }
                return  redirect("/")->withErrors(["msg"=>"Anda tidak memiliki akses ke halaman ini "]);
            }
        }

    }
}
