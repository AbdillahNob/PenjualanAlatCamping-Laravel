@extends('admin.layouts.index')

@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Produk Alat Camping</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">create</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Alat Camping</h4>
                        <div class="basic-form">
                            <form action="{{ route('store.produk') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <!-- Nama Produk -->
                                    <div class="form-group col-md-6">
                                        <label>Nama Produk</label>
                                        <input type="text" name="namaProduk" class="form-control" placeholder="Nama"
                                            required>
                                    </div>
                                    <!-- Pilih Jenis Alat -->
                                    <div class="form-group col-md-6">
                                        <label>Jenis Produk</label>
                                        <select class="form-control" name="jenisProduk" id="val-skill" required>
                                            <option value="">-- Pilih Jenis Alat --</option>
                                            <option value="tenda">Tenda</option>
                                            <option value="flysheet">Flysheet</option>
                                            <option value="sepatu">Sepatu</option>
                                            <option value="matras">Matras</option>
                                            <option value="sleeping bag">Sleeping Bag</option>
                                            <option value="kompor portable">Kompor Portable</option>
                                            <option value="nesting">Nesting</option>
                                            <option value="ransel hiking">Ransel hiking</option>
                                            <option value="lampu">Lampu</option>
                                            <option value="hammock">Hammock</option>
                                            <option value="kursi dan meja lipat">Kursi dan Meja Lipat</option>
                                        </select>
                                    </div>
                                    <!-- Stok -->
                                    <div class="form-group col-md-6">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="form-control" placeholder="Stok"
                                            required>
                                    </div>
                                    <!-- Harga -->
                                    <div class="form-group col-md-6">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control"
                                            placeholder="Harga Produk" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
@endsection