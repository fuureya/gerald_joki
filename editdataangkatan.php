<?php include 'header.php';
include 'koneksi.php';

?>

<!-- button triger -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
<!-- button triger -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Angkatan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM angkatan_212279 ";
                    $exec = mysqli_query($conn, $query);
                    while ($res = mysqli_fetch_assoc($exec)) :
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $res['212279_nama_angkatan'] ?></td>
                            <td><?= $res['212279_biaya'] ?></td>
                            <td>
                                <a href="editdataangkatan.php?212279_id_angkatan=<?= $res['212279_id_angkatan'] ?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" data-idj="<?= $res['212279_id_angkatan']; ?>">Hapus</a>
                                <a href=" #" class="view_data btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editj" data-idj="<?= $res['212279_id_angkatan']; ?>" data-namaj="<?= $res['212279_nama_angkatan']; ?>" data-biaya="<?= $res['212279_biaya']; ?>">Edit</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Data Angkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="text" name="212279_nama_angkatan" placeholder="Nama Angkatan" class="form-control mb-2">
                    <input type="text" name="212279_biaya" placeholder="Biaya Angkatan" class="form-control mb-2">
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
<div class="modal fade" id="editj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Angkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="212279_id_angkatan" id="idj" class="form-control mb-2">
                    <input type="text" name="212279_nama_angkatan" id="namaj" placeholder=" Nama angkatan" class="form-control mb-2">
                    <input type="text" name="212279_biaya" id="biaya" placeholder=" Biaya Angkatan" class="form-control mb-2">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal hapus data siswa -->
<div class="modal fade" id="hapus">
    <div class=" modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Angkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="212279_id_angkatan" id="idj" class="form-control mb-2">
                    <h3>Yakin Ingin Menghapus Data Ini?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#editj").on("show.bs.modal", function(event) {
            let button = $(event.relatedTarget);
            let idj = button.data('idj'); //data-idangkatan
            let namaj = button.data('namaj'); //data-namaj
            let biaya = button.data('biaya'); //data-biaya
            let modal = $('#editj');
            modal.find('#idj').val(idj);
            modal.find('#namaj').val(namaj);
            modal.find('#biaya').val(biaya);
        });
    });
    $(document).ready(function() {
        $("#hapus").on("show.bs.modal", function(event) {
            let button = $(event.relatedTarget);
            let idj = button.data('idj'); //data-idangkatan
            let modal = $('#hapus');
            modal.find('#idj').val(idj);
        });
    });
</script>

<?php
include 'footer.php';

if (isset($_POST['simpan'])) {

    $nama_angkatan = htmlentities(strip_tags($_POST['212279_nama_angkatan']));
    $biaya = htmlentities(strip_tags($_POST['212279_biaya']));

    $query = "INSERT INTO angkatan_212279 (212279_nama_angkatan, 212279_biaya) VALUES ('$nama_angkatan', '$biaya') ";
    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataangkatan.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataangkatan.php';
    });
</script>";
    }
}

if (isset($_POST['edit'])) {
    $id_angkatan = $_POST['212279_id_angkatan'];
    $nama_angkatan = htmlentities(strip_tags($_POST['212279_nama_angkatan']));
    $biaya = htmlentities(strip_tags($_POST['212279_biaya']));
    $query = "UPDATE angkatan_212279 SET 212279_nama_angkatan='$nama_angkatan', 212279_biaya='$biaya' WHERE 212279_id_angkatan= '$id_angkatan'";
    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Ubah!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataangkatan.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Ubah!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataangkatan.php';
    });
</script>";
    }
}

if (isset($_POST['hapus'])) {
    $id_angkatan = $_POST['212279_id_angkatan'];
    $cek = mysqli_num_rows(mysqli_query($conn, "select * from siswa_212279 where 212279_id_angkatan = '$id_kelas'"));
    if ($cek <= 0) {
        $exec = mysqli_query($conn, "DELETE FROM angkatan_212279 WHERE 212279_id_angkatan='$id_angkatan'");
        if ($exec) {
            echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Hapus!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataangkatan.php';
    });
</script>";
        } else {
            echo "<script>
    Swal.fire({
        icon: 'warning',
        title: 'Data Gagal Di Hapus!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataangkatan.php';
    });
</script>";
        }
    } else {
        echo "<script>
Swal.fire({
    icon: 'warning',
    title: 'Data Gagal Di Hapus!, angkatan ini terpakai.',
    showConfirmButton: true,
}).then((result) => {
    location = 'editdataangkatan.php';
});
</script>";
    }
}
