<?php include 'header.php';
include 'koneksi.php';

$nisn = date('dmYHis');

// if (isset($_POST['id_siswa'])) {
//     $id_siswa = $_POST['id_siswa'];
//     $query = "SELECT siswa_212279.*,angkatan_212279.*,kelas_212279.* FROM siswa_212279,angkatan_212279,kelas_212279 WHERE siswa_212279. 
//     212279_id_angkatan = angkatan_212279.212279_id_angkatan AND siswa_212279.212279_id_kelas =
//     kelas_212279.212279_id_kelas AND siswa_212279.212279_id_siswa = $id_siswa";
//     $exec = mysqli_query($conn, $query);
//     $res = mysqli_fetch_assoc($exec);
// }

if (isset($_POST['id_siswa'])) {
    $id_siswa = $_POST['id_siswa'];

    // Buat parameter untuk query dengan placeholder '?'
    $query = "SELECT siswa_212279.*, angkatan_212279.*, kelas_212279.* 
              FROM siswa_212279
              INNER JOIN angkatan_212279 ON siswa_212279.212279_id_angkatan = angkatan_212279.212279_id_angkatan
              INNER JOIN kelas_212279 ON siswa_212279.212279_id_kelas = kelas_212279.212279_id_kelas
              WHERE siswa_212279.212279_id_siswa = ?";

    // Persiapkan statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "i", $id_siswa);

    // Eksekusi statement
    mysqli_stmt_execute($stmt);

    // Ambil hasil query
    $exec = mysqli_stmt_get_result($stmt);

    // Fetch hasil ke dalam array asosiatif
    $res = mysqli_fetch_assoc($exec);

    // Selanjutnya, Anda bisa menggunakan $res untuk mengakses hasil query
}

?>


<!-- button triger -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
<!-- button triger -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nis</th>
                        <th>Nama Siswa</th>
                        <th>Angkatan</th>
                        <th>Kelas</th>

                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT siswa_212279.*,angkatan_212279.*,kelas_212279.* FROM siswa_212279,angkatan_212279,jurusan_212279,kelas_212279
                WHERE siswa_212279.212279_id_angkatan = angkatan_212279.212279_id_angkatan 
                AND siswa_212279.212279_id_kelas = kelas_212279.212279_id_kelas ORDER BY 212279_id_siswa";

                    $exec = mysqli_query($conn, $query);
                    while ($res = mysqli_fetch_assoc($exec)) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <img src="upload/<?= $res['212279_foto'] ?>" alt="siswa" width="100">
                            </td>
                            <td><?= $res['212279_nisn'] ?></td>
                            <td><?= $res['212279_nama_siswa'] ?></td>
                            <td><?= $res['212279_nama_angkatan'] ?></td>
                            <td><?= $res['212279_nama_kelas'] ?></td>

                            <td><?= $res['212279_jk'] ?></td>
                            <td><?= $res['212279_alamat'] ?></td>
                            <td><?= $res['212279_status'] ?></td>
                            <td>
                                <a href="editdatasiswa.php?212279_id_siswa=<?= $res['212279_id_siswa'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Yakin Ingin Menghapus Data?')">Hapus</a>
                                <a href="#" class="view_data btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#myModal" id="
                                                <?php echo $res['212279_id_siswa']; ?>">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <input type="text" placeholder="Nama Siswa" readonly class="form-control mb-2" value="<?= $nisn ?>">
                    <input type="text" name="212279_nama_siswa" placeholder="Nama Siswa" class="form-control mb-2">
                    <select class="form-control mb-2" name="212279_id_angkatan">
                        <option selected="">-Pilih Angkatan-</option>
                        <?php
                        $exec = mysqli_query($conn, "SELECT * FROM angkatan_212279 ORDER BY 212279_id_angkatan");
                        while ($angkatan = mysqli_fetch_assoc($exec)) :
                            echo "<option value=" . $angkatan['212279_id_angkatan'] . ">" . $angkatan['212279_nama_angkatan'] . "
                    </option>";
                        endwhile;
                        ?>
                    </select>
                    <select class="form-control mb-2" name="212279_id_kelas">
                        <option selected="">-Pilih Kelas-</option>
                        <?php
                        $exec = mysqli_query($conn, "SELECT * FROM kelas_212279 ORDER BY 212279_id_kelas");
                        while ($angkatan = mysqli_fetch_assoc($exec)) :
                            echo "<option value=" . $angkatan['212279_id_kelas'] . ">" . $angkatan['212279_nama_kelas'] . "
                    </option>";
                        endwhile;
                        ?>
                    </select>
                    <!-- <select class="form-control mt-2" name="212279_id_jurusan">
                        <option selected="">-Pilih Jurusan-</option>
                        <?php
                        //     $exec = mysqli_query($conn, "SELECT * FROM jurusan_212279 ORDER BY 212279_id_jurusan");
                        //     while ($angkatan = mysqli_fetch_assoc($exec)) :
                        //         echo "<option value=" . $angkatan['212279_id_jurusan'] . ">" . $angkatan['212279_nama_jurusan'] . "
                        // </option>";
                        //     endwhile;
                        ?>
                    </select> -->

                    <div class="mb-3">
                        <input type="radio" name="jk" id="pria" value="Pria">
                        <label for="pria" class="form-label">Pria</label><br>
                        <input type="radio" name="jk" id="wanita" value="Wanita">
                        <label for="pria" class="form-label">Wanita</label>
                    </div>

                    <textarea class="form-control" name="212279_alamat" placeholder="Alamat Siswa"></textarea>
                    <textarea class="form-control" name="212279_status" placeholder="Status Siswa"></textarea>
                    <div class="mb-3">
                        <label for="siswa" class="form-label">Foto Siswa</label>
                        <input type="file" name="foto" class="form-control" required accept="image/*">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="Submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit data siswa -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body" id="datasiswa">
                <form action="editdatasiswa.php" method="POST">
                    <input type="hidden" name="212279_id_siswa" value="<?= $res['212279_id_siswa'] ?>">
                    <input type="hidden" name="212279_nisn" value="<?= $res['212279_nisn'] ?>">
                    <input type="text" class="form-control mb-2" name="" disabled="" value="<?= $res['212279_nisn'] ?>">
                    <input type="text" class="form-control mb-2" name="212279_nama_siswa" value="<?= $res['212279_nama_siswa'] ?>">
                    <select class="form-control mb-2" name="212279_id_angkatan">
                        <option selected="">-Pilih Angkatan-</option>
                        <?php
                        $exec = mysqli_query($conn, "SELECT * FROM angkatan_212279 order by 212279_id_angkatan");
                        while ($angkatan = mysqli_fetch_assoc($exec)) :
                            if ($res['212279_id_angkatan'] == $angkatan['212279_id_angkatan']) {
                                $selected = 'selected';
                            } else {
                                $selected = "";
                            }
                            echo "<option $selected value=" . $angkatan['212279_id_angkatan'] . ">" . $angkatan['212279_nama_angkatan'] . "
                    </option>";
                        endwhile;
                        ?>
                    </select>
                    <select class="form-control mb-2" name="212279_id_kelas">
                        <option selected="">-Pilih Kelas-</option>
                        <?php
                        $exec = mysqli_query($conn, "SELECT * FROM kelas_212279 order by 212279_id_kelas");
                        while ($angkatan = mysqli_fetch_assoc($exec)) :
                            if ($res['212279_id_kelas'] == $angkatan['212279_id_kelas']) {
                                $selected = 'selected';
                            } else {
                                $selected = "";
                            }
                            echo "<option $selected value=" . $angkatan['212279_id_kelas'] . ">" . $angkatan['212279_nama_kelas'] . "
                    </option>";
                        endwhile;
                        ?>
                    </select>
                    <!-- <select class="form-control" name="212279_id_jurusan">
                        <option selected="">-Pilih Jurusan-</option>
                        <?php
                        // $exec = mysqli_query($conn, "SELECT * FROM jurusan_212279 ORDER BY 212279_id_jurusan");
                        // while ($angkatan = mysqli_fetch_assoc($exec)) :
                        //     if ($res['212279_id_jurusan'] == $angkatan['212279_id_jurusan']) {
                        //         $selected = 'selected';
                        //     } else {
                        //         $selected = "";
                        //     }
                        //     echo "<option $selected value=" . $angkatan['212279_id_jurusan'] . ">" . $angkatan['212279_nama_jurusan']
                        //         . "</option>";
                        // endwhile;
                        ?>
                    </select> -->
                    <div class="mb-3">
                        <input type="radio" name="jk" id="pria" value="Pria">
                        <label for="pria" class="form-label">Pria</label><br>
                        <input type="radio" name="jk" id="wanita" value="Wanita">
                        <label for="pria" class="form-label">Wanita</label>
                    </div>
                    <textarea class="form-control mt-2" name="212279_alamat" placeholder="Alamat Siswa"><?= $res['212279_alamat'] ?></textarea>
                    <textarea class="form-control mt-2" name="212279_status" placeholder="Status Siswa"><?= $res['212279_status'] ?></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

if (isset($_POST['simpan'])) {

    $nama_siswa = htmlentities(strip_tags(ucwords($_POST['212279_nama_siswa'])));
    $id_kelas = htmlentities(strip_tags($_POST['212279_id_kelas']));
    //$id_jurusan = htmlentities(strip_tags($_POST['212279_id_jurusan']));
    $id_angkatan = htmlentities(strip_tags($_POST['212279_id_angkatan']));
    $alamat = htmlentities(strip_tags(ucwords($_POST['212279_alamat'])));
    $status = htmlentities(strip_tags(ucwords($_POST['212279_status'])));
    $jk = $_POST['jk'];
    $foto = $_FILES['foto'];

    // if ($id_jurusan == '-Pilih Jurusan-') {
    //     echo "<script>
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Harap pilih jurusan!',
    //             showConfirmButton: true,
    //         });
    //     </script>";
    // }

    $ekstensi = pathinfo($foto['name'])['extension'];
    $nama_foto = rand(1000, 9999) . '.' . $ekstensi;

    $direktori = "upload/";
    $cek_upload = move_uploaded_file($foto['tmp_name'], $direktori . $nama_foto);

    $query = "INSERT INTO siswa_212279 (212279_nisn, 212279_nama_siswa, 212279_id_angkatan, 212279_id_kelas, 212279_alamat, 212279_status, 212279_jk, 212279_foto) VALUES ('$nisn'
    , '$nama_siswa', '$id_angkatan', '$id_kelas', '$alamat', '$status', '$jk', '$nama_foto')";
    $exec = mysqli_query($conn, $query);
    if ($exec) {

        $bulanIndo = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $query = "SELECT siswa_212279.*,angkatan_212279.* FROM siswa_212279,angkatan_212279 WHERE siswa_212279.212279_id_angkatan = angkatan_212279.
        212279_id_angkatan ORDER BY siswa_212279.212279_id_siswa DESC LIMIT 1";
        $exec = mysqli_query($conn, $query);
        $res = mysqli_fetch_assoc($exec);
        $biaya = $res['212279_biaya'];
        $id_siswa = $res['212279_id_siswa'];
        $awaltempo = date('Y-m-d');
        for ($i = 0; $i < 36; $i++) {
            //tanggal jatuh tempo setiap tanggal 10
            $jatuhtempo = date("Y-m-d", strtotime("+$i month", strtotime($awaltempo)));

            $bulan = $bulanIndo[date('m', strtotime($jatuhtempo))] . " " . date('Y', strtotime($jatuhtempo));
            //simpan data
            $add = mysqli_query($conn, "INSERT INTO pembayaran_212279 (212279_id_siswa, 212279_jatuhtempo, 212279_bulan, 212279_jumlah) 
            VALUES ('$id_siswa','$jatuhtempo','$bulan', '$biaya')");
        }
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatasiswa.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatasiswa.php';
    });
</script>";
    }
}

?>
<?php include 'footer.php'; ?>

<script type="text/javascript">
    $('.view_data').click(function() {
        var id_siswa = $(this).attr('id');
        $.ajax({
            url: 'view.php',
            method: 'post',
            data: {
                id_siswa: id_siswa
            },
            success: function(data) {
                $('#datasiswa').html(data)
                $('#myModal').modal('show');
            }
        })
    })
</script>

<?php
if (isset($_POST['edit'])) {

    $id_siswa = $_POST['212279_id_siswa'];
    $nisn = $_POST['212279_nisn'];
    $nama_siswa = htmlentities(strip_tags(ucwords($_POST['212279_nama_siswa'])));
    $id_kelas = htmlentities(strip_tags(ucwords($_POST['212279_id_kelas'])));
    //$id_jurusan = htmlentities(strip_tags(ucwords($_POST['212279_id_jurusan'])));
    $id_angkatan = htmlentities(strip_tags(ucwords($_POST['212279_id_angkatan'])));
    $alamat = htmlentities(strip_tags(ucwords($_POST['212279_alamat'])));
    $jk = $_POST['jk'];
    $status = htmlentities(strip_tags(ucwords($_POST['212279_status'])));
    $query = "UPDATE siswa_212279 SET 
                                        212279_nisn = '$nisn', 
                                        212279_nama_siswa = '$nama_siswa',
                                        
                                        212279_id_angkatan = '$id_angkatan',
                                        212279_id_kelas = '$id_kelas',
                                        212279_alamat = '$alamat',
                                        212279_jk = '$jk',
                                        212279_status = '$status' WHERE 212279_id_siswa='$id_siswa'";
    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Di Ubah!',
            showConfirmButton: true,
        }).then((result) => {
            location = 'editdatasiswa.php';
        });
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Di Ubah!',
            showConfirmButton: true,
        }).then((result) => {
            location = 'editdatasiswa.php';
        });
    </script>";
    }
}
if (isset($_GET['212279_id_siswa'])) {
    $id_siswa = $_GET['212279_id_siswa'];
    $cek = mysqli_num_rows(mysqli_query($conn, "select * from siswa_212279 where 212279_id_kelas = '$id_kelas'"));
    if ($cek <= 0) {
        $exec = mysqli_query($conn, "DELETE FROM siswa_212279 WHERE 212279_id_siswa = '$id_siswa'");
        if ($exec) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Di Hapus!',
                showConfirmButton: true,
            }).then((result) => {
                location = 'editdatasiswa.php';
            });
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Di Hapus!',
                showConfirmButton: true,
            }).then((result) => {
                location = 'editdatasiswa.php';
            });
        </script>";
        }
    }
}
