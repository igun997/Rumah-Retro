@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{((isset($title))?$title:"")}}</div>
                </div>
                <div class="card-body">
                    @if(in_array(session()->get("level"),[\App\Casts\LevelAccount::GUDANG]))
                        <a href="{{route("pemesanan.add")}}" class="btn btn-success ml-2 mb-4">
                            <li class="fa fa-plus"></li> Tambah Data
                        </a>
                    @endif

                    <div class="table-responsive">
                        <table  class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl PO</th>
                                <th>Total</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Diubah</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $num => $row)
                                <tr>
                                    <td>{{($num+1)}}</td>
                                    <td>{{$row->po_date->format("d/m/Y")}}</td>
                                    <td>Rp. {{number_format($row->total)}}</td>
                                    <td>{{$row->notes}}</td>
                                    <td>{{\App\Casts\PurchaseStatus::lang($row->status)}}</td>
                                    <td>{{($row->created_at !== null) ? $row->created_at->format("d-m-Y"):"-"}}</td>
                                    <td>{{($row->updated_at !== null) ? $row->updated_at->format("d-m-Y"):"-"}}</td>
                                    <td>
                                        <a href="{{route("pemesanan.detail",$row->id)}}" class="btn btn-primary m-2">
                                            <li class="fa fa-eye"></li>
                                        </a>
                                        
                                         <a href="{{route("pemesanan.detail",$row->id)}}" class="btn btn-primary m-2">
                                            <li class="fa fa-print"></li>
                                        </a>
                                        @if(in_array(session()->get("level"),[\App\Casts\LevelAccount::PEMILIK]))
                                            @if(in_array($row->status,[\App\Casts\PurchaseStatus::CREATED]))

                                                <a href="{{route("pemesanan.cancel",$row->id)}}" class="btn btn-danger m-2">
                                                    <li class="fa fa-trash"></li>
                                                </a>
                                                <a href="{{route("pemesanan.confirm",$row->id)}}" class="btn btn-success m-2">
                                                    <li class="fa fa-check"></li>
                                                </a>
                                            @endif
                                        @else
                                            @if(in_array($row->status,[\App\Casts\PurchaseStatus::CREATED]))
                                                <a href="{{route("pemesanan.material",$row->id)}}" class="btn btn-primary m-2">
                                                    <li class="fa fa-cog"></li>
                                                </a>
                                                <a href="{{route("pemesanan.cancel",$row->id)}}" class="btn btn-danger m-2">
                                                    <li class="fa fa-trash"></li>
                                                </a>
                                            @elseif(in_array($row->status,[\App\Casts\PurchaseStatus::CONFIRMED]))
                                                <a href="{{route("pemesanan.proses",$row->id)}}" class="btn btn-success m-2">
                                                    <li class="fa fa-arrow-circle-right"></li> Proses
                                                </a>
                                            @elseif(in_array($row->status,[\App\Casts\PurchaseStatus::PROCESSING]))
                                                <a href="{{route("pemesanan.sending",$row->id)}}" class="btn btn-success m-2">
                                                    <li class="fa fa-arrow-circle-right"></li> Sedang Dikirim
                                                </a>
                                            @elseif(in_array($row->status,[\App\Casts\PurchaseStatus::SHIPPING]))
                                                <a href="{{route("pemesanan.done",$row->id)}}" class="btn btn-success m-2">
                                                    <li class="fa fa-arrow-circle-right"></li> Selesai
                                                </a>
                                            @endif
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
            $("table").DataTable();
        });
    </script>
@stop
