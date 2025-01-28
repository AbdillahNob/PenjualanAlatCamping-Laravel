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
                        <h4 class="card-title">Edit Alat Camping</h4>
                        <div class="basic-form">
                            <form action="{{ route('update.produk', $data->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="form-row">
                                    <!-- Nama Produk -->
                                    <div class="form-group col-md-6">
                                        <label>Nama Produk</label>
                                        <input type="text" name="namaProduk" class="form-control"
                                            value="{{ $data->namaProduk }}" placeholder="Nama">
                                    </div>
                                    <!-- Pilih Jenis Alat -->
                                    <div class="form-group col-md-6">
                                        <label>Jenis Produk</label>
                                        <select class="form-control" name="jenisProduk" id="val-skill">
                                            <option>-- Pilih Jenis Alat --</option>
                                            <option value="tenda" {{ $data->jenisProduk == 'tenda' ? 'selected' : '' }}>
                                                Tenda</option>
                                            <option value="flysheet"
                                                {{ $data->jenisProduk == 'flysheet' ? 'selected' : '' }}>Flysheet
                                            </option>
                                            <option value="matras"
                                                {{ $data->jenisProduk == 'matras' ? 'selected' : ''}}>Matras</option>
                                            <option value="sleeping bag"
                                                {{$data->jenisProduk == 'sleeping bag' ? 'selected' : ''}}>Sleeping Bag
                                            </option>
                                            <option value="kompor portable"
                                                {{ $data->jenisProduk == 'kompor portable' ? 'selected' : '' }}>Kompor
                                                Portable</option>
                                            <option value="nesting"
                                                {{ $data->jenisProduk == 'nesting' ? 'selected' : '' }}>Nesting</option>
                                            <option value="ransel hiking"
                                                {{ $data->jenisProduk == 'ransel hiking' ? 'selected' : '' }}>Ransel
                                                hiking</option>
                                            <option value="lampu" {{ $data->jenisProduk == 'lampu' ? 'selected' : '' }}>
                                                Lampu</option>
                                            <option value="hammock"
                                                {{ $data->jenisProduk == 'hammock' ? 'selected' : '' }}>Hammock</option>
                                            <option value="kursi dan meja lipat"
                                                {{ $data->jenisProduk == 'kursi dan meja lipat' ? 'selected' : '' }}>
                                                Kursi dan Meja Lipat</option>
                                        </select>
                                    </div>
                                    <!-- Stok -->
                                    <div class="form-group col-md-6">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="form-control" value="{{ $data->stok }}"
                                            placeholder="Stok">
                                    </div>
                                    <!-- Harga -->
                                    <div class="form-group col-md-6">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control"
                                            value="{{ $data->harga }}" placeholder="Harga Produk">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark">Edit</button>
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