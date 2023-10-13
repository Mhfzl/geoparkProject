<?php
require 'koneksi.php';
// cek tombol sudah di tekan
if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan
    if (tambah($_POST) > 0) {
        echo "
                <script>
                    alert('Booking Sukses!');
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Booking Gagal!');
                    document.location.href = 'formDaftar.php';
                </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Geotour > Booking Sukses</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-dark">
    <main class="mb-3">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-3">Booking Sukses</h3>
                        </div>
                        <div class="card-body">
                            <p>Terimakasih sudah memboking <?= $nama ?>, silahkan klik download untuk mengunduh bukti booking. Untuk tahap permbayaran dan informasi lebih lanjut bisa menghubungi nomor dibawah sesuai dengan jalur yang di pilih :</p>
                            <ul class="text-left">
                                <li>Via TNI AL : 0123456789</li>
                                <li>Via Gili Lampu : 0123456789</li>
                                <li>Via Sugian : 0123456789</li>
                            </ul>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a href="booking.php" class="btn btn-primary">Kembali</a>
                                <a href="bukti.php" class="btn btn-primary">Download E-Tiket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

</body>

</html>