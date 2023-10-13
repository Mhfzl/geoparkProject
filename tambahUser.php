<?php
session_start();
if (!isset($_SESSION["loginAdmin"])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "
                <script>
                    alert('User Berhasil Ditambahkan!')
                    document.location.href = 'dataUser.php';
                </script>
            ";
    } else {
        echo mysqli_error($koneksi);
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
    <title>Geotour > Tambah User</title>
    <link href="css/bootstrap2.css" rel="stylesheet" />
    <link href="css/style2.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Geotour</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <!-- <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Utama</div>
                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Data</div>
                        <a class="nav-link" href="dataBooking.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Booking
                        </a>
                        <a class="nav-link" href="dataUser.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data User
                        </a>
                        <div class="sb-sidenav-menu-heading">Fitur</div>
                        <a class="nav-link" href="tambah.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Tambah Data
                        </a>
                        <a class="nav-link" href="tambahUser.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Tambah User
                        </a>
                        <a class="nav-link" href="eksport.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Eksport
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Tambah User</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                    <div class="card mb-4 mx-5">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Tambah User
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="nama" class="small mt-2">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="username">Username</label>
                                    <input class="form-control" name="username" id="username" type="text" placeholder="Masukkan Username" required />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="password">Password</label>
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Masukkan Password" required />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="password2">Konfirmasi Password</label>
                                    <input class="form-control" name="password2" id="password2" type="password" placeholder="Masukkan Password" required />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="level">Level User</label>
                                    <select class="form-select py-2" name="level" id="level" aria-label="Default select example" required>
                                        <option selected>Pilih Level User</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <button type="submit" class="btn btn-primary" name="register">Tambah User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>

</html>