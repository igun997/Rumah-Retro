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
                    <form action="{{$route}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="name"  value="{{@$data->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Produk</label>
                            <input type="number" class="form-control" name="price"  value="{{@$data->price}}" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control">{{@$data->deskripsi}}</textarea>
                        </div>

                        @if(isset($data))
                            <div class="form-group">
                                <img src="{{$data->img}}" class="img-fluid text-center" alt="">
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Gambar Produk</label>
                            <input type="file" class="form-control" name="img"  accept="image/*" {{(isset($route))?"":"required"}}>
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
