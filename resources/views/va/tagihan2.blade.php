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
                                <h4>Manajemen Data Virtual Akun Tagihan Mahasiswa</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <button onclick="deleteall('{{ $datava }}')" class="btn btn-warning">Delete
                                        All</button>
                                    <button onclick="generateall('{{ $datava }}')" class="btn btn-primary">Generate
                                        All</button>
                                    <button onclick="updateall('{{ $datava }}')" class="btn btn-primary">Generate yang
                                        belum
                                        All</button>
                                    <button onclick="inquiryall('{{ $datava }}')" class="btn btn-primary">Inquiry
                                        All</button>
                                    {{-- <button data-toggle="modal" data-target="#exampleModal" href="features-post-create.html"
                                        class="btn btn-primary">Tambah</button> --}}
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
                                            <th>Status</th>

                                            <th>Tagihan</th>
                                            <th>Periode</th>

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
                            <input type="hidden" name="id" id="idu"va>
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
                                <label for="Username">No Ref</label>
                                <div class="input-group">

                                    <input type="text" id="refi" readonly class="form-control phone-number">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modalchangeva">
        <div class="modal-dialog  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit VA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formeditva" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" name="id" id="idvau">
                            <div class="form-group">
                                <label for="Nama">VA</label>
                                <div class="input-group">

                                    <input type="text" id="vau" name="va" class="form-control ">
                                </div>

                                <br>
                                <label for="Username">No Ref</label>
                                <div class="input-group">

                                    <input type="text" id="norefu" name="noref" class="form-control ">
                                </div>
                                <br>
                                <label for="Nama">Tagihan</label>

                                <div class="input-group">

                                    <input type="text" id="tagihanu" name="tagihan" class="form-control ">
                                </div>
                                <br>


                            </div>


                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right "></label>
                                <div class="col-sm-12 col-md-7">
                                    <button id="btneditva" type="button" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
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
                    {
                        orderable: false,

                        targets: 7,
                        width: "20%",

                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('statusdata.index') }}",
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
                        data: function(id) {
                            return id['o_b']['ref'];

                        }
                    },
                    {
                        nama: 'vanya',
                        data: 'va'
                    },
                    {
                        nama: 'statusnya',
                        data: 'statusnya'
                    },
                    {
                        nama: 'rupiah',
                        data: function(id) {
                            return rupiah(id['o_b']['tagihan']);

                        }
                    },
                    {
                        nama: 'statusnya',
                        data: 'periode'
                    },
                    {
                        name: 'aksi',
                        data: 'aksi',
                    }
                ],

            });



        });
        $("#btneditva").on('click', function() {
            $("#formeditva").trigger('submit');
        });

        function generateall(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");

            let dd = JSON.parse(id);
            if (data) {

                dd.forEach(element => {
                    createvaall(element);
                    return 'done';
                    console.log(element)
                });
            }
        }

        function updateall(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");

            let dd = JSON.parse(id);
            if (data) {

                dd.forEach(element => {
                    console.log(element);
                    if (element.o_b.statusva == null) {

                        updatevaall(element);
                    }
                    return 'done';
                    console.log(element)
                });
            }
        }

        function inquiryall(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");

            let dd = JSON.parse(id);
            if (data) {

                dd.forEach(element => {
                    if (element.o_b.statusva == null) {

                        inquiryvaall(element);
                    }
                    return 'done';
                    console.log(element)
                });
            }
        }

        function deleteall(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");

            let dd = JSON.parse(id);
            if (data) {

                dd.forEach(element => {
                    deletevall(element);
                    return 'done';
                    console.log(element)
                });
            }
        }
        $("#formeditva").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('change.va') }}',
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

                    }
                    tabel.ajax.reload();

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

        function generate(id) {
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
                    url: url + '/admin/data-va/',
                    type: "post",
                    data: id,
                    success: function(e) {
                        $.LoadingOverlay("hide");
                        console.log(e);
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
                    url: url + '/admin/proses/data-va2/',
                    type: "post",
                    data: {
                        id,
                        type: 1
                    },
                    success: function(e) {
                        // tabel.ajax.reload();

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

        function createvaall(id) {
            console.log(id);
            // return 0;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/proses/data-va2/',
                type: "post",
                data: {
                    id,
                    type: 1
                },
                success: function(e) {
                    // tabel.ajax.reload();

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

        function updatevaall(id) {

            console.log(id);
            // return 1;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/proses/data-va2/',
                type: "post",
                data: {
                    id,
                    type: 7
                },
                success: function(e) {
                    // tabel.ajax.reload();

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

        function updateva(id) {
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
                    url: url + '/admin/proses/data-va2/',
                    type: "post",
                    data: {
                        id,
                        type: 3
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

        function changeva(va, id, tagihan, noref) {
            $("#modalchangeva").modal('show');
            $("#idvau").val(va['id']);
            $("#vau").val(va['va']);
            $("#tagihanu").val(va['tagihan']);
            $("#norefu").val(va['no_ref']);

            // console.log(va);
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
                    url: url + '/admin/proses/data-va2/',
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
                        if (e.status == 'fail2') {
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

        function deletevall(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/proses/data-va2/',
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
                    if (e.status == 'fail2') {
                        iziToast.error({
                            title: 'Gagal!',
                            message: e.message,
                            position: 'topRight'
                        });
                    }
                }
            })
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
                    url: url + '/admin/proses/data-va2/',
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
                    url: url + '/admin/proses/data-va2/',
                    type: "post",
                    data: {
                        id,
                        type: 2
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
                            $("#refi").val(e.message.ref);

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

        function inquiryvaall(id) {

            // return 0;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/proses/data-va2/',
                type: "post",
                data: {
                    id,
                    type: 2
                },
                success: function(e) {
                    // tabel.ajax.reload();

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
