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
                    <ul class="list-group">
                        <li class="list-group-item"><b>Tanggal PO</b> :  {{$data->po_date->format("d/m/Y")}}</li>
                        <li class="list-group-item"><b>Status PO</b> : {{\App\Casts\PurchaseStatus::lang($data->status)}}</li>
                        <li class="list-group-item"><b>Total PO </b> : Rp. {{number_format($data->total)}}</li>
                        <li class="list-group-item"><b>Catatan</b> : {{$data->notes}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Daftar Pakan</div>
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
