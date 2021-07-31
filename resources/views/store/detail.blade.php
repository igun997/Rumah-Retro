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
                        @php
                        $total = 0;
                        @endphp
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
                                    @php
                                        $total += $row->quantity
                                    @endphp
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
                            <td>

                            </td>
                            <td></td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                Ekspedisi
                            </td>
                            <td>
                                <select name="exp" id="exp" class="form-control">
                                    <option>== Pilih ==</option>
                                    <option value="jne">JNE</option>
                                    <option value="sicepat">Si Cepat</option>
                                    <option value="wahana">Wahana</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                Provinsi
                            </td>
                            <td>
                                <select name="provinsi" id="provinsi" class="form-control">
                                    <option>== Pilih ==</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                Kota
                            </td>
                            <td>
                                <select name="kota" id="kota" class="form-control">
                                    <option>== Pilih ==</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                Kecamatan
                            </td>
                            <td>
                                <select name="kecamatan" id="kecamatan" class="form-control">
                                    <option>== Pilih ==</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>



                        <tr class="bottom_button">
                            <td>
                                <b>Total Biaya Pengiriman</b>
                            </td>
                            <td id="ongkir">Rp. 0,-</td>
                            <td></td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                <b>Catatan</b>
                            </td>
                            <td id="catatan">
                                <textarea id="notes" id="" cols="30" rows="10" class="form-control"></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h2 id="total">Rp. 0</h2>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn_1" href="/">Lanjutkan Belanja</a>
                        <button class="btn_1 checkout_btn_1" id="lanjutkan" >Lanjutkan</button>
                        <button class="btn_1 checkout_btn_1 " id="submit_data" >Proses Pembayaran</button>
                    </div>
                </div>
            </div>
        </div></section>
@endsection

@section("js")
    <script>
        $(document).ready(()=>{

            $("select").niceSelect("destroy");
            $("#submit_data").hide();
            $("#lanjutkan").on("click",function (){
                $("select").prop("disabled",true)
                $("textarea").prop("disabled",true)
                $("input").prop("disabled",true)
                $("#lanjutkan").hide();
                $("#submit_data").show();
            })
            const berat_barang = {{@($total/4)*1000}};
            @if(session()->get("id"))
            const subtotal = {{@str_replace(",","",(Cart::session(session()->get("id"))->getTotal()))}};
            @endif
            async function loadProvince(){
                const req = await fetch("{{route("store.provinsi")}}");
                const _data =  await req.json();
                console.log(_data)
                if(_data.code === 200){
                    $("#provinsi").html("");
                    for (const _key in _data.data) {
                        const _keDtaa = _data.data[_key];
                        $("#provinsi").append("<option value='"+_keDtaa.province_id+"'>"+_keDtaa.province+"</option>");
                    }
                }
                $("select").niceSelect("update");
            }
            async function loadCity(id=null){
                let req;
                if (id !== null){
                    req = await fetch("{{route("store.kota")}}/"+id);
                }else{
                    req = await fetch("{{route("store.kota")}}");
                }

                const _data =  await req.json();
                console.log(_data)
                if(_data.code === 200){
                    $("#kota").html("");
                    for (const _key in _data.data) {
                        const _keDtaa = _data.data[_key];
                        $("#kota").append("<option value='"+_keDtaa.city_id+"'>"+_keDtaa.city_name+"</option>");
                    }
                }
                $("select").niceSelect("update");
            }
            async function loadDistrict(id=null){
                let req;
                if (id !== null){
                    req = await fetch("{{route("store.kecamatan")}}/"+id);
                }else{
                    req = await fetch("{{route("store.kecamatan")}}");
                }


                const _data =  await req.json();
                console.log(_data)
                if(_data.code === 200){
                    $("#kecamatan").html("");
                    for (const _key in _data.data) {
                        const _keDtaa = _data.data[_key];
                        $("#kecamatan").append("<option value='"+_keDtaa.subdistrict_id+"'>"+_keDtaa.subdistrict_name+"</option>");
                    }
                }
                $("select").niceSelect("update");
            }
            loadProvince();
            let total_all = 0;
            async function ongkir(dest,berat,exp){
                const  req = await fetch("{{route("store.cek_ongkir")}}?dest="+dest+"&berat="+berat+"&expedisi="+exp);
                const _data =  await req.json();
                if(_data.code === 200){
                    if(_data.data){
                        let harga = _data.data.costs[0].cost[0].value
                        console.log(harga)
                        $("#ongkir").html("Rp. "+parseFloat(harga));
                        $("#total").html("Rp. "+(parseFloat(harga)+parseFloat(subtotal)));
                        total_all = (parseFloat(harga)+parseFloat(subtotal));
                    }else{
                        toastr.error("Gagal Kalkulasi");
                    }
                }
            }
            $("#provinsi").on("change",function (e){
                loadCity($(this).val());
            })
            $("#kota").on("change",function (e){
                loadDistrict($(this).val());
            })
            $("#kecamatan").on("change",function (e){
                console.log("Ongkir Now");
                let district_id = $(this).val();
                console.log("berat",berat_barang)
                console.log(district_id)
                ongkir(district_id,berat_barang,$("#exp").val())
            })
            $("#submit_data").on("click",function (){
                location.href="{{route("store.cart_finish")}}?total="+total_all+"&notes="+$("#notes").val()+"<br>Ekspedisi : "+$("#exp").val()
            });

        })
    </script>
@endsection

