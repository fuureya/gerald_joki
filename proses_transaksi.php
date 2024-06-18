<?php
session_start();
include 'koneksi.php';

$idspp = $_GET['id'];
$nisn = $_GET['nisn'];
$jatuhtempo = $_GET['tgltempo'];
// tanggal bayar
$tglbayar = date('Y-m-d');
$nobayar = date('dmYHisis');
$id_admin = $_SESSION['admin_212279'];

$tgl1 = strtotime($jatuhtempo);
$tgl2 = strtotime($tglbayar);

$jarak = $tgl2 - $tgl1;

$hari = $jarak / 60 / 60 / 24;

$denda = 0;

if ($hari > 0) {
    $denda = 20000 * $hari;
}

if (isset($_GET['act'])) {
    if ($_GET['act'] == 'bayar') {
        $byr = mysqli_query($conn, "UPDATE pembayaran_212279 SET
            212279_nobayar = '$nobayar',
            212279_tglbayar = '$tglbayar',
            212279_ket = 'LUNAS',
            212279_denda = '$denda',
            212279_id_admin = '$id_admin'
            WHERE 212279_idspp = '$idspp'");

        if ($byr) {
            header('location:pembayaran.php?nisn=' . $nisn);
        } else {
            echo "
            <script>
            alert('gagal')
            </script>";
        }
    } else if ($_GET['act'] == 'batal') {
        $batal = mysqli_query($conn, "UPDATE pembayaran_212279 SET
            212279_nobayar = null,
            212279_tglbayar = null,
            212279_denda = null,
            212279_ket = null,
            212279_id_admin = null
            WHERE 212279_idspp = '$idspp'");

        if ($batal) {
            header('location: pembayaran.php?nisn=' . $nisn);
        } else {
            echo "
            <script>
            alert('gagal')
            </script>";
        }
    }
}
