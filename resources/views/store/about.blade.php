@extends("layout.app")
@section("title","Selamat Datang Di Rumah Retro")
@section("content")

    <div class="popular-items section-padding30">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-70 text-center">
                        <h2>Tentang Rumah Retro</h2>
                        <p>Produk Terbaik, Datang Dari Tangan Yang Terbaik</p>
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
