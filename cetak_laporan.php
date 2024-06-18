<?php
include 'koneksi.php';
session_start();
$awal = $_GET['awal'];
$akhir = $_GET['akhir'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN PEMBAYARAN SPP</title>
    <style>
        body {
            font-family: arial;
        }

        .print {
            margin-top: 10px;
        }

        @media print {
            .print {
                display: none;
            }
        }

        table {
            border-collapse: collapse;
        }

        body {
            background-color: pink;
        }
    </style>
</head>

<body onload="window.print();">

    <p style="position: absolute; right:0 ">MAKASSAR,<?= date('d/m/y')  ?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <h3 style="position: absolute; left:0,"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SMA FRATER MAKASSAR</h3>
    <table width=" 100%">
        <tr>
            <td></td>
            <td width=" 200px">
            </td>
        </tr>
        <tr></tr>
        <tr>
            <p>
                <img width="60" src="img/smafrater.jpeg" />
            </p>
        </tr>
        <hr>
        <center>
            <h3>LAPORAN PEMBAYARAN SPP</h3>
        </center>
        <hr>
    </table>
    <table border="1" cellspacing="" cellpadding="4" width="100%">
        <tr>
            <th>NO</th>
            <th>NIS</th>
            <th>NAMA SISWA</th>
            <th>KELAS</th>
            <th>JATUH TEMPO</th>
            <th>NO. BAYAR</th>
            <th>TANGGAL BAYAR</th>
            <th>PEMBAYARAN BULAN</th>
            <th>JUMLAH</th>
            <th>DENDA</th>
            <th>TOTAL BAYAR</th>
            <th>KETERANGAN</th>
        </tr>
        <?php
        $spp = mysqli_query($conn, "SELECT siswa_212279.*,pembayaran_212279.*,kelas_212279.*,jurusan_212279.* FROM siswa_212279,pembayaran_212279,kelas_212279,jurusan_212279 WHERE pembayaran_212279.212279_id_siswa =
        siswa_212279.212279_id_siswa AND siswa_212279.212279_id_kelas = kelas_212279.212279_id_kelas AND siswa_212279.212279_id_jurusan = jurusan_212279.212279_id_jurusan AND 212279_tglbayar BETWEEN '$awal' AND '$akhir' ORDER BY 212279_nobayar");

        $i = 1;
        $total = 0;
        while ($dta = mysqli_fetch_assoc($spp)) :
        ?>
            <tr>
                <td align="center"><?= $i ?></td>
                <td align="center"><?= $dta['212279_nisn'] ?></td>
                <td align="center"><?= $dta['212279_nama_siswa'] ?></td>
                <td align="center"><?= $dta['212279_nama_kelas'] ?> <?= $dta['212279_nama_jurusan'] ?></td>
                <td align="center"><?= $dta['212279_jatuhtempo'] ?></td>
                <td align="center"><?= $dta['212279_nobayar'] ?></td>
                <td align="center"><?= $dta['212279_tglbayar'] ?></td>
                <td align="center"><?= $dta['212279_bulan'] ?></td>
                <td align="center">Rp.<?= number_format($dta['212279_jumlah']) ?></td>
                <td align="center">Rp.<?= number_format($dta['212279_denda']) ?></td>
                <td align="center">Rp.<?= number_format($dta['212279_jumlah'] + $dta['212279_denda']) ?> </td>
                <td align="center"><?= $dta['212279_ket'] ?></td>
            </tr>
            <?php $i++; ?>
            <?php $total += $dta['212279_jumlah'] + $dta['212279_denda'] ?>
        <?php endwhile; ?> <tr>
            <td colspan="11" align="center">TOTAL
            </td>
            <td align="center"><b>Rp.<?= number_format($total) ?></b></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td></td>
            <td width="500px">
                </BR>
                </BR>
                <center>
                    <p>MAKASSAR , <?= date('d/m/y') ?> <br />
                        Kepala Sekolah,
                        <br />
                        <br />
                        <br />
                    <p>______________________</p>
                </center>

            </td>
            <td width="300px">
                </BR>
                </BR>
                <center>
                    <p>MAKASSAR , <?= date('d/m/y') ?> <br />
                        Kepala Tata Usaha,
                        <br />
                        <br />
                        <br />
                    <p>______________________</p>
                </center>

            </td>
        </tr>
    </table>

</body>

</html>