<div class="container-fluid loader-wrap">
    <div class="row h-100">
        @php
        @endphp
        <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
            <img width="30%" src="{{ asset('file/logo/') .'/' .  Session::get('logoapp') }}" alt="">
                <p class="mt-4"><span class="text-secondary">{{ Session::get('namaapp')}}</span><br><strong>Please
                        wait...</strong></p>
        </div>
    </div>
</div>