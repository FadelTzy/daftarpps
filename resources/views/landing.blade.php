<!doctype html>
<html lang="en">
  <head>
    <style>
        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
        .blinking-text {
            text-align: center;
            margin-top: 20%;
            font-size: 24px;
            color: rgb(225, 20, 20);
            animation: blink 1s infinite;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
   
    <div class="container text-right">
        <div class="row justify-content-center">
          <div class="col-9">
            <img src="assets/images/footer.jpg">
            <div class="px-5 py-2">
                <h4>Informasi</h4>
                <ul type="radio">
                    <li>Permintaan dan Pembayaran KAP sampai tanggal 28 Januari 2025 Jam Kantor (Teller) dan 23.59.59 (ATM)</li>
                    <li>Pengisian Form Daftar Online PPS sampai hari Selasa tanggal 28 Januari 2025 Jam 16.00 WITA — <span class="blinking-text">SISA 10 HARI</span></li>
                    <li>Pembayaran uang pendaftaran di Bank BNI (Teller, eBanking, ATM)</li>
                </ul>
                <h4>Panduan</h4>
                <ul type="radio">
                    <li>Persyaratan Dokumen | DOWNLOAD</li>
                    <li>Alur Pendaftaran | DOWNLOAD</li>
                    <li>Panduan Bayar via ATM | DOWNLOAD</li>
                    <li>Panduan mengisi Formulir | DOWNLOAD</li>
                    <li>Panduan menyesuaikan ukuran file photo utk diupload | DOWNLOAD</li>
                    <li>Panduan membuat link share publik Google Drive | DOWNLOAD</li>
                    <li>Template Pakta Integritas PPS | DOWNLOAD</li>
                </ul>
                <h4>Kode Akses Pendaftaran</h4>
                <ul type="radio">
                    <li>Permintaan Kode Akses Pendaftaran (KAP)| KLIK DISINI</li>
                </ul>
                <div class="text-center"><h3>Form Login</h3></div>
                <form class="mt-5">
                    <label class="py-2" for="autoSizingInputGroup">Kode Akses Pendaftaran</label>
                    <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                    <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="... kode akses pendaftaran">
                    </div>
                    <label class="pt-2" for="autoSizingInputGroup">Captcha</label>
                    <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                    <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="... masukkan 3 digit random diatas">
                    </div>
                    <div class="py-2"><button type="button" class="btn btn-warning text-white py-2">Lanjut</button></div>
                </form>
            </div>
            <img src="assets/images/footer.jpg">
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>