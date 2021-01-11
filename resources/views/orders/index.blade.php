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
                                <th>Tanggal Order</th>
                                <th>Total Order</th>
                                <th>Jumlah Barang</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($history as $key => $row)
                                    <tr>
                                        <td>{{($key+1)}}</td>
                                        <td>{{$row->created_at->format("d/m/Y")}}</td>
                                        <td>Rp. {{number_format($row->total)}}</td>
                                        <td>{{$row->order_items->count()}}</td>
                                        <td>
                                            <img src="{{$row->bukti}}" class="img-fluid img-thumbnail" alt="">
                                        </td>
                                        <td>
                                            {{\App\Casts\OrderStatus::lang($row->status)}}
                                        </td>
                                        <td align="center">
                                            <a href="" class="btn btn-primary m-2">
                                                <li class="fa fa-eye"></li>
                                            </a>
                                            @if($row->status === \App\Casts\OrderStatus::WAITING_PAYMENT)
                                                <label class="btn-warning btn">
                                                    <form method="post" enctype="multipart/form-data" id="submit_form_{{$row->id}}" action="{{route("orders.upload",$row->id)}}">
                                                        <input type="file" name="file" onchange="submit({{$row->id}})" class="form-control-file">
                                                        <li class="fa fa-upload"></li> Upload Bukti Bayar
                                                    </form>
                                                </label>
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
        function submit(id){
            $("#submit_form_".id).submit();
        }
        $(document).ready(function () {
            $("table").DataTable()
        })
    </script>
@stop
