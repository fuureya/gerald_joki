<?php include 'header.php';
include 'koneksi.php';

?>

<!-- button triger -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
<!-- button triger -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM kelas_212279 ";
                    $exec = mysqli_query($conn, $query);
                    while ($res = mysqli_fetch_assoc($exec)) :
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $res['212279_nama_kelas'] ?></td>
                            <td>
                                <a href="editdatakelas.php?212279_id_kelas=<?= $res['212279_id_kelas'] ?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" data-idj="<?= $res['212279_id_kelas']; ?>">Hapus</a>
                                <a href=" #" class="view_data btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editj" data-idj="<?= $res['212279_id_kelas']; ?>" data-namaj="<?= $res['212279_nama_kelas']; ?>">Edit</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Data Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="text" name="212279_nama_kelas" placeholder="Nama Kelas" class="form-control mb-2">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="Submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit data kelas -->
<div class="modal fade" id="editj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="212279_id_kelas" id="idj" class="form-control mb-2">
                    <input type="text" name="212279_nama_kelas" id="namaj" placeholder=" Nama Kelas" class="form-control mb-2">
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="212279_id_kelas" id="idj" class="form-control mb-2">
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
            let idj = button.data('idj'); //data-idkelas
            let namaj = button.data('namaj'); //data-namaj
            let modal = $('#editj');
            modal.find('#idj').val(idj);
            modal.find('#namaj').val(namaj);
        });
    });
    $(document).ready(function() {
        $("#hapus").on("show.bs.modal", function(event) {
            let button = $(event.relatedTarget);
            let idj = button.data('idj'); //data-idjurusan
            let modal = $('#hapus');
            modal.find('#idj').val(idj);
        });
    });
</script>

<?php
include 'footer.php';

if (isset($_POST['simpan'])) {

    $nama_kelas = htmlentities(strip_tags($_POST['212279_nama_kelas']));

    $query = "INSERT INTO kelas_212279 (212279_nama_kelas) VALUES ('$nama_kelas') ";
    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatakelas.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatakelas.php';
    });
</script>";
    }
}

if (isset($_POST['edit'])) {
    $id_kelas = $_POST['212279_id_kelas'];
    $nama_kelas = htmlentities(strip_tags($_POST['212279_nama_kelas']));
    $query = "UPDATE kelas_212279 SET 212279_nama_kelas='$nama_kelas' WHERE 212279_id_kelas= '$id_kelas'";
    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Ubah!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatakelas.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Ubah!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatakelas.php';
    });
</script>";
    }
}

if (isset($_POST['hapus'])) {
    $id_kelas = $_POST['212279_id_kelas'];
    $cek = mysqli_num_rows(mysqli_query($conn, "select * from siswa_212279 where 212279_id_kelas = '$id_kelas'"));
    if ($cek <= 0) {
        $exec = mysqli_query($conn, "DELETE FROM kelas_212279 WHERE 212279_id_kelas='$id_kelas'");
        if ($exec) {
            echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Hapus!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatakelas.php';
    });
</script>";
        } else {
            echo "<script>
    Swal.fire({
        icon: 'warning',
        title: 'Data Gagal Di Hapus!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatakelas.php';
    });
</script>";
        }
    } else {
        echo "<script>
Swal.fire({
    icon: 'warning',
    title: 'Data Gagal Di Hapus!, Kelas ini terpakai.',
    showConfirmButton: true,
}).then((result) => {
    location = 'editdatakelas.php';
});
</script>";
    }
}
