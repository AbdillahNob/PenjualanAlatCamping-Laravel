@extends('admin.layouts.index')

@section('content')
<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">

            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Produk Terjual</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">20</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Jumlah Produk</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $dataP }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">Jumlah Customer</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $dataC }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>


        {{-- <div class="footer">
                <div class="copyright">
                    <p>Copyright &copy; Designed & Developed by <a
                            href="https://themeforest.net/user/quixlab">Quixlab</a>
                        2018</p>
                </div>
            </div> --}}
    </div>
    @endsection