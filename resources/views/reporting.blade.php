<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Reporting &mdash; BK</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/chocolat/dist/css/chocolat.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-8 col-md-6 mx-auto offset-md-1 col-lg-6 mx-auto offset-lg-1">
                        <div class="login-brand">
                            Laporan Kelakuan Baik Siswa
                        </div>
                        <div class="card card-primary">
                            <div class="row m-0">
                                <div class="col-12 col-md-9 col-lg-9 p-0">
                                    <div class="card-header text-center">
                                        <h4>Biodata Siswa</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <tr>
                                                <th>Nama</th>
                                                <th> : </th>
                                                <th>{{ $id->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Kelas</th>
                                                <th> : </th>
                                                <th>{{ $id->kelas }}</th>
                                            </tr>
                                            <tr>
                                                <th>NISN</th>
                                                <th> : </th>
                                                <th>{{ $id->kode }}</th>
                                            </tr>
                                            <tr>
                                                <th>Guru BK</th>
                                                <th> : </th>
                                                <th>{{ $id->oBk->name }}</th>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3 px-3" style="height: 200px">
                                    <div class="card-header text-center">
                                        <h4></h4>
                                    </div>
                                    <div class="chocolat-parent mb-0 pb-0">
                                        <a href="{{ asset('ggwp.jpg') }}" class="chocolat-image"
                                            title="Just an example">
                                            <div data-crop-image="285">
                                                @if ($id->foto)
                                                    <img height="0"class="img-fluid" src="{{ asset('img/siswa/') . '/' . $id->foto }}"
                                                        alt="">
                                                @else
                                                    <img height="0"class="img-fluid" src="{{ asset('ggwp.jpg') }}"
                                                        alt="">
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 mx-auto offset-md-1 col-lg-12 mx-auto offset-lg-1">

                        <div class="card card-primary">
                            <div class="row m-0">
                                <div class="col-12 col-md-12 col-lg-8 p-0">
                                    <div class="card-header text-center">
                                        <h4>Poin Pelanggaran</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <table class="table table-sm">
                                                @php
                                                    $no = 1;
                                                    $total = 0;
                                                @endphp
                                                <tr>
                                                    <th>No</th>
                                                    <th>Pelanggaran</th>
                                                    <th>Poin </th>
                                                    <th>Tanggal</th>
                                                </tr>
                                                @foreach ($ps as $item)
                                                    <tr>
                                                        <th>{{ $no++ }}</th>
                                                        <th>{{ $item->oLanggar->pelanggaran }}
                                                            @if ($item->oLanggar->level == 1)
                                                                <span class="badge badge-primary">Ringan</span>
                                                            @endif
                                                            @if ($item->oLanggar->level == 2)
                                                                <span class="badge badge-warning">Sedang</span>
                                                            @endif
                                                            @if ($item->oLanggar->level == 3)
                                                                <span class="badge badge-danger">Berat</span>
                                                            @endif
                                                        </th>
                                                        <th>{{ $item->poinpelanggaran }} </th>
                                                        <th>{{ $item->created_at->format('d/m/Y') }}</th>
                                                    </tr>
                                                    @php
                                                        $total = $total + $item->poinpelanggaran;
                                                    @endphp
                                                @endforeach


                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-4 p-0">
                                    <div class="card-header text-center">
                                        <h4>Total Poin</h4>
                                    </div>

                                    <div class="card-body">
                                        <h1 style="font-size: 400%"> {{ $total }} </h1>
                                        <b> Sanksi Terakhir </b>:
                                        @if ($pt)
                                            Menuju {{ $bp->poin }} Poin, Sisa <span
                                                id="sp">{{ $bp->poin - $total }}</span>
                                            Tindak Lanjut : {{ $pt->tindaklanjut }}
                                            @if ($pt->status == 2)
                                                <span class="badge badge-sm badge-warning">Belum Ditindak</span>
                                            @endif
                                            @if ($pt->status == 1)
                                                <span class="badge badge-sm badge-success">Telah Ditindak</span>
                                            @endif
                                        @else
                                            Tidak Ada Sanksi | Menuju {{ $bp->poin }} Poin, Sisa <span
                                                id="sp">{{ $bp->poin - $total }}</span>
                                        @endif
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 mx-auto offset-md-1 col-lg-12 mx-auto offset-lg-1">

                        <div class="card card-primary">
                            <div class="row m-0">
                                <div class="col-12 col-md-12 col-lg-12 p-0">
                                    <div class="card-header text-center">
                                        <h4>Riwayat Sanksi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <table class="table table-sm">
                                                @php
                                                    $no = 1;
                                                    $total = 0;
                                                @endphp
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tindak Lanjut</th>
                                                    <th>Poin Pelanggaran </th>
                                                    <th>Status</th>

                                                    <th>Tanggal</th>
                                                </tr>
                                                @foreach ($rs as $item)
                                                    <tr>
                                                        <th>{{ $no++ }}</th>
                                                        <th>{{ $item->tindaklanjut }}

                                                        </th>
                                                        <th>{{ $item->poin }} </th>
                                                        <th>
                                                            @if ($item->status == 2)
                                                                <span class="badge badge-sm badge-warning">Belum
                                                                    Ditindak</span>
                                                            @endif
                                                            @if ($item->status == 1)
                                                                <span class="badge badge-sm badge-success">Telah
                                                                    Tindak</span>
                                                            @endif
                                                        </th>

                                                        <th>{{ $item->created_at->format('d/m/Y') }}</th>
                                                    </tr>
                                                @endforeach


                                            </table>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 mx-auto offset-md-1 col-lg-12 mx-auto offset-lg-1">

                        <div class="card card-primary">
                            <div class="row m-0">
                                <div class="col-12 col-md-12 col-lg-12 p-0">
                                    <div class="card-header text-center">
                                        <h4>Riwayat Konsultasi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <table class="table table-sm">
                                                @php
                                                    $no = 1;
                                                    $total = 0;
                                                @endphp
                                                <tr>
                                                    <th>No</th>
                                                    <th>Topik Konsultasi</th>
                                                    <th>Guru BK </th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                                @foreach ($konsul as $item)
                                                    <tr>
                                                        <th>{{ $no++ }}</th>
                                                        <th>{{ $item->judul }}

                                                        </th>
                                                        <th>{{ $item->oGuru->name }} </th>
                                                        <th>
                                                            @if ($item->status == 2)
                                                                <span class="badge badge-sm badge-warning">Sedang</span>
                                                            @endif
                                                            @if ($item->status == 1)
                                                                <span
                                                                    class="badge badge-sm badge-success">Pengajuan</span>
                                                            @endif
                                                        </th>

                                                        <th>{{ $item->created_at->format('d/m/Y') }}</th>
                                                    </tr>
                                                @endforeach


                                            </table>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <div class="login-brand">
                    Tanggal : {{ Date('d/M/Y H:i') }}
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- JS Libraies -->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&amp;sensor=true"></script>

    <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>

    <script src="{{ asset('stisla/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>



    {{-- <script src="{{ asset('stisla/assets/modules/chart.min.js') }}"></script> --}}


    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('stisla/assets/js/page/utilities-contact.js') }}"></script>
</body>

</html>
