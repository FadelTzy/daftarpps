@extends('ab')

@section('css')
    <!-- CSS Libraries -->
    <!-- CSS Libraries -->
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/izitoast/css/iziToast.min.css') }}">

    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/prism/prism.css') }}">
@endsection

@section('title')
    Data Siswa
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            @if (Auth::user()->role == 2)
                <h1> Dashboard
                </h1>
            @else
                <h1> QR CODE
                </h1>
            @endif

        </div>
        @if (Auth::user()->role == 2)
            <div class="section-body">
                <div class="alert alert-info alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>

                    <div class="alert-body">
                        <div class="alert-title">Selamat Datang Di Dashboard @if (Auth::user()->role == 2)
                                Siswa
                            @else
                                Admin
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        @endif
        <div class="section-body">
            @if (Auth::user()->role == 2)
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pelanggaran </h4>
                                </div>
                                <div class="card-body">
                                    {{ $pl }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4> Sanksi</h4>
                                </div>
                                <div class="card-body">
                                    {{ $sk }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Konsultasi</h4>
                                </div>
                                <div class="card-body">
                                    {{ $kl }}
                                </div>
                            </div>
                        </div>
                    </div>
             
                </div>
            @endif

            <div class="row">
                <div class="col-3">
                    <div class="card">

                        <div class="card-body">
                            <h6>Scan Barcode Siswa : {{ $data->name }}</h6>
                            {!! QrCode::size(240)->generate($qrs) !!}

                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-body">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-primary text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-user"></i> Nama :
                                                {{ $data->name }}</a></li>
                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-warning text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-book"></i>
                                                Kelas : {{ $data->kelas }}</a></li>

                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-success text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-key"></i>
                                                NIS : {{ $data->kode }}</a></li>

                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-danger text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-tachometer-alt"></i>
                                                Poin Pelanggaran :{{ $ps }}</a></li>
                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-info text-white-all">
                                        <li class="breadcrumb-item">
                                            <a href="#"><i class="fas fa-users"></i>
                                                Guru BK : {{ $data->oBk->name }}</a>
                                        </li>

                                    </ol>
                                </nav>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
