@extends('customer.layouts.index')

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
                        <form method="GET" action="{{ route('customer.produk') }}">
                            <div class="header-right">
                                <div class="input-group icons">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3"
                                            id="basic-addon1">
                                            <i class="mdi mdi-magnify"></i>
                                        </span>
                                    </div>
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Cari Alat Camping" aria-label="Cari Alat Camping"
                                        value="{{ request()->query('search') }}">

                                </div>
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </form>

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
                                        <th>Pesan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    $search = request()->query('search');
                                    @endphp
                                    @foreach ($data as $v)
                                    @if(empty($search) || stripos($v->namaProduk, $search) !== false)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $v->namaProduk }}</td>
                                        <td style="text-transform:uppercase">{{ $v->jenisProduk }}</td>
                                        <td>{{ $v->stok }}</td>
                                        <td>Rp. {{ number_format($v->harga, 0, ',', '.') }}</td>
                                        <td>{{ $v->jumlahTerjual }}</td>
                                        <td>
                                            <span>
                                                <a href="{{ route('pesan.produk', $v->id) }}" class="btn btn-warning"
                                                    data-toggle="tooltip" data-placement="top" title="Pesan">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection