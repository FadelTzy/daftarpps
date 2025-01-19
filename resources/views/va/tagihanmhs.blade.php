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
    Data Tagihan Mahasiswa
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Data Tagihan Mahasiswa A.N : {{ $user->nama }}
            </h1>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-left">
                                <h4>Informasi Data Mahasiswa</h4>
                            </div>

                            <div class="mt-4">
                                <table class="table table-bordered" style="font-size: 14px;">
                                    <tbody>
                                        {{-- <tr>
                                            <th style="padding: 8px;">Nama</th>
                                            <td style="padding: 8px;">{{ $user->nama }}</td>
                                        </tr> --}}
                                        <tr>
                                            <th style="padding: 8px;">NIM / No. Daftar</th>
                                            <td style="padding: 8px;">{{ $user->nim ?? $user->nodaftar }}</td>
                                        </tr>
                                        <tr>
                                            <th style="padding: 8px;">NIK</th>
                                            <td style="padding: 8px;">{{ $user->nik }}</td>
                                        </tr>
                                        <tr>
                                            <th style="padding: 8px;">Program Studi</th>
                                            <td style="padding: 8px;">{{ $user->prodi }}</td>
                                        </tr>
                                        <tr>
                                            <th style="padding: 8px;">Angkatan / Jenjang</th>
                                            <td style="padding: 8px;">{{ $user->angkatan }}/{{ $user->jenjang }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th style="padding: 8px;"></th>
                                            <td style="padding: 8px;"></td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                <h4>Manajemen Data Mahasiswa
                                    {{-- {{ $semesaktif->kode_semester }} --}}
                                </h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <button data-toggle="modal" data-target="#exampleModal" href="features-post-create.html"
                                        class="btn btn-primary">Create Tagihan Baru</button>
                                    <a href="{{ route('pvmahasiswa.index') }}" class="btn btn-primary">Kembali</a>
                                    {{-- <button id="dogenerate" class="btn btn-warning">Generate VA</button> --}}
                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">No</th>
                                            <th>Virtual Account</th>
                                            <th>Ref ID</th>
                                            <th>Tagihan</th>
                                            <th>Periode</th>
                                            <th>Layanan</th>
                                            <th>Status</th>
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
                    <h5 class="modal-title">Create Tagihan Baru</h5>
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
                                    <label for="nama">Nama</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" value="{{ $user->nama }}"
                                            placeholder="Input Nama" class="form-control">
                                    </div>
                                    <br>
                                    <label for="va">Virtual Account</label>
                                    <div class="input-group">
                                        <input type="text" name="va"
                                            value="{{ $user->va ?? ('95941' . $user->nim ?? $user->no) }}"
                                            placeholder="Input Nama" class="form-control">
                                    </div>
                                    <br>
                                    <input type="hidden" name="kodelayanan" value="100">
                                    <input type="hidden" name="flag" value="F">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <label for="nim">Ref</label>
                                    <div class="input-group">
                                        <input type="text" name="ref" value="{{ $user->nim ?? $user->nodaftar }}"
                                            placeholder="Input REf ID" class="form-control">
                                    </div>
                                    <br>

                                    <label for="nodaftar">Tagihan</label>
                                    <div class="input-group">
                                        <input type="number" value="" name="tagihan" placeholder="Input Tagihan"
                                            class="form-control">
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="prodi">Program Studi (Layanan)</label>
                                            <div class="input-group">
                                                <input type="text" name="prodi" value="{{ $user->prodi }}"
                                                    placeholder="Input Program Studi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="jenjang">Jenjang (Reserve)</label>
                                            <div class="input-group">
                                                <input type="text" name="jenjang"
                                                    placeholder="Input Jenjang (S2, S3 etc)" value="{{ $user->jenjang }}"
                                                    class="form-control">
                                            </div>
                                        </div>


                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="prodi">Kode Semester</label>
                                            <div class="input-group">
                                                <select name="semester" class="form-control" id="">
                                                    <option disabled>Pilih Kode Semester</option>
                                                    @foreach ($periode as $item)
                                                        @if ($semesaktif->kode_semester == $item->kode_semester)
                                                            <option selected value="{{ $item->kode_semester }}">

                                                                {{ $item->nama_semester }} ({{ $item->kode_semester }})
                                                            </option>
                                                        @else
                                                            <option value="{{ $item->kode_semester }}">

                                                                {{ $item->nama_semester }} ({{ $item->kode_semester }})
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="jenjang">Kode Gelombang</label>
                                            <div class="input-group">
                                                <select name="gel" class="form-control" id="">
                                                    <option disabled selected>Pilih Gelombang </option>
                                                    @foreach ($gel as $item)
                                                        <option value="{{ $item->kodegel }}">

                                                            {{ $item->kodegel }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <br>



                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="angkatan">Angkatan</label>
                                            <div class="input-group">
                                                <input type="text" name="angkatan" value="{{ $user->angkatan }}"
                                                    placeholder="Input Angkatan" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="jenis">Jenis</label>
                                            <select name="jenis" class="form-control">
                                                <option value="1">Baru</option>
                                                <option value="2">Lanjut</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form id="dataperiodeu" method="POST">
                            <div class="card-body">
                                @csrf
                                <input type="hidden" name="id" id="idu">

                                <div class="form-group">
                                    <label for="namau">Nama</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" id="namau" placeholder="Input Nama"
                                            class="form-control">
                                    </div>
                                    <br>
                                    <label for="vau">Virtual Account</label>
                                    <div class="input-group">
                                        <input type="text" name="va" id="vau" placeholder="Input va"
                                            class="form-control">
                                    </div>
                                    <br>
                                    <label for="refu">Ref</label>
                                    <div class="input-group">
                                        <input type="text" name="ref" id="refu" placeholder="Input ref"
                                            class="form-control">
                                    </div>
                                    <br>

                                    <label for="tagihan">Tagihan</label>
                                    <div class="input-group">
                                        <input type="text" name="tagihan" id="tagihanu" placeholder="Input NIK"
                                            class="form-control">
                                    </div>
                                    <br>

                                    <label for="deskripsi">Deskripsi</label>
                                    <div class="input-group">
                                        <input type="text" name="deskripsi" id="deskripsiu"
                                            placeholder="Input Deskripsi" class="form-control">
                                    </div>

                                    <br>
                                    <label for="Flag">Flag</label>
                                    <div class="input-group">
                                        <select name="flag" class="form-control" id="flagu">
                                            <option value="F">Full Payment</option>
                                            <option value="P">Partial Payment</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
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
                    url: "{{ route('pvtagihan.index', ['id' => $id]) }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'va',
                        data: 'va'
                    },
                    {
                        nama: 'ref',
                        data: 'ref'
                    },
                    {
                        nama: 'tagihannya',
                        data: 'tagihannya'
                    },
                    {
                        nama: 'periodenya',
                        data: 'periodenya'
                    },

                    {
                        name: 'description',
                        data: 'description',
                    },
                    {
                        name: 'statusnya',
                        data: 'statusnya',
                    },
                    {
                        name: 'aksi',
                        data: 'aksi'
                    },

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
                url: '{{ route('mahasiswa.import') }}',
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
        $("#dataperiode").on('submit', function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            $.LoadingOverlay("show");

            $.ajax({
                url: '{{ route('pvtagihan.create') }}',
                data: formData,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(response) {
                    $.LoadingOverlay("hide");

                    // Jika ada error dari server
                    if (response.status === 'error') {
                        var errors = response.data;
                        var errorMessages = '<div><ul>';

                        // Iterasi error validasi
                        Object.keys(errors).forEach(function(key) {
                            errors[key].forEach(function(message) {
                                errorMessages += '<li>' + message + '</li>';
                            });
                        });

                        errorMessages += '</ul></div>';

                        iziToast.error({
                            title: 'Validasi Gagal',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                    // Jika berhasil
                    else if (response.status === 'success') {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Data berhasil disimpan.',
                            position: 'topRight'
                        });
                        $("#exampleModal").modal('hide');
                        tabel.ajax.reload();
                    } else if (response.status === 'danger') {
                        iziToast.error({
                            title: 'Gagal!',
                            message: response.message,
                            position: 'topRight'
                        });
                        $("#exampleModal").modal('hide');
                        tabel.ajax.reload();
                    }
                },
                error: function(xhr) {
                    $.LoadingOverlay("hide");

                    var errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';

                    // Tangani error 500 atau lainnya
                    if (xhr.status === 500 || xhr.status === 422) {
                        // Mengambil pesan dari response JSON yang dikirim oleh controller
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                    }

                    iziToast.error({
                        title: 'Error',
                        message: errorMessage,
                        position: 'topRight'
                    });
                }
            });
        });

        $("#dataperiodeu").on('submit', function(event) {
            event.preventDefault(); // Ganti 'id' menjadi 'event' untuk mencegah bentrok variabel
            var formData = new FormData(this);
            $.LoadingOverlay("show");

            $.ajax({
                url: '{{ route('pvtagihan.edit') }}',
                data: formData,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $.LoadingOverlay("hide");

                    // Periksa jika response status adalah 'error'
                    if (response.status == 'error') {
                        var errors = response.data;
                        var errorList = '<div><ul>';

                        // Membuat list error message
                        Object.keys(errors).forEach(function(key) {
                            errors[key].forEach(function(error) {
                                errorList += '<li>' + error + '</li>';
                            });
                        });

                        errorList += '</ul></div>';

                        // Menampilkan toast error
                        iziToast.error({
                            title: 'Error',
                            message: errorList,
                            position: 'topRight'
                        });
                    } else {
                        // Jika sukses
                        iziToast.success({
                            title: 'Success!',
                            message: 'Data berhasil disimpan',
                            position: 'topRight'
                        });

                        // Menutup modal dan reload tabel
                        $("#up").modal('hide');
                        tabel.ajax.reload();
                    }
                },
                error: function(xhr, status, error) {
                    $.LoadingOverlay("hide");
                    // Menampilkan error jika terjadi kesalahan di server atau ajax
                    iziToast.error({
                        title: 'Error',
                        message: 'Terjadi kesalahan pada server.',
                        position: 'topRight'
                    });
                }
            });
        });


        function staffdel(id) {
            // Konfirmasi untuk melanjutkan penghapusan
            var data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.LoadingOverlay("show");

                $.ajax({
                    url: '{{ route('pvtagihan.delete') }}',
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $.LoadingOverlay("hide");

                        // Memeriksa apakah status 'success' ada pada respons
                        if (response.status === 'success') {
                            iziToast.success({
                                title: 'Success!',
                                message: response.message || 'Data berhasil dihapus.',
                                position: 'topRight'
                            });

                            // Reload tabel setelah penghapusan
                            tabel.ajax.reload();
                        } else {
                            iziToast.error({
                                title: 'Error',
                                message: response.message || 'Terjadi kesalahan saat menghapus data.',
                                position: 'topRight'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        $.LoadingOverlay("hide");

                        // Menangani kesalahan di AJAX (misalnya server tidak dapat dijangkau)
                        iziToast.error({
                            title: 'Error',
                            message: 'Terjadi kesalahan pada server atau jaringan.',
                            position: 'topRight'
                        });
                    }
                });
            }
        }





        function staffupd(id) {
            $('#up').modal('show');

            // Mengisi nilai form dengan data dari parameter 'id'
            $("#idu").val(id.id);
            $("#refu").val(id.ref);
            $("#vau").val(id.va);
            $("#flagu").val(id.flag);
            $("#deskripsiu").val(id.description);
            $("#tagihanu").val(id.tagihan); // Menambahkan untuk field NIK
            $("#namau").val(id.nama); // Menambahkan untuk field No. Pendaftaran


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
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
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
    </script>
@endpush
