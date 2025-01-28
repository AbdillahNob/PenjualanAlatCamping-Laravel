<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>Bentala Outdoor</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/logoBentala.JPEG') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('admin/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>
<style>
/* Header utama */
.header {
    background-color: #343a40;
    /* Warna latar belakang header */
    padding: 15px 0;
}

/* Mengatur isi header agar di tengah */
.header-content {
    display: flex;
    /* Membuat elemen dalam header horizontal */
    justify-content: center;
    /* Pusatkan elemen secara horizontal */
    align-items: center;
    /* Pusatkan elemen secara vertikal */
}

/* Kontainer untuk logo dan nama toko */
.header-right {
    display: flex;
    align-items: center;
    /* Pastikan elemen berada dalam satu garis */
    gap: 10px;
    /* Jarak antara logo dan nama toko */
}

/* Gaya logo */
.header-right img {
    width: 100px;
    /* Ukuran logo */
    height: auto;
}

/* Gaya nama toko */
.header-right h4 {
    color: rgb(201, 26, 26);
    /* Warna teks */
    font-size: 25px;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    /* Ukuran teks */
    margin: 0;
    /* Hilangkan margin bawaan */
}
</style>

<body>
    <div id="main-wrapper">
        @include('customer.layouts.header')

        @include('customer.layouts.sidebar')

        @yield('content')

        @include('customer.layouts.footer')

    </div>
</body>