@extends("layout.app")
@section("title","Selamat Datang Di Lele Bujang")
@section("content")

    <div class="popular-items section-padding30">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-70 text-center">
                        <h2>Tentang Lele Bujang</h2>
                        <p>Lele Bumi Jaya Sagalaherang merupakan perusahaan pribadi pemasok utama komoditas lele konsumsi untuk pasar Subang Selatan. To Survive and To Serve merupakan motto dari Lele Bujang yang mengedepankan konsistensi budidaya ikan lele untuk melayani masyarakat secara berkelanjutan. Berdiri sejak 7 Juni 2018 beramunisikan 23 kolam produksi kini Lele Bujang telah menjadi keluarga kecil yang terdiri dari beberapa kepala keluarga yang siap melayani kebutuhan lele konsumsi anda.</p>
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
