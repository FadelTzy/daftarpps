<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tagihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header, footer {
            background: url('assets/images/footer.jpg') no-repeat center center;
            background-size: cover;
            color: #fff;
        }
        header {
            height: 250px;
        }
        footer {
            height: 150px;
        }
        .btn-orange {
            background-color: #FFA500;
            border-color: #FFA500;
            color: #fff;
        }
        .btn-orange:hover {
            background-color: #FF8C00;
            border-color: #FF8C00;
            color: #fff;
        }
        .invoice-container {
            border: 1px solid #FFA500;
            padding: 20px;
            border-radius: 10px;
            background-color: #FFFAF0;
        }
        .invoice-header {
            border-bottom: 2px solid #FFA500;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .invoice-total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #FF4500;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="d-flex justify-content-center align-items-center">
        <h1 class="text-center">Detail Tagihan</h1>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="invoice-container">
                    <!-- Invoice Header -->
                    <div class="invoice-header">
                        <h3>Invoice #12345</h3>
                        <p><strong>Tanggal:</strong> 20 Januari 2025</p>
                        <p><strong>Status:</strong> <span class="badge bg-warning">Belum Lunas</span></p>
                    </div>

                    <!-- Invoice Details -->
                    <div class="invoice-body">
                        <p><strong>Nama:</strong> John Doe</p>
                        <p><strong>Program Studi:</strong> Teknik Informatika</p>
                        <p><strong>Deskripsi Tagihan:</strong> Pembayaran Semester 1</p>
                        <p><strong>Jatuh Tempo:</strong> 30 Januari 2025</p>
                        <p class="invoice-total"><strong>Total Tagihan:</strong> Rp 5,000,000</p>
                    </div>

                    <!-- Payment Button -->
                    <div class="text-end mt-4">
                        <button class="btn btn-orange">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="d-flex justify-content-center align-items-center">
        <p class="text-center mb-0">© 2025 Detail Tagihan. Semua hak dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
