<?php

include 'koneksi.php';
include 'header.php';
?>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" method="get">
            <table class="table">
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td><input type="text" name="nisn" placeholder="Masukkan NISN Siswa" class="form-control"></td>
                    <td>
                        <button type="submit" class="btn btn-primary" name="cari">Search</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];

    $query = "SELECT siswa_212279.*,angkatan_212279.*,jurusan_212279.*,kelas_212279.* FROM siswa_212279,angkatan_212279,jurusan_212279,kelas_212279
WHERE siswa_212279.212279_id_angkatan = angkatan_212279.212279_id_angkatan AND siswa_212279.212279_id_jurusan AND siswa_212279.212279_id_kelas = 
kelas_212279.212279_id_kelas AND siswa_212279.212279_nisn = '$nisn' ";
    $exec = mysqli_query($conn, $query);

    $cek = mysqli_num_rows($exec);
    if ($cek > 0) {
        $siswa = mysqli_fetch_assoc($exec);
        $id_siswa = $siswa['212279_id_siswa'];
        $nisn = $siswa['212279_nisn'];
?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Biodata Siswa</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img src="upload/<?= $siswa['212279_foto'] ?>" width="145" height="200" alt="foto" style="object-fit: cover;">
                    </div>
                    <div class="col-10">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <td>NISN</td>
                                    <td><?= $siswa['212279_nisn'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Siswa</td>
                                    <td><?= $siswa['212279_nama_siswa'] ?></td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td><?= $siswa['212279_nama_kelas'] ?> <?= $siswa['212279_nama_jurusan'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tahun Angkatan</td>
                                    <td><?= $siswa['212279_nama_angkatan'] ?></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>NO</td>
                                <th>Bulan</th>
                                <th>Jatuh Tempo</th>
                                <th>No Bayar</th>
                                <th>Tanggal Bayar</th>
                                <th>Biaya SPP</th>
                                <th>Denda</th>
                                <th>Total Bayar</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM pembayaran_212279 WHERE 212279_id_siswa = '$id_siswa' ORDER BY 212279_jatuhtempo ASC ";
                            $exec = mysqli_query($conn, $query);
                            while ($res = mysqli_fetch_assoc($exec)) {
                                $idspp = $res["212279_idspp"];
                                $jatuhtempo = $res["212279_jatuhtempo"];
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $res['212279_bulan'] ?></td>
                                    <td><?= $res['212279_jatuhtempo'] ?></td>
                                    <td><?= $res['212279_nobayar'] ?></td>
                                    <td><?= $res['212279_tglbayar'] ?></td>
                                    <td>Rp.<?= number_format($res['212279_jumlah']) ?></td>
                                    <td>Rp.<?= ($res['212279_denda']) ?></td>
                                    <td>Rp.<?= number_format($res['212279_jumlah'] + $res['212279_denda']) ?></td>
                                    <td><?= $res['212279_ket'] ?></td>
                                    <td>
                                        <?php
                                        if ($res['212279_nobayar'] == '') {
                                            echo "<a href='proses_transaksi.php?nisn=$nisn&act=bayar&id=$idspp'></a> ";
                                            echo "<a class='btn btn-primary btn-sm'href='proses_transaksi.php?nisn=$nisn&act=bayar&id=$idspp&tgltempo=$jatuhtempo'>Bayar</a> ";
                                        } else {
                                            echo "</a>";
                                            echo "<a class='btn btn-danger btn-sm' href='proses_transaksi.php?nisn=$nisn&act=batal&id=$idspp'>Batal</a> ";
                                            echo "<a class='btn btn-success btn-sm' href='cetak_slip_pembayaran.php?nisn=$nisn&act=cetak&id=$idspp'target='_blank'>Cetak</a> ";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php  } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
<?php
    } else {
        echo "
        <script>
        alert('NISN Tidak Ditemukan');
        location='pembayaran.php';
        </script>";
    }
}
?>