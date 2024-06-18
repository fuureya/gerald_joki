<?php include 'koneksi.php';

// if (isset($_POST['id_siswa'])) {
//     $id_siswa = $_POST['id_siswa'];
//     $query = "SELECT siswa_212279.*,angkatan_212279.*,kelas_212279.* FROM siswa_212279,angkatan_212279,jurusan_212279,kelas_212279 WHERE siswa_212279. 
//     212279_id_angkatan = angkatan_212279.212279_id_angkatan AND siswa_212279.212279_id_jurusan = jurusan_212279.212279_id_jurusan AND siswa_212279.212279_id_kelas =
//     kelas_212279.212279_id_kelas AND siswa_212279.212279_id_siswa = $id_siswa";
//     $exec = mysqli_query($conn, $query);
//     $res = mysqli_fetch_assoc($exec);
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
    // 
?>

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

<?php } ?>
<?php

if (isset($_POST['id_kelas'])) {
    $id_kelas = $_POST['id_kelas'];
    $exec = mysqli_query($conn, "SELECT * FROM kelas_212279 WHERE 212279_id_kelas='$id_kelas'");
    $res = mysqli_fetch_assoc($exec);
?>
    <form action="editdatakelas.php" method="POST">
        <input type="hidden" name="212279_id_kelas" value="<?= $res['212279_id_kelas'] ?>">
        <input type="text" name="212279_nama_kelas" class="form-control" value="<?= $res['212279_nama_kelas'] ?>">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
    </form>

<?php }
if (isset($_POST['id_jurusan'])) {
    $id_jurusan = $_POST['id_jurusan'];
    $exec = mysqli_query($conn, "SELECT * FROM jurusan_212279 WHERE 212279_id_jurusan='$id_jurusan'");
    $res = mysqli_fetch_assoc($exec);
?>
    <form action="editdatajurusan.php" method="POST">
        <input type="hidden" name="212279_id_jurusan" value="<?= $res['212279_id_jurusan'] ?>">
        <input type="text" name="212279_nama_jurusan" class="form-control" value="<?= $res['212279_nama_jurusan'] ?>">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
    </form>

<?php }
if (isset($_POST['id_angkatan'])) {
    $id_angkatan = $_POST['id_angkatan'];
    $exec = mysqli_query($conn, "SELECT * FROM angkatan_212279 WHERE 212279_id_angkatan='$id_angkatan'");
    $res = mysqli_fetch_assoc($exec);
?>
    <form action="editdataangkatan.php" method="POST">
        <input type="hidden" name="212279_id_angkatan" value="<?= $res['212279_id_angkatan'] ?>">
        <input type="text" name="212279_nama_angkatan" class="form-control" value="<?= $res['212279_nama_angkatan'] ?>">
        <input type="text" name="212279_biaya" class="form-control" value="<?= $res['212279_biaya'] ?>">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
    </form>

<?php }
?>