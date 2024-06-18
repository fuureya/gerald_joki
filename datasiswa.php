<?php include 'header.php';
include 'koneksi.php';
$ank = $_GET['angkatan'];
?>

<!-- Content Row -->
<div class="row">
    <?php
    $angkatan = mysqli_query($conn, "SELECT * FROM angkatan_212279");
    foreach ($angkatan as $r) {
    ?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="datasiswa.php?angkatan=<?= $r["212279_id_angkatan"]; ?>">
                <div class=" card border-left-primary shadow h-100 py-2" style="background-color: #f0ffff;">
                    <div class="card-body" style="background-color: sea;">
                        <div class="row no-gutters align-items-center">
                            <div class=" col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Angkatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $r["212279_nama_angkatan"] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-black-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php
    }
    ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Data Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Siswa</th>
                            <th>Nis</th>
                            <th>Nama Siswa</th>
                            <th>Angkatan</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($ank === 'null') {
                            $query = "SELECT * FROM siswa_212279 A INNER JOIN angkatan_212279 B ON A.212279_id_angkatan = B.212279_id_angkatan 
                        INNER JOIN jurusan_212279 C ON A.212279_id_jurusan = C.212279_id_jurusan INNER JOIN kelas_212279 D ON A.212279_id_kelas = D.212279_id_kelas";
                        } else {
                            $query = "SELECT * FROM siswa_212279 A INNER JOIN angkatan_212279 B ON A.212279_id_angkatan = B.212279_id_angkatan 
                        INNER JOIN jurusan_212279 C ON A.212279_id_jurusan = C.212279_id_jurusan INNER JOIN kelas_212279 D ON A.212279_id_kelas = D.212279_id_kelas 
                        WHERE A.212279_id_angkatan = '$ank'";
                        }
                        $exec = mysqli_query($conn, $query);
                        while ($res = mysqli_fetch_assoc($exec)) :
                        ?>

                            <tr>
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td><img src="upload/<?= $res['212279_foto'] ?>" alt="siswa" width="100"></td>
                                <td><?= $res['212279_nisn'] ?></td>
                                <td><?= $res['212279_nama_siswa'] ?></td>
                                <td><?= $res['212279_nama_angkatan'] ?></td>
                                <td><?= $res['212279_nama_kelas'] ?> <?= $res['212279_nama_jurusan'] ?></td>
                                <td><?= $res['212279_jk'] ?></td>
                                <td><?= $res['212279_alamat'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>