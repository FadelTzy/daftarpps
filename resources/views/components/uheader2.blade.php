<header class="header position-fixed">
    <div class="row">
        <div class="col-auto">
            <button type="button" class="btn btn-light btn-44 back-btn">
                <i class="bi bi-arrow-left"></i>
            </button>
        </div>
        <div class="col text-center">
            <div class="logo-small">
                <img width="35%" src="{{ asset('file/logo/') .'/' .  Session::get('logoapp') }}" alt="">
                <h5><span class="text-secondary fw-light">{{ Session::get('namaapp')}}</span><br /></h5>
             </div>
        </div>
        <div class="col-auto">
            <a href="{{url('user/profil')}}" target="_self" class="btn btn-light btn-44">
                <i class="bi bi-person-circle"></i>
                <span class="count-indicator"></span>
            </a>
        </div>
    </div>
</header>