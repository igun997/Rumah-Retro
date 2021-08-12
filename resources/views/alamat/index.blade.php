@extends('adminlte::page')

@section('title', ((isset($title))?$title:""))

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Daftar Alamat Pengiriman</div>
                </div>
                <div class="card-body">
                    <form action="{{route("alamat.add_action")}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="A">Alamat Pertama</label>
                            <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{$info->alamat}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="A">Alamat Kedua</label>
                            <textarea name="alamat2" id="" cols="30" rows="10" class="form-control">{{$info->alamat2}}</textarea>
                        </div>

                        <div class="form-group">
                            <button
                                type="submit"
                                class="btn btn-outline-success"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
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
        $(document).ready(function () {

        })
    </script>
@stop
