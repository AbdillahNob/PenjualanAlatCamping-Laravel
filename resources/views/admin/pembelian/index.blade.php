@extends('admin.layouts.index')

@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Produk Terjual</a></li>
            </ol>
        </div>

    </div>


    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Riwayat Produk Terjual</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle">
                                <thead>

                                    <tr>
                                        <th scope="col">No</th>
                                        <th>Nama Customer</th>
                                        <th>No Telpon</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah Pesanan</th>
                                        <th>Total Pembayaran</th>
                                        <th>Tanggal Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $v)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $v->user->namaLengkap }}</td>
                                        <td>{{ $v->user->noTelpon }}</td>
                                        <td style="text-transform:uppercase">{{ $v->produk->namaProduk }}</td>
                                        <td>Rp. {{ number_format($v->produk->harga, 0, ',', '.') }}</td>
                                        <td>{{ $v->jumlahPesanan }}</td>
                                        <td>Rp. {{ number_format($v->totalPembayaran, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($v->updated_at)->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
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