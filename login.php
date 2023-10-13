<?php
session_start();
require 'koneksi.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['id'])) {
        if ($key === hash('sha256', $row['username'])) {
            $_SESSION['login'] = true;
        }
    }
}

if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
    exit;
} else if (isset($_SESSION["loginAdmin"])) {
    header("Location: dashboardAdmin.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $level = $_POST["level"];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            if ($level == $row["level"]) {
                if ($level == 'admin') {
                    $_SESSION["loginAdmin"] = true;
                    $_SESSION["logAs"] = $_POST["nama"];

                    if (isset($_POST['remember'])) {
                        setcookie('id', hash('sha256', $row['id']), time() + 60);
                        setcookie('key', hash('sha256', $row['username']), time() + 60);
                    }

                    header("Location: dashboardAdmin.php");
                    exit;
                } else {
                    $_SESSION["login"] = true;
                    $_SESSION["logAs"] = $_POST["nama"];

                    if (isset($_POST['remember'])) {
                        setcookie('id', hash('sha256', $row['id']), time() + 60);
                        setcookie('key', hash('sha256', $row['username']), time() + 60);
                    }

                    header("Location: dashboard.php");
                    exit;
                }
            }
        }
    }

    $error = true;
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
    <title>Geotour > Login</title>
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
                            <h3 class="text-center font-weight-light my-3">Login</h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($error)) : ?>
                                <p class="alert alert-danger text-center" role="alert">Username/Password Salah!</p>
                            <?php endif; ?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label class="small mt-2" for="username">Username</label>
                                    <input class="form-control" name="username" id="username" type="text" placeholder="Masukkan username" />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="password">Password</label>
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Masukkan password" />
                                </div>
                                <div class="form-group">
                                    <label class="small mt-2" for="level">Level</label>
                                    <select class="form-select py-2" name="level" id="level" aria-label="Default select example">
                                        <option selected>Pilih Level User</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <label class="custom-control-label" for="remember">Remember me</label>
                                        <input class="custom-control-input" id="remember" type="checkbox" name="remember" />
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="index.html">Kembali</a>
                                    <button type="submit" class="btn btn-primary" name="login">Login</button>
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