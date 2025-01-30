@extends('customer.layouts.index')

@section('content')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Keranjang Belanja</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Keranjang Anda</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th>Nama Produk</th>
                                        <th>Jenis Produk</th>
                                        <th>Harga</th>
                                        <th>Checkout</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataKeranjang as $index => $v)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td style="text-transform:uppercase">{{ $v->produk->namaProduk }}</td>
                                        <td>{{ $v->produk->jenisProduk }}</td>
                                        <td>{{ $v->produk->harga }}</td>
                                        <td>
                                            <span>
                                                <a href="{{ route('pesan.checkout', $v->id) }}" class="btn btn-success"
                                                    data-toggle="tooltip" data-placement="top" title="Checkout"><i
                                                        class="fa fa-shopping-cart"></i>
                                                </a>
                                            </span>
                                        </td>
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
    {{-- <div class="footer">
                <div class="copyright">
                    <p>Copyright &copy; Designed & Developed by <a
                            href="https://themeforest.net/user/quixlab">Quixlab</a>
                        2018</p>
                </div>
            </div> --}}
</div>
@endsection