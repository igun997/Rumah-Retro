@extends("layout.app")
@section("title","Selamat Datang Di Tukang Ikan")
@section("content")

    <div class="popular-items">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="section-tittle text-center">
                        <img class="img-fluid" src="{{url("logo.png")}}" alt="">
                        <h3>Welcome to Tukang Ikan Production</h3>
                    </div>
                    <hr>
                    <p class="text-justify">
                        Tukang Ikan – Belon di Isi
                    </p>
                    <br>
                </div>
            </div>
        </div>
    </div>
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
