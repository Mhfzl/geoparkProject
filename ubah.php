<?php
session_start();
if (!isset($_SESSION["login"]) && !isset($_SESSION["loginAdmin"])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';

$id = $_GET["id"];

$dbg = query("SELECT * FROM booking WHERE id = $id")[0];

// cek tombol sudah di tekan
if (isset($_POST["submit"])) {
    // cek apakah data berhasil diubah
    if (ubah($_POST) > 0) {
        echo "
                <script>
                    alert('Data Berhasil Diubah!')
                    document.location.href = 'dashboard.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data Gagal Diubah!');
                    document.location.href = 'ubah.php';
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
    <title>Geotour > Ubah</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-dark">
    <main class="mb-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-3">Ubah Data</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $dbg["id"] ?>">
                                <div class="form-group">
                                    <label for="nama" class="small mt-2">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required value="<?= $dbg["nama"] ?>">
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="alamat">Alamat</label>
                                    <input class="form-control" name="alamat" id="alamat" type="text" placeholder="Masukkan Alamat" required value="<?= $dbg["alamat"] ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="jk">Jenis Kelamin</label>
                                    <select class="form-select py-2" name="jk" id="jk" aria-label="Default select example" required>
                                        <option value="<?= $dbg["jk"] ?>"><?= $dbg["jk"] ?></option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="no_hp">No Handphone</label>
                                    <input class="form-control" name="no_hp" id="no_hp" type="text" placeholder="Masukkan No Handphone" required value="<?= $dbg["no_hp"] ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="tgl">Tanggal Booking</label>
                                    <input class="form-control" name="tgl" id="tgl" type="date" required value="<?= $dbg["tgl"] ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="jalur">Jalur Penyebrangan</label>
                                    <select class="form-select py-2" name="jalur" id="jalur" aria-label="Default select example" required>
                                        <option value="<?= $dbg["jalur"] ?>"><?= $dbg["jalur"] ?></option>
                                        <option value="Via TNI AL">Via TNI AL</option>
                                        <option value="Via Gili Lampu">Via Gili Lampu</option>
                                        <option value="Via Sugian">Via Sugian</option>
                                    </select>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a href="dataBooking.php" class="small">Kembali</a>
                                    <button type="submit" class="btn btn-primary" name="submit">Ubah</button>
                                </div>
                            </form>
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