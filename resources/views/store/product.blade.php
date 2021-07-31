@extends("layout.app")
@section("title","Selamat Datang Di Lele Bujang")
@section("content")

    <div class="popular-items">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle text-center">
                        <h2>Produk Kami</h2>
                        <p>Produk Terbaik, Datang Dari Profesional </p>
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
                                <a href="detail_product/{{$product->id}}">
                                <span data-identifier="product_{{$product->id}}" class="cart_submit" data-identify="product_{{$product->id}}">Lihat Detail</span>
                                </a>
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
