@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Pesanan</div>
                </div>
                <div class="card-body">
                    <ul class="list-group m-1">
                        <li class="list-group-item active">
                            Rincian Biaya
                        </li>
                        <li class="list-group-i@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Pesanan</div>
                </div>
                <div class="card-body">
                    <ul class="list-group m-1">
                        <li class="list-group-item active">
                            Rincian Biaya
                        </li>
                        <li class="list-group-item">
                            <b>Tgl Pesan </b> : {{$order->created_at->format("d/m/Y")}}
                        </li>
                        <li class="list-group-item">
                            <b>Total </b> : Rp. {{number_format($order->total)}} ,-
                        </li>
                        <li class="list-group-item">
                            <b>Status </b> : {{\App\Casts\OrderStatus::lang($order->status)}}
                        </li>
                        <li class="list-group-item">
                            <b>Catatan </b> : {!! $order->notes !!}
                        </li>
                        @if($order->additional_price > 0)
                            <li class="list-group-item bg-secondary">
                                <b>Tambahan Biaya </b> : Rp. {{number_format($order->additional_price)}} ,-
                            </li>
                        @endif
                    </ul>
                    <ul class="list-group m-1">
                        <li class="list-group-item active">
                            Rincian Pelanggan
                        </li>
                        <li class="list-group-item">
                            <b>Nama </b> : {{$order->user->name}}
                        </li>
                        <li class="list-group-item">
                            <b>Alamat </b> : {{$order->user->alamat}}
                        </li>
                    </ul>
                    <ul class="list-group m-1">
                        <li class="list-group-item active">
                            Bayar Melalui
                        </li>
                        <li class="list-group-item">
                            <b>Atas Nama  </b> : {{@\App\Models\Rekening::first()->name}}
                        </li>
                        <li class="list-group-item">
                            <b>Nomor Rekening  </b> : {{@\App\Models\Rekening::first()->nomor}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Barang Yang Dipesan</div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table  class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Jumlah Pembelian</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->order_items as $num => $row)
                                <tr>
                                    <td>{{($num+1)}}</td>
                                    <td>{{$row->product->name}}</td>
                                    <td>{{number_format($row->price)}}</td>
                                    <td>{{$row->product->deskripsi}}</td>
                                    <td>
                                        <img src="{{$row->product->img}}" class="img-fluid img-thumbnail" alt="">
                                    </td>
                                    <td>
                                        {{number_format($row->qty)}}
                                    </td>
                                    <td>
                                        {{number_format(($row->qty * $row->price))}}
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
