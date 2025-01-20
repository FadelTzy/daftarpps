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
        <div class="px-5 py-5">
          <div class="text-center">
            <h3>Form Pendaftaran</h3>
          </div>
          <form class="mt-5">
            <label class="py-2" for="autoSizingInputGroup">Nama Peserta</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="... nama peserta">
            </div>
            <small class="text-secondary">nama tanpa gelar sesuai dengan ijazah D4/S1</small><br>
            <label class="py-2" for="autoSizingInputGroup">NIK</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
              <input type="text" class="form-control" id="nik" name="nik" placeholder="... NIK peserta">
            </div>
            <label class="py-2" for="autoSizingInputGroup">Tanggal Lahir</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
              <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="... tanggal lahir peserta">
            </div>
            <label class="pt-2" for="autoSizingInputGroup">No WA/HP</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
              <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="... nomor WA/HP peserta">
            </div>
            <!-- <label class="pt-2" for="autoSizingInputGroup">Jalur</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
              <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="... pilih jalur">
            </div> -->
            <label class="pt-2" for="autoSizingInputGroup">Email</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
              <input type="text" class="form-control" id="email" name="email" placeholder="... email Peserta">
            </div>
            <label class="pt-2" for="autoSizingInputGroup">Captcha</label>
            <div class="input-group">
              <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
              <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="... masukkan 3 digit random diatas">
            </div>
            <div class="py-2"><button type="button" class="btn btn-warning text-white py-2">Cetak KAP</button></div>
          </form>
        </div>
        <img src="assets/images/footer.jpg">
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>