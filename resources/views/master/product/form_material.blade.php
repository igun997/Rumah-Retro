@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-12">
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
                                    @if(@$updated->material_id == $v->id))
                                        <option value="{{$v->id}}" selected>{{$v->name}} - {{$v->sisa()}} {{$v->size->name}}</option>
                                    @else
                                        <option value="{{$v->id}}">{{$v->name}} - {{$v->sisa()}} {{$v->size->name}}</option>
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
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Material</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Material</th>
                                    <th>Jumlah Yang Di Perlukan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $k => $v)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$v->material->name}}</td>
                                        <td>{{$v->qty}} {{$v->material->size->name}}</td>
                                        <td>
                                            <a href="{{route("master.product.add_material",[$id,"comp"=>$v->id])}}" class="btn btn-warning m-2">
                                                <li class="fa fa-edit"></li>
                                            </a>


                                            <a href="{{route("master.product.delete_material",$v->id)}}" class="btn btn-danger m-2">
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
        $("table").DataTable();
    </script>
@stop
