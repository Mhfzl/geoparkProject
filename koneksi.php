<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_geotour");

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $koneksi;

    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $jk = htmlspecialchars($data["jk"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $tgl = htmlspecialchars($data["tgl"]);
    $jalur = htmlspecialchars($data["jalur"]);

    $query = "INSERT INTO booking 
                VALUE
            ('','$nama', '$alamat', '$jk', '$no_hp', '$tgl', '$jalur')
                ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM booking WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

function hapusUser($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

function ubah($data)
{
    global $koneksi;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $jk = htmlspecialchars($data["jk"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $tgl = htmlspecialchars($data["tgl"]);
    $jalur = htmlspecialchars($data["jalur"]);

    $query = "UPDATE booking SET
                nama = '$nama',
                alamat = '$alamat',
                jk = '$jk',
                no_hp = '$no_hp',
                tgl = '$tgl',
                jalur = '$jalur'
            WHERE id = $id
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ubahUser($data)
{
    global $koneksi;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $level = htmlspecialchars($data["level"]);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE user SET
                nama = '$nama',
                username = '$username',
                password = '$password',
                level = '$level'
            WHERE id = $id
            ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

$jmlDataPerHal = 50;
$jmlData = count(query("SELECT * FROM booking"));
$jmlHalaman = ceil($jmlData / $jmlDataPerHal);
$halAktif = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
$dataAwal = ($jmlDataPerHal * $halAktif) - $jmlDataPerHal;

function cari($keyword)
{
    global $dataAwal, $jmlDataPerHal;

    $query = "SELECT * FROM booking
                WHERE
                nama LIKE '%$keyword%' OR
                alamat LIKE '%$keyword%' OR
                jalur LIKE '%$keyword%' OR
                no_hp LIKE '%$keyword%' OR
                tgl LIKE '%$keyword%' LIMIT $dataAwal, $jmlDataPerHal
            ";
    return query($query);
}


function registrasi($data)
{
    global $koneksi;

    $nama = stripslashes($data["nama"]);
    $username = stripslashes($data["username"]);
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $level = mysqli_real_escape_string($koneksi, $data["level"]);

    // cek apakah user sudah tersedia
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah tersedia!');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru
    mysqli_query($koneksi, "INSERT INTO user VALUES('', '$nama', '$username', '$password', '$level')");

    return mysqli_affected_rows($koneksi);
}
