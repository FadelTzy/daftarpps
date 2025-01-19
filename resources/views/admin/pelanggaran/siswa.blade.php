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
    Data Pelanggaran Siswa
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Data Pelanggaran Siswa {{ $user->name }} | {{ $user->username }}
            </h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="card">

                        <div class="card-body">
                            <img src="{{ asset('asset/img/user1.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-9 col-lg-9">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-body">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-primary text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-user"></i>Nama :
                                                {{ $user->name }}</a></li>
                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-warning text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-book"></i>
                                                Kelas : {{ $user->kelas }}</a></li>

                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-success text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-key"></i>
                                                NIS : {{ $user->kode }}</a></li>

                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-danger text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-tachometer-alt"></i>
                                                Poin Pelanggaran : <span id="tp"></span></a></li>
                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-secondary text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-users"></i>
                                                Sanksi Terakhir :
                                                @if ($pt)
                                                    Menuju {{ $bp->poin }} Poin, Sisa <span id="sp"></span>
                                                @else
                                                    Tidak Ada Sanksi | Menuju {{ $bp->poin }} Poin, Sisa <span
                                                        id="sp"></span>
                                                @endif
                                            </a></li>

                                    </ol>
                                </nav>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                @if (Auth::user()->role == 2)
                                <h4> Pelanggaran Ku</h4>

                                @else
                                    <h4>Manajemen Data Pelanggaran Siswa</h4>
                                @endif

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    @if (Auth::user()->role == 2)
                                    @else
                                        <button data-toggle="modal" data-target="#exampleModal"
                                            href="features-post-create.html" class="btn btn-success">Tambah</button>
                                        <a href="{{ route('pesi.index') }}" class="btn btn-primary">Kembali</a>
                                    @endif
                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">
                                                no
                                            </th>
                                            <th>Pelanggaran</th>
                                            <th>Poin</th>
                                            <th>Penanganan</th>
                                            <th>Tanggal Input</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pelanggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form id="dataperiode" method="POST">
                            <div class="card-body">

                                @csrf
                                <div class="form-group">
                                    <label for="Nama">Pelanggaran</label>
                                    <div class="input-group">

                                        <select name="pelanggaran" id="pelanggaran" class="form-control">
                                            <option selected disabled>Pilih Data Pelanggaran</option>
                                            @foreach ($data as $item)
                                                <option data-val="{{ $item }}" value="{{ $item->id }}">
                                                    {{ $item->pelanggaran }} | Poin : {{ $item->poin }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <input type="hidden" name="idbatas" value="{{ $bp->id }}">
                                    <input type="hidden" name="iduser" value="{{ $user->id }}">
                                    <input type="hidden" name="idpelanggaran" id="idpelanggaran">
                                    <label for="Nama">Jenis Pelanggaran</label>
                                    <div class="input-group">

                                        <input type="text" name="jenis" id="jenispelanggaran"
                                            placeholder="Input jenis" class="form-control phone-number">
                                    </div>
                                    <br>
                                    <label for="Nama">Poin</label>

                                    <div class="input-group">

                                        <input type="text" name="poin" id="poin"
                                            placeholder="Input poin pelanggaran" class="form-control phone-number">
                                    </div>
                                    <br>
                                    <label for="Nama">Penanganan</label>

                                    <div class="input-group">

                                        <input type="text" name="tindaklanjut" id="tindaklanjut"
                                            placeholder="Input penanganan" class="form-control phone-number">
                                    </div>


                                </div>



                                {{-- <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right "></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button id="datasubmit" type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="up">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pelanggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dataperiodeu" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" name="id" id="idu">
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <div class="input-group">

                                    <input type="text" id="namau" name="nama" placeholder="Input Nama"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">nip</label>

                                <div class="input-group">

                                    <input type="text" id="nipu" name="nip" placeholder="Input nip"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Alamat</label>

                                <div class="input-group">

                                    <input type="text" id="alamatu" name="alamat" placeholder="Input Alamat"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Email</label>

                                <div class="input-group">

                                    <input type="text" id="emailu" name="email" placeholder="Input Email"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Nomor</label>

                                <div class="input-group">

                                    <input type="text" id="nomoru" name="nomor" placeholder="Input No"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Password</label>

                                <div class="input-group">

                                    <input type="text" name="password" placeholder="Set Password Baru"
                                        class="form-control phone-number">
                                </div>
                            </div>


                            {{-- <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right "></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </div> --}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button id="datasubmitu" type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js ">
    </script>
    <script src="{{ asset('stisla/assets/modules/prism/prism.js') }}"></script>
    <!-- Page Specific JS File -->
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('stisla/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/izitoast/js/iziToast.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = window.location.origin;
        $("#pelanggaran").on('change', function(id) {
            var data = $(this).find(':selected').data('val')
            $("#jenispelanggaran").val(data.pelanggaran);
            $("#poin").val(data.poin);
            $("#tindaklanjut").val(data.tindaklanjut);

            $("#idpelanggaran").val(data.id);

            console.log(data);
        })

        jQuery(document).ready(function() {

            tabel = $("#dt").DataTable({
                "drawCallback": function(settings) {
                    var api = this.api();
                    console.log(api.rows()[0].length)
                    $("#pengajuannya").html(api.rows()[0].length)
                    // api.column( 4, {page:'current'} ).data().sum();
                    var n = api
                        .column(2)
                        .data()
                        .reduce(function(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                    $("#tp").html(n);
                    var totalpoin = '{{ $bp->poin }}';
                    totalpoin = parseInt(totalpoin) - parseInt(n);
                    $("#sp").html(totalpoin);


                },
                columnDefs: [{
                        targets: 0,
                        width: "1%",
                    },
                    {
                        targets: 1,
                        width: "25%",

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "10%",

                    },
                    {
                        orderable: false,

                        targets: 3,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 4,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 5,
                        width: "20%",

                    },

                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url + "/admin/data-pelanggaran/" + '{{ Request::segment(3) }}',
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'namalanggar',
                        data: 'namalanggar'
                    },
                    {
                        nama: 'poinpelanggaran',
                        data: 'poinpelanggaran'
                    },
                    {
                        nama: 'tindaklanjutnya',
                        data: 'tindaklanjutnya'
                    },
                    {
                        nama: 'tanggalnya',
                        data: 'tanggalnya'
                    },

                    {
                        name: 'aksi',
                        data: 'aksi',
                    }
                ],

            });



        });
        $("#datasubmit").on('click', function() {
            $("#dataperiode").trigger('submit');
        });
        $("#datasubmitu").on('click', function() {
            $("#dataperiodeu").trigger('submit');
        });
        $("#dataperiode").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('pelanggaransiswa.store') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");
                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div><ul>';

                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        iziToast.error({
                            title: 'Error',
                            message: elem,
                            position: 'topRight'
                        });

                    }
                    if (id.status == 'success') {
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Data tersimpan',
                            position: 'topRight'
                        });
                        $("#exampleModal").modal('hide');
                        tabel.ajax.reload();

                    }
                    if (id.status == 'warning') {
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Data tersimpan',
                            position: 'topRight'
                        });
                        $("#exampleModal").modal('hide');
                        tabel.ajax.reload();
                        location.reload();

                    }
                }
            })


        });
        $("#dataperiodeu").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('pelanggaran.update') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");
                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div><ul>';

                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        iziToast.error({
                            title: 'Error',
                            message: elem,
                            position: 'topRight'
                        });

                    } else {
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Data tersimpan',
                            position: 'topRight'
                        });
                        $("#up").modal('hide');
                        tabel.ajax.reload();

                    }
                }
            })


        });

        function staffdel(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/data-pelanggaran/siswa/' + id,
                    type: "delete",
                    success: function(e) {
                        console.log(e);
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            tabel.ajax.reload();

                        }
                    }
                })

            }
        }

        function staffaktif(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/periode/' + id + '/aktif',
                    type: "post",
                    success: function(e) {
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            tabel.ajax.reload();

                        }
                    }
                })

            }
        }

        function staffupd(id) {
            $('#up').modal('show');

            $("#namau").val(id.name);
            $("#alamatu").val(id.alamat);
            $("#emailu").val(id.email);
            $("#nipu").val(id.kode);
            $("#nomoru").val(id.no);

            $("#idu").val(id.id);



        }
    </script>
@endpush
