@extends("layout.app")
@section("title","Selamat Datang Di Rumah Retro")
@section("content")

    <div class="popular-items">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle text-center">
                        <h2>Contact Us</h2>
                        <p class="text-justify">
                            Rumah Retro – Clothing Industri berdiri sejak bulan Juni 2003 dan merupakan industri yang dikelola oleh tenaga professional muda yang penuh kreativitas dan inovasi serta mempunyai semangat kerja yang tinggi, atas kepercayaan dari konsumen yang masih kerjasama dengan kami dari perusahaan, instansi, lembaga pendidikan, organisasi, dan komunitas. Kami terus menerus mengembangkan sumber daya manusia maupun alat-alat pendukung usaha
                        </p>
                        <br>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6 offset-2">
                    <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?f=q&source=s_q&hl=en&geocode=&q=15+Springfield+Way,+Hythe,+CT21+5SH&aq=t&sll=52.8382,-2.327815&sspn=8.047465,13.666992&ie=UTF8&hq=&hnear=15+Springfield+Way,+Hythe+CT21+5SH,+United+Kingdom&t=m&z=14&ll=51.077429,1.121722&output=embed"></iframe>
                </div>
                
                <div class="col-4">
                    <h2>Rumah Retro Bandung</h2>
                    <address>
                        <strong>Rumah Retro Bandung</strong><br>
                        Jalan Gempol Elok II<br>
                        No 34 RT 05 RW 13<br>
                        Kel, Cigondewah Kaler<br>
                        Bandung<br>
                        <abbr title="Phone">P:</abbr> 0895-3561-19072 <br>
                        <abbr title="Email">P:</abbr> rumahretrokonveksi@gmail.com
                    </address>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Method End-->
@endsection
@section("js")
{{-- <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
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

@section('css')
{{-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css"> --}}
@endsection
