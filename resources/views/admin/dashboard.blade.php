@extends('ab')

@section('css')
@endsection

@section('title')
    Dashboard
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Dashboard
            </h1>
        </div>
        <div class="section-body">
            <div class="alert alert-info alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
       
                    <div class="alert-body">
                        <div class="alert-title">Selamat Datang Di Dashboard @if (Auth::user()->role == 1)
                            Admin @else Guru
                        @endif </div>
                    </div>
              

            </div>
        </div>
        <section class="section">

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tahun Aktif </h4>
                            </div>
                            <div class="card-body">
                                {{$dat->tahun}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4> Total Mahasiswa</h4>
                            </div>
                            <div class="card-body">
                                {{$vauser}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Tagihan</h4>
                            </div>
                            <div class="card-body">
                                @money($tagihan,'IDR','true')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tagihan Lunas</h4>
                            </div>
                            <div class="card-body">
                                @money($terbayar,'IDR','true')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
           
            </div>
            <br>
 
        </section>
    </section>
@endsection


@push('js')
    <!-- Page Specific JS File -->

@endpush
