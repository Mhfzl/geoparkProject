<?php
session_start();
if (!isset($_SESSION["loginAdmin"])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';

$id = $_GET["id"];

if (hapusUser($id) > 0) {
    echo "
                <script>
                    alert('User Berhasil Dihapus!')
                    document.location.href = 'dataUser.php';
                </script>
            ";
} else {
    echo "
                <script>
                    alert('User Gagal Dihapus!');
                    document.location.href = 'dataUser.php';
                </script>
            ";
}
