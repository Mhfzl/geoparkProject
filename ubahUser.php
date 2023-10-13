<?php
session_start();
if (!isset($_SESSION["loginAdmin"])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';

$id = $_GET["id"];

$dbg = query("SELECT * FROM user WHERE id = $id")[0];

// cek tombol sudah di tekan
if (isset($_POST["submit"])) {
    // cek apakah data berhasil diubah
    if (ubahUser($_POST) > 0) {
        echo "
                <script>
                    alert('User Berhasil Diubah!')
                    document.location.href = 'dataUser.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('User Gagal Diubah!');
                    document.location.href = 'ubahUser.php';
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
    <title>Geotour > Ubah User</title>
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
                                    <label class="small mt-2" for="username">Username</label>
                                    <input class="form-control" name="username" id="username" type="text" placeholder="Masukkan Username" required value="<?= $dbg["username"] ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="passsowrd">Password</label>
                                    <input class="form-control" name="passsowrd" id="passsowrd" type="text" placeholder="Masukkan Password" required value="<?= $dbg["password"] ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="level">Level</label>
                                    <select class="form-select py-2" name="level" id="level" aria-label="Default select example" required>
                                        <option value="<?= $dbg["level"] ?>"><?= $dbg["level"] ?></option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a href="dataUser.php" class="small">Kembali</a>
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