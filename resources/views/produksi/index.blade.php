@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{$title}}</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Biaya Produksi<br>(Kasar)</th>
                                    <th>Batas Tanggal</th>
                                    <th>Total Jenis Barang</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produksi as $k => $v)
                                    <tr>
                                        <td>{{($k+1)}}</td>
                                        <td>{{$v->name}}</td>
                                        <td>Rp. {{number_format($v->total)}}</td>
                                        <td>{{$v->due_date->format("d/m/Y")}}</td>
                                        <td>{{$v->production_materials->count()}}</td>
                                        <td>{{\App\Casts\ProductionStatus::lang($v->status)}}</td>
                                        <td>
                                            <a href="{{route("produksi.detail",$v->id)}}" class="btn btn-primary m-2">
                                                <li class="fa fa-eye"></li>
                                            </a>
                                            @if(\App\Casts\ProductionStatus::CREATED === $v->status)
                                                <a href="{{route("produksi.update_status",[$v->id,"status"=>\App\Casts\ProductionStatus::CONFIRMED])}}" class="btn btn-success m-2">
                                                    <li class="fa fa-check"></li>
                                                </a>
                                                <a href="{{route("produksi.update_status",[$v->id,"status"=>\App\Casts\ProductionStatus::CANCELED])}}" class="btn btn-danger m-2">
                                                    <li class="fa fa-trash"></li>
                                                </a>
                                            @elseif(\App\Casts\ProductionStatus::CONFIRMED === $v->status)
                                                <a href="{{route("produksi.update_status",[$v->id,"status"=>\App\Casts\ProductionStatus::PROCESSING])}}" class="btn btn-success m-2">
                                                    <li class="fa fa-arrow-circle-right"></li> Proses Pesanan
                                                </a>
                                            @elseif(\App\Casts\ProductionStatus::PROCESSING === $v->status)
                                                <a href="{{route("produksi.update_status",[$v->id,"status"=>\App\Casts\ProductionStatus::COMPLETED])}}" class="btn btn-success m-2">
                                                    <li class="fa fa-arrow-circle-right"></li> Selesaikan Pesanan
                                                </a>
                                            @endif

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
            $("table").DataTable()
        })
    </script>
@stop
