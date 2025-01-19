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
    Imported Data Gel Aktif
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Imported Data Gel Aktif
            </h1>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                <h4>Manajemen Imported Data Gel Aktif</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <button data-toggle="modal" data-target="#exampleModal" href="features-post-create.html"
                                        class="btn btn-primary">Tambah</button>
                                    <button data-toggle="modal" data-target="#exampleModalIm"
                                        href="features-post-create.html" class="btn btn-primary">Import</button>
                                    <button id="dogenerate" class="btn btn-warning">Generate VA</button>
                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">no</th>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>VA</th>
                                            <th>Prodi</th>
                                            <th>Fakultas</th>
                                            <th>Gelombang</th>
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
                    <h5 class="modal-title">Tambah Data Mahasiswa</h5>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModalIm">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload file</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form id="dataperiodeim" method="POST">
                            <div class="card-body">

                                @csrf
                                <div class="form-group">

                                    <label for="Nama">File Import</label>
                                    <div class="input-group">

                                        <input type="file" name="file" placeholder="Input export"
                                            class="form-control">
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
                    <button id="datasubmitim" type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="up">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dataperiodeu" method="POST">
                        <div class="card-body">

                            @csrf
                            {{-- <input type="hidden" name="gel" id="idu"> --}}

                            <input type="hidden" name="id" id="idu">
                            <div class="form-group">
                                <label for="Nama">NIM</label>
                                <div class="input-group">

                                    <input id="nimu" readonly type="text" name="nim" placeholder=""
                                        class="form-control phone-number">
                                </div>

                                <br>
                                <label for="Nama">Nama</label>
                                <div class="input-group">

                                    <input id="namau" type="text" name="nama" placeholder="Input Nama"
                                        class="form-control phone-number">
                                </div>

                                <br>
                                <label for="Nama">Jenis</label>
                                <div class="input-group">

                                    <input id="jenisu" type="text" name="jenis" placeholder="1 baru 2 lanjut "
                                        class="form-control phone-number">
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="Nama">Deskripsi</label>

                                        <div class="input-group">

                                            <input type="text" id="deskripsiu" name="deskripsi" placeholder="Input "
                                                class="form-control phone-number">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Nama">Periode</label>

                                        <div class="input-group">

                                            <input type="text" name="periode" id="periodeu" placeholder="Input "
                                                class="form-control phone-number">
                                        </div>
                                    </div>

                                </div>
                                <br>

                                <label for="Nama">Tagihan</label>

                                <div class="input-group">

                                    <input type="text" name="tagihan" id="tagihanu" placeholder="Input nim"
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
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button id="datasubmitu" type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalair">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Total</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center">Generating Data ...</h1>
                    <hr>
                    <div class="text-center">
                        <h3 id="berapami"></h3> / <h3 id="totalnya"> </h3>
                    </div>
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
        var totnya = 0;
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
                    url: "{{ route('importdata.index') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'nama',
                        data: 'nama'
                    },
                    {
                        nama: 'nim',
                        data: 'nim'
                    },
                    {
                        nama: 'va',
                        data: 'va'
                    },
                    {
                        nama: 'prodi',
                        data: 'prodi'
                    },
                    {
                        nama: 'fakultas',
                        data: 'fakultas'
                    },
                    {
                        nama: 'gel_buka',
                        data: 'gel_buka'
                    },
                    {
                        name: 'aksi',
                        data: 'aksi',
                    }
                ],

            });



        });
        $("#datasubmitim").on('click', function() {
            $("#dataperiodeim").trigger('submit');
        });
        $("#datasubmit").on('click', function() {
            $("#dataperiode").trigger('submit');
        });
        $("#datasubmitu").on('click', function() {
            $("#dataperiodeu").trigger('submit');
        });
        $("#dataperiodeim").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('importmhspps.import') }}',
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
                },
                error: function(id) {
                    console.log(id);
                    iziToast.error({
                        title: 'Succes!',
                        message: id.error,
                        position: 'topRight'
                    });
                    $.LoadingOverlay("hide");

                }
            })


        });
        $("#dogenerate").on('click', function() {
            $.LoadingOverlay("show");
            $.ajax({
                url: url + '/admin/get-total/',
                type: "get",
                success: function(e) {
                    $.LoadingOverlay("hide");
                    console.log(e);
                    if (e.status == 'success') {
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Retrive Data',
                            position: 'topRight'
                        });
                        // let c = e.data;
                        // var tot = 0;
                        // $("#totalnya").html('total : ' + e.total);
                        // $("#modalair").modal('show');
                        // // return false;
                        // c.forEach(element => {
                        //     console.log(element);
                        //     // generatee(element);
                        //     // return false;
                        // });
                        tabel.ajax.reload();
                    }
                }
            })


            // alert('k');
        })
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
                url: '{{ route('importdata.update') }}',
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
                    url: url + '/admin/data-mahasiswa/' + id,
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
            console.log(id);
            // return 0;
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
                        // iziToast.success({
                        //     title: 'Succes!',
                        //     message: 'Data tersimpan',
                        //     position: 'topRight'
                        // });
                        // return 1;
                        totnya += 1;
                        $("#berapami").html('generate : ' + totnya);

                    }
                    return 0;
                }
            })


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
                            // tabel.ajax.reload();
                            return 1;
                        }
                        return 0;
                    }
                })

            }
        }

        function generateu(id) {
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
                    url: url + '/admin/data-vau/',
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

            $("#namau").val(id.nama);
            $("#nimu").val(id.nim);
            $("#tagihanu").val(id.o_b.tagihan);

            $("#jenisu").val(id.jenis);
            $("#periodeu").val(id.periode);
            $("#deskripsiu").val(id.o_b.description);

            $("#idu").val(id.id);



        }
    </script>
@endpush
