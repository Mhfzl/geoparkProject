<?php
session_start();
if (!isset($_SESSION["login"]) && !isset($_SESSION["loginAdmin"])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "
                <script>
                    alert('Data Berhasil Dihapus!')
                    document.location.href = 'dataBooking.php';
                </script>
            ";
} else {
    echo "
                <script>
                    alert('Data Gagal Dihapus!');
                    document.location.href = 'dataBooking.php';
                </script>
            ";
}
