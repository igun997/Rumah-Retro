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
                            <label>Tanggal PO</label>
                            <input type="date" class="form-control" name="tgl_po"  value="{{@$data->po_date}}" required>
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="notes" id="" cols="30" rows="10" class="form-control">{{@$data->notes}}</textarea>
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
