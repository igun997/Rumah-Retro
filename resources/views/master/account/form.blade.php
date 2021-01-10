@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{((isset($title))?$title:"")}}</div>
                </div>
                <div class="card-body">
                    <form action="{{$route}}" method="post">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="name"  value="{{@$data->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control" name="no_hp"  value="{{@$data->no_hp}}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"  value="{{@$data->email}}" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username"  value="{{@$data->username}}" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"  value="{{@$data->password}}" required>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select name="level" class="form-control">
                                @if(isset($data))
                                    <option selected value="{{$data->level}}">{{\App\Casts\LevelAccount::lang($data->level)}}</option>
                                    <option value="{{\App\Casts\LevelAccount::ADMIN}}">Admin</option>
                                    <option value="{{\App\Casts\LevelAccount::PELANGGAN}}">Pelanggan</option>
                                    <option value="{{\App\Casts\LevelAccount::PEMILIK}}">Pemilik</option>
                                    <option value="{{\App\Casts\LevelAccount::GUDANG}}">Gudang</option>
                                    <option value="{{\App\Casts\LevelAccount::PRODUKSI}}">Produksi</option>
                                    <option value="{{\App\Casts\LevelAccount::KASIR}}">Kasir</option>
                                @else
                                    <option value="{{\App\Casts\LevelAccount::ADMIN}}">Admin</option>
                                    <option value="{{\App\Casts\LevelAccount::PELANGGAN}}">Pelanggan</option>
                                    <option value="{{\App\Casts\LevelAccount::PEMILIK}}">Pemilik</option>
                                    <option value="{{\App\Casts\LevelAccount::GUDANG}}">Gudang</option>
                                    <option value="{{\App\Casts\LevelAccount::PRODUKSI}}">Produksi</option>
                                    <option value="{{\App\Casts\LevelAccount::KASIR}}">Kasir</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                @if(isset($data))
                                    <option value="{{$data->status}}">{{\App\Casts\StatusAccount::lang($data->status)}}</option>
                                    <option value="{{\App\Casts\StatusAccount::ACTIVE}}">Aktif</option>
                                    <option value="{{\App\Casts\StatusAccount::INACTIVE}}">Tidak Aktif</option>
                                @else
                                    <option value="{{\App\Casts\StatusAccount::ACTIVE}}">Aktif</option>
                                    <option value="{{\App\Casts\StatusAccount::INACTIVE}}">Tidak Aktif</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" cols="30" rows="10" class="form-control">{{@$data->alamat}}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block btn-lg">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section("js")
    @include("msg")
    <script>

    </script>
@stop
