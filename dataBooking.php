<?php
session_start();
if (!isset($_SESSION["login"]) && !isset($_SESSION["loginAdmin"])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';
$booking = query("SELECT * FROM booking LIMIT $dataAwal, $jmlDataPerHal");

if (isset($_POST["cari"])) {
    $booking = cari($_POST["keyword"]);
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
    <title>Geotour > Data Booking</title>
    <link href="css/bootstrap2.css" rel="stylesheet" />
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
                        <?php if (isset($_SESSION["loginAdmin"])) : ?>
                            <a class="nav-link" href="dataUser.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data User
                            </a>
                        <?php endif; ?>
                        <div class="sb-sidenav-menu-heading">Fitur</div>
                        <a class="nav-link" href="tambah.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Tambah Data
                        </a>
                        <?php if (isset($_SESSION["loginAdmin"])) : ?>
                            <a class="nav-link" href="tambahUser.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Tambah User
                            </a>
                        <?php endif; ?>
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
                    <h1 class="mt-4">Data Booking</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Booking</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Data Booking
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="" method="post">
                                    <input type="text" name="keyword" id="keyword" placeholder="Cari" autocomplete>
                                    <button type="submit" name="cari">Cari</button>
                                </form>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No HP</th>
                                            <th>Tanggal Booking</th>
                                            <th>Jalur</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No HP</th>
                                            <th>Tanggal Booking</th>
                                            <th>Jalur</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>

                                    <?php $i = 1 ?>
                                    <?php foreach ($booking as $row) : ?>
                                        <tbody>
                                            <td><?= $i + $dataAwal; ?></td>
                                            <td><?= $row["nama"] ?></td>
                                            <td><?= $row["alamat"] ?></td>
                                            <td><?= $row["jk"] ?></td>
                                            <td><?= $row["no_hp"] ?></td>
                                            <td><?= $row["tgl"] ?></td>
                                            <td><?= $row["jalur"] ?></td>
                                            <td>
                                                <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-warning btn-sm" style="padding : 0.1rem 0.2rem; font-size : 0.700rem;">Ubah</a>
                                                <a href="hapus.php?id=<?= $row["id"]; ?>" class="btn btn-danger btn-sm" style="padding : 0.1rem 0.2rem; font-size : 0.700rem;" onclick="return confirm('Apakan anda yakin ingin menghapus data ?')">Hapus</a>
                                            </td>
                                        </tbody>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
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

</body>

</html>