@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Sablon</div>
                </div>
                <div class="card-body">
                    <form action="{{$route}}" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label>Nama Sablon</label>
                            <input type="text" class="form-control" name="name" />
                        </div>
                        <div class="form-group">
                            <label>Harga Sablon</label>
                            <input type="number" class="form-control" name="price" />
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{((isset($title))?$title:"")}}</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sablon</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $num => $row)
                                <tr>
                                    <td>{{$num+1}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>Rp. {{number_format($row->price)}}</td>
                                    <td>
                                        <a href="{{route("master.product.add_sablon_delete",[$id,$row->id])}}" class="btn btn-danger">Hapus</a>
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
