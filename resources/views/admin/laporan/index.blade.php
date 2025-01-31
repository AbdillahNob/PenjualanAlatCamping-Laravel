@extends('admin.layouts.index')

@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Kelola Laporan</a></li>
            </ol>
        </div>

    </div>


    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <h2>Laporan Penjualan</h2>

                        <div class="table-responsive">

                            <!-- Form Filter Tanggal -->
                            <form action="{{ route('proses.laporan') }}" method="GET">
                                <label for="start_date">Dari Tanggal:</label>
                                <input type="date" name="start_date"
                                    value="{{ request('start_date', date('Y-m-01')) }}">

                                <label for="end_date">Sampai Tanggal:</label>
                                <input type="date" name="end_date" value="{{ request('end_date', date('Y-m-d')) }}">

                                <a>
                                    <button class="btn btn-primary mb-3" type="submit">Filter</button>
                                </a>
                            </form>

                            @if(request('start_date') && request('end_date'))
                            <div class="header-right">
                                <a
                                    href="{{ route('cetak.laporan', ['start_date'=>request('start_date'), 'end_date'=>request('end_date')]) }}"><button
                                        class="btn btn-danger mb-3">Cetak PDF
                                    </button></a>
                            </div>
                            @endif

                            <p><strong>Total Produk Terjual:</strong> {{ $totalProdukTerjual }}</p>
                            <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </p>

                            <table border="1" class="table table-bordered verticle-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporan as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->user->namaLengkap }}</td>
                                        <td>{{ $data->produk->namaProduk }}</td>
                                        <td>{{ $data->jumlahPesanan }}</td>
                                        <td>Rp {{ number_format($data->totalPembayaran, 0, ',', '.') }}</td>
                                        <td>{{ date('d-m-Y', strtotime($data->updated_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
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