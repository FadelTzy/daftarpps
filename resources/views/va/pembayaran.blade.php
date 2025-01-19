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
    Data Virtual Akun
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Data Virtual Akun
            </h1>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                <h4>Manajemen Data Pembayaran</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <button data-toggle="modal" data-target="#exampleModal" href="features-post-create.html"
                                        class="btn btn-primary">Tambah</button>
                                    <a target="_href" href="{{route('ex')}}"
                                        class="btn btn-warning">Export</a>
                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">no</th>
                                            <th>Nama</th>
                                            <th>NIM / Ref</th>
                                            <th>VA</th>
                                            <th>Tagihan</th>
                                            <th>Status Pembayaran</th>
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
                    <h5 class="modal-title">Tambah Data Virtual Akun Tagihan</h5>
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

                                    <label for="Nama">Nama</label>
                                    <div class="input-group">

                                        <input type="text" name="nama" placeholder="Input Nama"
                                            class="form-control phone-number">
                                    </div>

                                    <br>
                                    <label for="Nama">Nim</label>

                                    <div class="input-group">

                                        <input type="text" name="nim" placeholder="Input nim"
                                            class="form-control phone-number">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="Nama">Fakultas</label>

                                            <div class="input-group">

                                                <input type="text" name="fak" placeholder="Input "
                                                    class="form-control phone-number">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="Nama">Kode Fakultas</label>

                                            <div class="input-group">

                                                <input type="text" name="c_fak" placeholder="Input "
                                                    class="form-control phone-number">
                                            </div>
                                        </div>

                                    </div>
                                    <br>

                                    <label for="Nama">Tagihan</label>

                                    <div class="input-group">

                                        <input type="text" name="tagihan" placeholder="Input nim"
                                            class="form-control phone-number">
                                    </div>
                                    <br>

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
                    <h5 class="modal-title">Edit Data Virtual Akun Tagihan</h5>
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
                                <label for="Username">Username</label>
                                <div class="input-group">

                                    <input type="text" id="usernameu" name="username" placeholder="Input Username"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="inquirymodal">
        <div class="modal-dialog  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="card-body">

                            @csrf
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <div class="input-group">

                                    <input type="text" id="namai" readonly placeholder="Input Nama"
                                        class="form-control phone-number">
                                </div>

                                <br>
                                <label for="Username">VA</label>
                                <div class="input-group">

                                    <input type="text" id="vai" readonly class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Tagihan</label>

                                <div class="input-group">

                                    <input type="text" id="tagihani" name="alamat" placeholder="Input Alamat"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Terbayar</label>

                                <div class="input-group">

                                    <input type="text" id="terbayari" name="email" placeholder="Input Email"
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
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="inquirymodalcek">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="card-body">

                            @csrf
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <div class="input-group">

                                    <input type="text" id="namac" readonly placeholder="Input Nama"
                                        class="form-control phone-number">
                                </div>

                                <br>
                                <label for="Username">VA</label>
                                <div class="input-group">

                                    <input type="text" id="vac" readonly class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Username">No Ref</label>
                                <div class="input-group">

                                    <input type="text" id="refc" readonly class="form-control phone-number">
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="Nama">Tagihan</label>

                                        <div class="input-group">

                                            <input type="text" id="tagihanc" name="alamat"
                                                placeholder="Input Alamat" class="form-control phone-number">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="Nama">Terbayar</label>

                                        <div class="input-group">

                                            <input type="text" id="terbayarc" name="email"
                                                placeholder="Input Email" class="form-control phone-number">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="Nama">Teller</label>

                                        <div class="input-group">

                                            <input type="text" id="tellerc" name="alamat"
                                                placeholder="Input Alamat" class="form-control phone-number">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="Nama">Transcode</label>

                                        <div class="input-group">

                                            <input type="text" id="transcodec" name="email"
                                                placeholder="Input Email" class="form-control phone-number">
                                        </div>
                                    </div>
                                </div>

                                <label for="Username">Tanggal Pembayaran</label>
                                <div class="input-group">

                                    <input type="text" id="tanggalc" readonly class="form-control phone-number">
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
        jQuery(document).ready(function() {

            tabel = $("#dt").DataTable({
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
                    {
                        orderable: false,

                        targets: 6,
                        width: "20%",

                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('bayar.index') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'nama',
                        data: 'nama'
                    },
                    {
                        nama: 'no_ref',
                        data: 'nim'
                    },
                    {
                        nama: 'vanya',
                        data: 'vanya'
                    },

                    {
                        nama: 'rupiah',
                        data: function(id) {
                            return rupiah(id['tagihan']);

                        }
                    },
                    {
                        nama: 'statusnya',
                        data: 'statusnya'
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
                url: '{{ route('mahasiswa.store') }}',
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
                        $("#exampleModal").modal('hide');
                        tabel.ajax.reload();

                    }
                }
            })


        });
        $("#dataperiodeu").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('admin.update') }}',
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

        function inquiryva(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            // return 0;
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/proses/data-va/',
                    type: "post",
                    data: {
                        id,
                        type: 2,
                        esteh: 1,

                    },
                    success: function(e) {
                        tabel.ajax.reload();

                        $.LoadingOverlay("hide");
                        console.log(e);
                        if (e.status == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                            $('#inquirymodal').modal('show');
                            $("#namai").val(e.message.nama);
                            $("#vai").val(e.message.va);
                            $("#tagihani").val(rupiah(e.message.tagihan));
                            $("#terbayari").val(rupiah(e.message.terbayar));

                        }
                        if (e.status == 'fail') {
                            iziToast.error({
                                title: 'Gagal!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                        }

                    }
                })

            }
        }

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
                    url: url + '/admin/data-va/' + id,
                    type: "delete",
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

        function generatee(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            // return 0;
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/data-va/cek',
                    type: "post",
                    data: id,

                    success: function(e) {

                        $.LoadingOverlay("hide");
                        console.log(e);
                        // return 1;
                        if (e.status == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Transaksi Sukses',
                                position: 'topRight'
                            });
                            $('#inquirymodalcek').modal('show');
                            $("#namac").val(e.message.nama);
                            $("#vac").val(e.message.va);
                            $("#refc").val(e.message.ref);
                            $("#tellerc").val(e.message.teller);
                            $("#transcodec").val(e.message.transcode);
                            $("#tanggalc").val(e.message.created_at);

                            $("#tagihanc").val(rupiah(e.message.tagihan));
                            $("#terbayarc").val(rupiah(e.message.terbayar));

                        }
                        if (e.status == 'fail') {
                            iziToast.error({
                                title: 'Gagal!',
                                message: e.message,
                                position: 'topRight'
                            });
                        }

                    }
                })

            }
        }

        function createva(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            // return 0;
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/proses/data-va/',
                    type: "post",
                    data: {
                        id,
                        type: 1
                    },
                    success: function(e) {
                        tabel.ajax.reload();

                        $.LoadingOverlay("hide");
                        console.log(e);
                        if (e.status == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                        }
                        if (e.status == 'fail') {
                            iziToast.error({
                                title: 'Gagal!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                        }

                    }
                })

            }
        }

        function deleteva(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            // return 0;
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/proses/data-va/',
                    type: "post",
                    data: {
                        id,
                        type: 4
                    },
                    success: function(e) {
                        tabel.ajax.reload();

                        $.LoadingOverlay("hide");
                        console.log(e);
                        if (e.status == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                        }
                        if (e.status == 'fail') {
                            iziToast.error({
                                title: 'Gagal!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                        }

                    }
                })

            }
        }

        function bayarva(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            // return 0;
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/proses/data-va/',
                    type: "post",
                    data: {
                        id,
                        type: 5
                    },
                    success: function(e) {
                        tabel.ajax.reload();

                        $.LoadingOverlay("hide");
                        console.log(e);
                        if (e.status == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                        }
                        if (e.status == 'fail') {
                            iziToast.error({
                                title: 'Gagal!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                        }

                    }
                })

            }
        }

        function inquiryva(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            // return 0;
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/proses/data-va/',
                    type: "post",
                    data: {
                        id,
                        type: 2,
                        esteh: 1,

                    },
                    success: function(e) {
                        tabel.ajax.reload();

                        $.LoadingOverlay("hide");
                        console.log(e);
                        if (e.status == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                            $('#inquirymodal').modal('show');
                            $("#namai").val(e.message.nama);
                            $("#vai").val(e.message.va);
                            $("#tagihani").val(rupiah(e.message.tagihan));
                            $("#terbayari").val(rupiah(e.message.terbayar));

                        }
                        if (e.status == 'fail') {
                            iziToast.error({
                                title: 'Gagal!',
                                message: e.message.rspdesc,
                                position: 'topRight'
                            });
                        }

                    }
                })

            }
        }
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

        function staffupd(id) {
            $('#up').modal('show');

            $("#namau").val(id.name);
            $("#alamatu").val(id.alamat);
            $("#usernameu").val(id.username);

            $("#emailu").val(id.email);
            $("#nipu").val(id.kode);
            $("#nomoru").val(id.no);

            $("#idu").val(id.id);



        }
    </script>
@endpush
