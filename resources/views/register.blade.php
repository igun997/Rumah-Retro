@extends('adminlte::auth.login')
@section('auth_body')
    <form action="{{route("register.post")}}" method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" />
        </div>
        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="no_hp" class="form-control" name="no_hp" />
        </div>
      
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" />
        </div>
        <div class="form-group">
            <label for="username">Password</label>
            <input type="password" class="form-control" name="password" />
        </div>
        <div class="form-group">
            <label for="no_hp">Alamat</label>
            <textarea name="alamat" class="form-control" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="no_hp">Alamat</label>
            <textarea name="alamat" class="form-control" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="row">
            <div class="col-12">
                <button type=submit class="btn btn-block btn-flat btn-primary">
                    <span class="fas fa-user"></span>
                    Daftar
                </button>
            </div>
        </div>

    </form>
@stop

@section("js")
@include("msg")
@stop

