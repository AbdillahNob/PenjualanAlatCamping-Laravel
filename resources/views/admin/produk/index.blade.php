@extends('admin.layouts.index')

@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Produk</a></li>
            </ol>
        </div>

    </div>


    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="header-right">
                            <div class="input-group icons">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3"
                                        id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                                </div>
                                <input type="search" class="form-control" placeholder="Cari Alat Camping"
                                    aria-label="Cari Alat Camping">
                                <div class="drop-down animated flipInX d-md-none">
                                    <form action="#">
                                        <input type="text" class="form-control" placeholder="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title">Produk</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle">
                                <thead>

                                    <tr>
                                        <th scope="col">No</th>
                                        <th>Customer</th>
                                        <th>Jenis Laundry</th>
                                        <th>berat</th>
                                        <th>Harga/Kg</th>
                                        <th>Total</th>
                                        <th>Metode Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
    <!--**********************************
                                                                                    Content body end
                                                                                ***********************************-->


    <!--**********************************
                                                                                    Footer start
                                                                                ***********************************-->
    <!--**********************************
                                                                                    Footer end
                                                                                    ***********************************-->
    {{-- <div class="footer">
                <div class="copyright">
                    <p>Copyright &copy; Designed & Developed by <a
                            href="https://themeforest.net/user/quixlab">Quixlab</a>
                        2018</p>
                </div>
            </div> --}}
</div>
@endsection