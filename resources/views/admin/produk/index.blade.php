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
                            <a href="{{ route('create.produk') }}"><button class="btn btn-primary mb-3">Tambah
                                    Produk</button></a>
                        </div>

                        <h4 class="card-title">Produk</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle">
                                <thead>

                                    <tr>
                                        <th scope="col">No</th>
                                        <th>Nama Produk</th>
                                        <th>Jenis Produk</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Jumlah Terjual</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $v)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $v->namaProduk }}</td>
                                        <td style="text-transform:uppercase">{{ $v->jenisProduk }}</td>
                                        <td>{{ $v->stok }}</td>
                                        <td>Rp. {{ number_format($v->harga, 0, ',', '.') }}</td>
                                        <td>{{ $v->jumlahTerjual }}</td>
                                        <td>
                                            <span>
                                                <a href="{{ route('edit.produk', $v->id) }}" class="btn btn-warning"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('destroy.produk', $v->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah anda yakin ingin menghapus produk ini ?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger"
                                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus produk ini ?')">
                                                        <i class="fa fa-close color-danger" onPre></i>
                                                    </button>
                                                </form>
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