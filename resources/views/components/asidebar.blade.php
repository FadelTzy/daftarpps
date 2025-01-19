<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url('admin') }}">SVA</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('admin') }}">SVA</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Menu</li>

        @if (Auth::user()->role == 1 || Auth::user()->role == 3)
            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a href="{{ route('admin') }}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            {{-- <li class="nav-item {{ Request::segment(2) == 'mahasiswa-pps' ? 'active' : '' }}">
                <a href="{{ url('admin/mahasiswa-pps') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Mahasiswa PPS</span></a>
            </li> --}}
            <li class="nav-item {{ Request::segment(2) == 'pv-datamahasiswa' ? 'active' : '' }}">
                <a href="{{ url('admin/pv-datamahasiswa') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Data Mahasiswa</span></a>
            </li>
            <li class="menu-header">Manajemen Data Baru</li>
            <li class="nav-item {{ Request::segment(2) == 'pv-pembayaran' ? 'active' : '' }}">
                <a href="{{ url('admin/pv-pembayaran') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Pembayaran</span></a>
            </li>
            <li
                class="nav-item {{ Request::segment(2) == 'pv-pembayaran/' . $semesaktif->kode_semester ? 'active' : '' }}">
                <a href="{{ url('admin/pv-pembayaran') }}/{{ $semesaktif->kode_semester }}" class="nav-link"><i
                        class="fas fa-columns"></i>
                    <span>Pembayaran {{ $semesaktif->kode_semester }}</span></a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'import-data' ? 'active' : '' }}">
                <a href="{{ url('admin/import-data') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Import Pembayaran Mahasiswa</span></a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'status-data' ? 'active' : '' }}">
                <a href="{{ url('admin/status-data') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Status Pembayaran Mahasiswa</span></a>
            </li>
            <li class="menu-header">Manajemen Data Lama</li>
            <li class="nav-item {{ Request::segment(2) == 'data-mahasiswa' ? 'active' : '' }}">
                <a href="{{ url('admin/data-mahasiswa') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Data Mahasiswa</span></a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'data-va' ? 'active' : '' }}">
                <a href="{{ url('admin/data-va') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Data VA</span></a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'pembayaran' ? 'active' : '' }}">
                <a href="{{ url('admin/pembayaran') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Pembayaran</span></a>
            </li>

            {{-- <li class="nav-item {{ Request::segment(2) == 'konsultasi-siswa' ? 'active' : '' }}">
                <a href="{{ url('admin/konsultasi-siswa') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Konsultasi Siswa</span></a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'pelanggaran-siswa' ? 'active' : '' }}">
                <a href="{{ url('admin/pelanggaran-siswa') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Pelanggaran Siswa</span></a>
            </li>

            <li class="nav-item {{ Request::segment(2) == 'qr-code' ? 'active' : '' }}">
                <a href="{{ url('admin/qr-code') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>QR Code</span></a>

            </li> --}}
            <li class="menu-header">Master Data</li>


            {{-- <li class="nav-item {{ Request::segment(2) == 'data-bank' ? 'active' : '' }}">
                <a href="{{ url('admin/data-bank') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Data Bank</span></a>
            </li> --}}
            <li class="nav-item {{ Request::segment(2) == 'pvsemester' ? 'active' : '' }}">
                <a href="{{ url('admin/pvsemester') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Periode Semester</span></a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'data-gelombang' ? 'active' : '' }}">
                <a href="{{ url('admin/data-gelombang') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Data Gelombang</span></a>
            </li>
            {{-- <li class="nav-item {{ Request::segment(2) == 'data-tahun' ? 'active' : '' }}">
                <a href="{{ url('admin/data-tahun') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Data Tahun</span></a>
            </li> --}}



            @if (Auth::user()->role == 1)
                <li class="menu-header">Manajemen Admin</li>

                <li class="{{ Request::segment(2) == 'data-pengaturan' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('pengaturan.index') }}"><i class="fas fa-pencil-ruler"></i>
                        <span>Pengaturan</span></a></li>
                <li class="{{ Request::segment(1) == 'profil' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('profil') }}"><i class="fas fa-pencil-ruler"></i>
                        <span>Profil Admin</span></a></li>
            @else
            @endif
        @else
        @endif


    </ul>

    <div class=" mb-4 p-3 hide-sidebar-mini">
        <a href="#" id="" onclick="logsout()" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Keluar
        </a>
        <form method="POST" id="flog" class="" action="{{ route('logout') }}">
            @csrf
        </form>
    </div>
</aside>
<script>
    function logsout() {
        var x = document.getElementById('flog');
        x.submit();
    }
</script>
