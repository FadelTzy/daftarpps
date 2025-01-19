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
    Pesan Konsultasi Siswa
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Pesan Konsultasi Siswa
            </h1>
        </div>
        <h2 class="section-title">Konsultasi : {{$datakonsul->judul}}</h2>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8"  style="overflow: scroll; height: 65vh">
                    <div class="activities">
                        @foreach ($pesan as $item)
                        <div class="activity">
                            <div class="activity-icon bg-primary text-white shadow-primary">
                                <i class="fas fa-comment-alt"></i>
                            </div>
                            <div class="activity-detail">
                                <div class="mb-2">
                                    <span class="text-job text-primary">{{$item->created_at->diffForHumans()}}</span>
                                    <span class="bullet"></span>
                                    <a class="text-job" href="#">{{$item->oUser->name}}</a>
                                
                                </div>
                                <p>{{$item->pesan}}</p>
                            </div>
                        </div>
                        @endforeach
                      
                 
                    </div>

                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-body">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-primary text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-list"></i> Nama :
                                                {{ $datakonsul->oSiswa->name }}</a></li>
                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-warning text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i
                                                    class="fas fa-tachometer-alt"></i> Kelas :
                                                {{ $datakonsul->oSiswa->kelas }}</a></li>

                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-success text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i
                                                    class="fas fa-tachometer-alt"></i> NIS :
                                                {{ $datakonsul->oSiswa->kode }}</a></li>

                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-danger text-white-all">
                                        <li class="breadcrumb-item"><a href="#"><i
                                                    class="fas fa-tachometer-alt"></i> Guru BK :
                                                {{ $datakonsul->oSiswa->oBk->name ?? '-' }}</li>
                                    </ol>
                                </nav>

                                <nav aria-label="breadcrumb">
                                    <button  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm"> Pesan Baru</button>
                                </nav>


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
                                    <label for="Nama">Pesan</label>
                                    <div class="input-group">
                                        <textarea name="pesan" class="form-control" id="" style="height: 250px" cols="30" rows="10"></textarea>
                                    </div>
                                    <br>
                                    <input type="hidden" name="idkonsul" value="{{$datakonsul->id}}">
                                    @if (Auth::user()->role == 3)
                                    <input type="hidden" name="idsiswa" value="{{Auth::user()->id}}">
                                    @else
                                    <input type="hidden" name="idsiswa" value="{{$datakonsul->id_siswa}}">
                                    @endif
                                 
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
                    <button id="datasubmit" type="button" class="btn btn-primary">Kirim</button>
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
                        .column(1)
                        .data()
                        .reduce(function(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                    $("#jk").html(n);



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
                    url: url + "/admin/konsultasi-siswa/" + '{{ Request::segment(3) }}',
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'judul',
                        data: 'judul'
                    },
                    {
                        nama: 'pesannya',
                        data: 'pesannya'
                    },
                    {
                        nama: 'created_at',
                        data: 'created_at'
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
                url: '{{ route('konsulpesan.store') }}',
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
            location.reload();


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
