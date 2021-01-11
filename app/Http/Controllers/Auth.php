<?php

namespace App\Http\Controllers;

use App\Casts\LevelAccount;
use App\Casts\StatusAccount;
use App\Models\User;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;

class Auth extends Controller
{
    use ViewTrait;
    public function __construct()
    {
        $this->base = "";
    }

    public function index(){
        return view("login");
    }

    public function register()
    {
        $title = "Form Registrasi";
        return $this->loadView("register",compact("title"));
    }

    public function register_action(Request  $req)
    {
        $req->validate([
            "name"=>"required",
            "alamat"=>"required",
            "email"=>"required",
            "no_hp"=>"required",
            "username"=>"required",
            "password"=>"required",
        ]);

        $data = $req->all();
        $data["status"] = StatusAccount::ACTIVE;
        $data["level"] = LevelAccount::PELANGGAN;
        $create = User::create($data);
        if ($create){
            return $this->successRedirect("login");
        }
        return  $this->failBack(false);
    }

    public function login(Request $req)
    {
        $req->validate([
            "username"=>"required",
            "password"=>"required"
        ]);

        $cek = User::where(["username"=>$req->username,"password"=>$req->password,"status"=>StatusAccount::ACTIVE]);
        if ($cek->count() > 0){
            $build = [
                "name"=>$cek->first()->name,
                "level"=>$cek->first()->level,
                "id"=>$cek->first()->id,
                "username"=>$cek->first()->username,
                "url"=>LevelAccount::redirect($cek->first()->level),
            ];
            session($build);
            return redirect($build["url"])->with(["msg"=>"Selamat Datang ".$build["name"]]);
        }else{
            return back()->withErrors(["msg"=>"Username & Password Salah"]);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect("/");
    }
}
