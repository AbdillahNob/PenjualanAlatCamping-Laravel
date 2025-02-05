@extends('customer.layouts.index')

@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">CHECKOUT</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Checkout Pesanan Anda</h4>

                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('bayar.checkout', $checkout->id) }}"
                                method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $checkout->id}}">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nama Pemesan<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control"
                                            value="{{ $checkout->user->namaLengkap }}" name="namaLengkap" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nomor Telepon
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="{{ $checkout->user->noTelpon }}"
                                            name="noTelpon">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nama Produk<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control"
                                            value="{{ $checkout->produk->namaProduk }}" name="namaProduk"
                                            placeholder="{{ $checkout->produk->namaProduk }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Stok
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="{{ $checkout->produk->stok }}"
                                            id="stok" name="stok" placeholder="{{ $checkout->produk->stok }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Jumlah Pesanan<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="jumlahPesanan"
                                            name="jumlahPesanan" value="{{ $checkout->jumlahPesanan }}"
                                            placeholder="Masukkan Jumlah Pesanan.." oninput="hitungTotal()">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Harga
                                        /unit<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="{{ $checkout->produk->harga }}"
                                            id="harga" name="harga"
                                            placeholder="{{ number_format($checkout->produk->harga, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Total Pembayaran<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" id="totalPembayaran" class="form-control"
                                            name="totalPembayaran"
                                            value="{{ number_format($checkout->totalPembayaran, 0, ',', '.')}}"
                                            placeholder="Masukkan Total Pembayaran.." readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary" id="pay-button">Submit</button>
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
<!-- Tambahkan Midtrans Snap -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script>
document.getElementById('pay-button').addEventListener('click', function(event) {
    event.preventDefault();

    snap.pay("{{ $snapToken }}", {
        onSuccess: function(result) {
            sendPaymentData(result);
        },
        onPending: function(result) {
            alert("Menunggu pembayaran!");
        },
        onError: function(result) {
            alert("Pembayaran gagal!");
        }
    });
});

function sendPaymentData(result) {
    $.ajax({
        url: "{{ route('midtrans.callback') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            order_id: "{{ 'ORDER-' . $checkout->id }}",
            transaction_status: result.transaction_status,
            totalPembayaran: document.getElementById('totalPembayaran').value
        },
        success: function(response) {
            alert("Pembayaran berhasil!");
            window.location.href = "{{ route('customer.riwayat') }}";
        },
        error: function(response) {
            alert("Gagal menyimpan pembayaran.");
        }
    });
}
</script>

<script>
function hitungTotal() {
    var jumlah = parseFloat(document.getElementById('jumlahPesanan').value);
    var harga = parseFloat(document.getElementById('harga').value);

    if (!isNaN(jumlah) && !isNaN(harga)) {
        var total = jumlah * harga;
        document.getElementById('totalPembayaran').value = total.toFixed();
    } else {
        document.getElementById('totalPembayaran').value = "";

    }

}

// Panggil hitungTotal() setelah halaman dimuat untuk menghitung nilai default
window.onload = function() {
    hitungTotal();
}

document.getElementById('jumlahPesanan').addEventListener('input', hitungTotal);
</script>
@endsection