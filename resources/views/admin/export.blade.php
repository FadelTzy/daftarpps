<table style="width: 100%">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nomor Pendaftaran</th>

            <th>Nomor VA</th>
            <th>Tagihan</th>
            <th>Fakultas</th>
            <th>Bank</th>
            <th>Create Va</th>
            <th>Status Pembayaran</th>
            <th>Tanggal Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $invoice)
            <tr>
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
            </tr>
        @endforeach
    </tbody>
</table>
