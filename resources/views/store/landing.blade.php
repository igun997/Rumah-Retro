@extends("layout.app")
@section("title","Selamat Datang Di Rumah Retro")
@section("content")

    <div class="popular-items section-padding30">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-70 text-center">
                        <h2>Produk Kami</h2>
                        <p>Produk Terbaik, Datang Dari Tangan Yang Terbaik</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($products as $key => $product)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="single-popular-items mb-50 text-center">
                        <div class="popular-img">
                            <img src="{{$product->img}}" alt="">
                            <div class="img-cap">
                                <span data-identifier="product_{{$product->id}}" class="cart_submit" data-identify="product_{{$product->id}}">Tambah Ke Keranjang</span>
                                <form action="{{route("store.cart_action",$product->id)}}" id="product_{{$product->id}}" method="post">
                                    <input type="text" name="product_id" value="{{$product->id}}" hidden>
                                    <button style="display: none" type="submit" ></button>
                                </form>
                            </div>
                        </div>
                        <div class="popular-caption">
                            <h3><a href="">{{$product->name}}</a></h3>
                            <span>Rp. {{number_format($product->price)}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Button -->
{{--            <div class="row justify-content-center">--}}
{{--                <div class="room-btn pt-70">--}}
{{--                    <a href="catagori.html" class="btn view-btn1">Lihat Produk Lainnya </a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

    <div class="shop-method-area">
        <div class="container">
            <div class="method-wrapper">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-package"></i>
                            <h6>Free Shipping Method</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-unlock"></i>
                            <h6>Secure Payment System</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-reload"></i>
                            <h6>Secure Payment System</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Method End-->
@endsection
@section("js")
    <script>
        $(document).ready(function () {
            $(".cart_submit").on("click",function () {
                console.log("Click")
                id = $(this).data("identifier");
                console.log(id)
                $("#"+id).trigger("submit");
            })
        })
    </script>
@endsection
