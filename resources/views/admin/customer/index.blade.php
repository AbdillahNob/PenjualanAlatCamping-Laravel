@extends('admin.layouts.index')

@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            </ol>
        </div>

    </div>


    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Customer</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle">
                                <thead>

                                    <tr>
                                        <th scope="col">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>No.Telpon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $v)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td style="text-transform:uppercase">{{ $v->namaLengkap }}</td>
                                        <td>{{ $v->username }}</td>
                                        <td>{{ $v->jenisKelamin }}</td>
                                        <td>{{ $v->alamat }}</td>
                                        <td>{{ $v->noTelpon }}</td>
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