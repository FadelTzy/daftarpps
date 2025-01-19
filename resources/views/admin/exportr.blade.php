<table style="width: 100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nomor VA</th>
            <th>Teller</th>
            <th>TransCode</th>
            <th>Tagihan</th>
            <th>Terbayar</th>
            <th>Prodi</th>
            <th>Kode Prodi</th>
            <th>No Daftar</th>

            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $invoice)
        <tr>
            <th>{{$no++}}</th>
            <th>{{$invoice->nama}}</th>
            <th>'{{$invoice->va}}</th>
            <th>{{$invoice->teller}}</th>
            <th>{{$invoice->transcode}}</th>
            <th>{{$invoice->tagihan}}</th>
            <th>{{$invoice->terbayar}}</th>
            @if ($invoice->oU)
            <th>{{$invoice->oU->prodi}}</th>
            <th>{{$invoice->oU->c_prodi}}</th>
            <th>'{{$invoice->oU->nim}}</th>

            @else
            <th>-</th>
            <th>-</th>
            <th>-</th>

            @endif
            <th>Lunas<th>

        </tr>
            {{-- <tr>
                <th>{{ $invoice->nama }}</th>
                <th>{{ $invoice->oU->c_jur }}</th>

                <th>`{{ $invoice->va }}`</th>
                <th>@money($invoice->tagihan, 'idr', 'true')</th>
                <th>{{ $invoice->fakultas }}</th>
                <th>{{ $invoice->bank }}</th>
                <th>{{ $invoice->created_at->format('d M, Y') }}</th>
                <th>
                    @if ($invoice->oB)
                        @if ($invoice->oB->terbayar)
                            Lunas
                        @endif
                    @else
                        Belum Lunas
                    @endif
                </th>
                <th>
                    @if ($invoice->oB)
                        @if ($invoice->oB->terbayar)
                        {{$invoice->oB->tgl}}
                        @endif
                    @else
                        -
                    @endif
                </th>
            </tr> --}}
        @endforeach
    </tbody>
</table>
