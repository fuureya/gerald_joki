<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <center>
        <title>SLIP PEMBAYARAN SPP</title>
    </center>
    <style>
        body {
            font-family: arial;
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
            <h3>BUKTI PEMBAYARAN SPP</h3>
        </center>
        <hr>
    </table>

    <?php
    $nisn = $_GET['nisn'];
    $siswa = mysqli_query($conn, "SELECT siswa_212279.*,angkatan_212279.*,jurusan_212279.*,kelas_212279.* FROM 
        siswa_212279,angkatan_212279,jurusan_212279,kelas_212279 WHERE siswa_212279.212279_id_angkatan = angkatan_212279.212279_id_angkatan AND
        siswa_212279.212279_id_jurusan = jurusan_212279.212279_id_jurusan AND siswa_212279.212279_id_kelas = kelas_212279.212279_id_kelas AND
        siswa_212279.212279_nisn = '$nisn'");

    $sw = mysqli_fetch_assoc($siswa);
    $idspp = $_GET['id'];
    ?>
    <table>
        <tr>
            <td>Nama Siswa</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
            <td><?= $sw['212279_nama_siswa'] ?></td>
        </tr>
        <tr>
            <td>Nis</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
            <td><?= $sw['212279_nisn'] ?></td>
        </tr>
        <tr>
            <td>kelas</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
            <td><?= $sw['212279_nama_kelas'] ?></td>
        </tr>
        <tr>
            <td>Angkatan</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
            <td><?= $sw['212279_nama_angkatan'] ?></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
            <td><?= $sw['212279_nama_jurusan'] ?></td>
        </tr>
    </table>
    <br>
    <hr>
    <table border=" 1" cellspacing="" cellpadding="4" width="100%">
        <tr>
            <th>NO</th>
            <th>JATUH TEMPO</th>
            <th>No. BAYAR</th>
            <th>TANGGAL BAYAR</th>
            <th>PEMBAYARAN BULAN</th>
            <th>JUMLAH</th>
            <th>DENDA</th>
            <th>TOTAL BAYAR</th>
            <th>KETERANGAN</th>
        </tr>
        <?php
        $spp = mysqli_query($conn, "SELECT siswa_212279.*,pembayaran_212279.* FROM siswa_212279,pembayaran_212279 WHERE pembayaran_212279.
            212279_id_siswa = siswa_212279.212279_id_siswa AND pembayaran_212279.212279_idspp = '$idspp' ORDER BY 212279_nobayar ASC");
        $i = 1;
        $total = 0;
        while ($dta = mysqli_fetch_assoc($spp)) :
        ?>
            <tr>
                <td align="center"><?= $i ?></td>
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
            <td colspan="8" align="center">TOTAL
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
                        Siswa,
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