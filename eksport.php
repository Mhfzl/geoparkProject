<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'koneksi.php';
$booking = query("SELECT * FROM booking");

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
ob_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geotour > Eksport</title>
</head>

<body>
    <h1>DAFTAR BOOKING</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th>Tanggal Booking</th>
            <th>Jalur</th>
        </tr>

        <?php $i = 1 ?>
        <?php foreach ($booking as $row) : ?>
            <tr>
                <td><?= $i + $dataAwal; ?></td>
                <td><?= $row["nama"] ?></td>
                <td><?= $row["alamat"] ?></td>
                <td><?= $row["jk"] ?></td>
                <td><?= $row["no_hp"] ?></td>
                <td><?= $row["tgl"] ?></td>
                <td><?= $row["jalur"] ?></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>

    </table>
</body>

</html>

<?php

$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
$mpdf->Output('data-booking.pdf', 'I');

?>