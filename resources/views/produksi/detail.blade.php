@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Produksi</div>
                </div>
                <div class="card-body">
                    <ul class="list-group m-1">
                        <li class="list-group-item active">
                            Produk
                        </li>
                        @foreach($production->production_materials as $num => $row)
                        <li class="list-group-item">
                            <b>{{$row->product->name}}</b> x {{$row->qty}}
                        </li>
                        @endforeach
                    </ul>
                    <ul class="list-group m-1">
                        <li class="list-group-item active">
                            Rincian Biaya
                        </li>
                        <li class="list-group-item">
                            <b>Tgl Pesan </b> : {{$production->created_at->format("d/m/Y")}}
                        </li>
                        <li class="list-group-item">
                            <b>Batas Produksi </b> : {{$production->due_date->format("d/m/Y")}}
                        </li>
                        <li class="list-group-item">
                            <b>Total </b> : Rp. {{number_format($production->total)}} ,-
                        </li>
                        <li class="list-group-item">
                            <b>Status </b> : {{\App\Casts\ProductionStatus::lang($production->status)}}
                        </li>
                        <li class="list-group-item">
                            <b>Catatan </b> : {{$production->notes}}
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Material Yang Digunakan</div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table  class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pakan</th>
                                <th>Jumlah Terpakai</th>
                                <th>Harga Pakan</th>
                                <th>Stok Sekarang</th>
                                <th>Biaya</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($production->production_materials as $num => $row)
                            @foreach($row->product->materials as $_row)
                                <tr>
                                    <td>{{($num+1)}}</td>
                                    <td>{{$_row->name}}</td>
                                    <td>{{$_row->pivot->qty}}</td>
                                    <td>{{number_format($_row->price)}}</td>
                                    <td>{{number_format($_row->stok)}}</td>
                                    <td>{{number_format($_row->pivot->qty * $_row->price)}}</td>

                                </tr>
                            @endforeach
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
