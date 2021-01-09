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
                            <label>Nama Bahan Baku</label>
                            <input type="text" class="form-control" name="name"  value="{{@$data->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Stok (Sekarang)</label>
                            <input type="number" min="0" class="form-control" name="stok"  value="{{@$data->stok}}" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control">{{@$data->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Ukuran</label>
                            <select name="size_id" id="size_id" class="form-control">
                                @foreach(\App\Models\Size::all() as $k => $v)
                                    @if(isset($data))
                                        @if($data->size_id === $v->id)
                                            <option selected value="{{$v->id}}">{{$v->name}}</option>
                                        @else
                                            <option value="{{$v->id}}">{{$v->name}}</option>
                                        @endif
                                    @else
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga Bahan Baku</label>
                            <input type="number" min="0" class="form-control" name="price"  value="{{@$data->price}}" required>
                        </div>
                        @if(isset($data))
                            <div class="form-group">
                                <img src="{{$data->img}}" class="img-fluid text-center" alt="">
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Gambar Bahan Baku</label>
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
