@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{((isset($title))?$title:"")}}</div>
                </div>
                <div class="card-body">
                    <form action="{{$route}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Material</label>
                            <select name="material_id" id="" class="form-control">
                                @foreach($data_material as $k => $v)
                                    @if($v->stok < 10)
                                    @if(@$updated->material_id == $v->id))
                                    <option value="{{$v->id}}" selected>{{$v->name}} - {{$v->stok}} {{$v->size->name}}</option>
                                    @else
                                        <option value="{{$v->id}}">{{$v->name}} - {{$v->stok}} {{$v->size->name}}</option>
                                    @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Material</label>
                            <input type="number" step="0.1" min="0" name="qty" value="{{@$updated->qty}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block btn-lg">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Daftar Bahan Baku</div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table  class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Bahan</th>
                                <th>Kuantitas</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data->materials as $k => $v)
                                <tr>
                                    <td>{{($k+1)}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->pivot->qty}} {{$v->size->name}}</td>
                                    <td>{{number_format($v->pivot->price)}}</td>
                                    <td>Rp. {{number_format($v->pivot->price * $v->pivot->qty)}}</td>
                                    <td>
                                        <a href="{{route("pemesanan.material_delete",[$data->id,$v->pivot->id])}}" class="btn btn-danger">
                                            <li class="fa fa-trash"></li>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
        $(document).ready(function () {
            $("table").DataTable();
        });
    </script>
@stop
