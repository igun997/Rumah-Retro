@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        @if(request()->get("type") === "pos")
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Produk</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($produk as $k => $row)
                        <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
                            <div class="card bg-light">
                                <img class="card-img" src="{{$row->img}}" alt="Vans">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="list-group">
                                                <li class="list-group-item"><b>Nama</b> : {{$row->name}} </li>
                                                <li class="list-group-item"><b>Harga</b> : Rp. {{number_format($row->price)}} </li>
                                                <li class="list-group-item"><b>Deskripsi</b> : {{$row->deskripsi}} </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <form action="{{route("penjualan.cart_action")}}" method="post">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <input type="text" hidden name="product_id" value="{{$row->id}}">
                                                <input required type="number" min="1" name="qty" class="form-control" placeholder="Jumlah Beli" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-shopping-cart"></i> Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Keranjang Belanja</div>
                </div>
                <div class="card-body">
                    <ul class="list-group m-1">
                        @php
                        @endphp
                        @foreach($current_cart as $k => $row)
                            <li class="list-group-item">
                                <b>{{$row->name}}</b> x {{$row->quantity}} (Rp. {{$row->getPriceSum()}})
                                <a href="{{route("penjualan.cart_delete",$row->id)}}" class="btn btn-danger float-right">X</a>
                            </li>
                        @endforeach
                        <li class="list-group-item active"><b>Total</b> : Rp. {{Cart::session(session()->get("id"))->getTotal()}},-</li>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <form action="{{route("penjualan.cart_finish")}}" method="post">
                        <div class="form-group">
                            <label for="add">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="name" value="{{old("name")}}" required/>
                        </div>
                        <div class="form-group">
                            <label for="add">Alamat</label>
                            <textarea name="alamat" id="" cols="30" rows="4" class="form-control">{{old("alamat")}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="add">Catatan</label>
                            <textarea name="notes" id="" cols="30" rows="4" class="form-control">{{old("notes")}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="add">Biaya Tambahan</label>
                            <input type="number" class="form-control" value="{{old("additional_price")}}" placeholder="Isi Jika Terdapat Biaya Tambahan" name="additional_price" />
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> Proses Pembayaran
                        </button>
                    </form>

                </div>
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">History Penjualan</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Lengkap</th>
                                <th>Total</th>
                                <th>Catatan</th>
                                <th>Jenis Transaksi</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Diubah</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($history as $k => $row)
                                <tr>
                                    <td>{{($k+1)}}</td>
                                    <td>{{$row->created_at->format("d/m/Y")}}</td>
                                    <td>{{$row->user->name}}</td>
                                    <td>Rp. {{number_format($row->total)}}</td>
                                    <td>{!! $row->notes !!}</td>
                                    <td>{{\App\Casts\TypeStatus::lang($row->type)}}</td>
                                    <td>
                                        <img src="{{$row->bukti}}" onerror="this.src='//via.placeholder.com/400x200?text=Tidak%20Ada%20Bukti%20Pembayaran'" class="img-thumbnail img-fluid" alt="">
                                    </td>
                                    <td>{{\App\Casts\OrderStatus::lang($row->status)}}</td>
                                    <td>{{$row->updated_at->format("d/m/Y")}}</td>
                                    <td align="center">
                                        <a href="{{route("penjualan.detail",$row->id)}}" class="btn btn-primary m-2">
                                            <li class="fa fa-eye"></li>
                                        </a>
                                        @if(\App\Casts\OrderStatus::WAITING_PAYMENT == $row->status)
                                            <a href="{{route("penjualan.update_status",[$row->id,"status"=>\App\Casts\OrderStatus::CONFIRMED])}}" class="btn btn-success m-2">
                                                <li class="fa fa-check"></li>
                                            </a>
                                            <a href="{{route("penjualan.update_status",[$row->id,"status"=>\App\Casts\OrderStatus::CANCELED])}}" class="btn btn-danger m-2">
                                                <li class="fa fa-trash"></li>
                                            </a>
                                        @elseif(\App\Casts\OrderStatus::CONFIRMED == $row->status)

                                            <a href="#" data-url="{{route("penjualan.update_status",[$row->id,"status"=>\App\Casts\OrderStatus::PROCESSING])}}" class="btn btn-success m-2 process">
                                                <li class="fa fa-arrow-circle-right"></li> Proses Pesanan
                                            </a>
                                        @elseif(\App\Casts\OrderStatus::PROCESSING == $row->status)
                                            <a href="{{route("penjualan.update_status",[$row->id,"status"=>\App\Casts\OrderStatus::SHIPPING])}}" class="btn btn-success m-2">
                                                <li class="fa fa-arrow-circle-right"></li> Kirim Pesanan
                                            </a>
                                        @elseif(\App\Casts\OrderStatus::SHIPPING == $row->status)
                                            <a href="{{route("penjualan.update_status",[$row->id,"status"=>\App\Casts\OrderStatus::COMPLETED])}}" class="btn btn-success m-2">
                                                <li class="fa fa-arrow-circle-right"></li> Selesaikan
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
        @endif
    </div>
@stop

@section('css')

@stop

@section("js")
    @include("msg")
    <script>
        $(document).ready(function () {
            $("table").DataTable()
            $(".process").on("click",function (){
                const url = $(this).data("url")
                c = prompt("Masukan Tanggal Selesai");
                if (c){
                    location.href = url+"&due="+c;
                }else{
                    location.href = url;
                }
            })
        })
    </script>
@stop
