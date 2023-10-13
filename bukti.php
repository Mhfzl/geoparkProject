<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
ob_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geotour > Bukti Booking</title>
</head>

<body>
    <h1>E-Tiket</h1>

    Silahkan Tunjukan Tiket ini ke tempat pembookingan
</body>

</html>

<?php

$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
$mpdf->Output('bukti-booking.pdf', 'I');

?>