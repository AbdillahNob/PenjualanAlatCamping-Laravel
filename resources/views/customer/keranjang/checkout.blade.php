@extends('customer.layouts.index')

@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Transaksi</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Data Transaksi</h4>

                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('bayar.checkout', $data->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $data->id}}">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nama Pemesan<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="{{ $data->namaLengkap }}"
                                            name="namaLengkap" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nomor Telepon :
                                        {{ $data->noTelpon }}<span class="text-danger">*</span>
                                    </label>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nama Produk<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="{{ $data->namaProduk }}"
                                            name="namaProduk" placeholder="{{ $data->namaProduk }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Jumlah Pesanan<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="jumlahPesanan" name="jumlahPesanan"
                                            placeholder="Masukkan Jumlah Pesanan.." onkeyup="hitungTotal()">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Harga
                                        /unit<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="{{ $data->harga }}" id="harga"
                                            name="harga" placeholder="{{ $data->harga }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Total Pembayaran<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" id="totalPembayaran" class="form-control"
                                            name="totalPembayaran" value="{{ $data->totalPembayaran}}"
                                            placeholder="Masukkan Total Pembayaran..">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function hitungTotal() {
    var jumlah = parseFloat(document.getElementById('jumlahPesanan'));
    var harga = parseFloat(document.getElementById('harga'));

    if (!isNan(jumlah) && !isNan(harga)) {
        var total = jumlah * harga;
        document.getElementById('totalPembayaran').value = total.toFixed();
    } else {
        document.getElementById('totalPembayaran').value = "";

    }
}
</script>
@endsection