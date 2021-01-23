@extends('layout.app')

@section('title',$title)
@section('content')
    <section class="cart_area section_padding">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($cart) > 0)
                        @foreach($cart as $key => $row)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{$row->associatedModel->img}}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>{{$row->associatedModel->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>Rp. {{number_format($row->price)}}</h5>
                                </td>
                                <td>

                                    <form action="{{route("store.cart_update",$row->id)}}" method="post">
                                        <div class="product_count">
                                            <input type="number" required value="{{$row->quantity}}" min="0"  name="qty">
                                        </div>
                                        <button class="btn btn-primary" type="submit">Ubah</button>
                                    </form>
                                </td>
                                <td>
                                    <h5>Rp. {{$row->getPriceSum()}}</h5>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <td align="center" colspan="4">Keranjang Kosong Bro . .</td>
                        @endif
                        <tr class="bottom_button">
                            <td>
                                Pengiriman
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                Provinsi
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                Kota
                            </td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr class="bottom_button">
                            <td>
                                <b>Total Pengiriman</b>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>Rp. {{(Cart::session(session()->get("id"))->getTotal())}}</h5>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn_1" href="/">Lanjutkan Belanja</a>
                        <a class="btn_1 checkout_btn_1 disabled" disabled id="lanjutkan" >Proses Pembayaran</a>
                    </div>
                </div>
            </div>
        </div></section>
@endsection

