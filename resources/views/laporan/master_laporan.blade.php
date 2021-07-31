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
                    <form action="{{route("laporan.generate")}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Jenis Laporan</label>
                            <select name="type" id="type" class="form-control">
                                <option value="bahan_baku">Pakan</option>
                                <option value="penjualan">Penjualan</option>
                                <option value="pengguna">Pengguna</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tgl. Mulai</label>
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
                    <form action="{{route("laporan.generate")}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Jenis Laporan</label>
                            <select name="type" id="type" class="form-control">
                                <option value="bahan_baku">Pakan</option>
                                <option value="penjualan">Penjualan</option>
                                <option value="pengguna">Pengguna</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tgl. Mulai</label>
                            <input type="date" name="start" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tgl. Selesai</label>
                            <input type="date" name="end" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block btn-lg">Generate Data</button>
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
