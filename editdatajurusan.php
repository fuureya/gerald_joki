<?php include 'header.php';
include 'koneksi.php';

?>

<!-- button triger -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
<!-- button triger -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Jurusan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM jurusan_212279 ";
                    $exec = mysqli_query($conn, $query);
                    while ($res = mysqli_fetch_assoc($exec)) :
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $res['212279_nama_jurusan'] ?></td>
                            <td>
                                <a href="editdatajurusan.php?212279_id_jurusan=<?= $res['212279_id_jurusan'] ?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" data-idj="<?= $res['212279_id_jurusan']; ?>">Hapus</a>
                                <a href=" #" class="view_data btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editj" data-idj="<?= $res['212279_id_jurusan']; ?>" data-namaj="<?= $res['212279_nama_jurusan']; ?>">Edit</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Data Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="text" name="212279_nama_jurusan" placeholder="Nama Jurusan" class="form-control mb-2">
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="212279_id_jurusan" id="idj" class="form-control mb-2">
                    <input type="text" name="212279_nama_jurusan" id="namaj" placeholder=" Nama Jurusan" class="form-control mb-2">
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="212279_id_jurusan" id="idj" class="form-control mb-2">
                    <h3>Yakin Ingin Menghapus Data Ini?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="hapus" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#editj").on("show.bs.modal", function(event) {
            let button = $(event.relatedTarget);
            let idj = button.data('idj'); //data-idjurusan
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

    $nama_jurusan = htmlentities(strip_tags($_POST['212279_nama_jurusan']));

    $query = "INSERT INTO jurusan_212279 (212279_nama_jurusan) VALUES ('$nama_jurusan') ";
    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatajurusan.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatajurusan.php';
    });
</script>";
    }
}

if (isset($_POST['edit'])) {
    $id_jurusan = $_POST['212279_id_jurusan'];
    $nama_jurusan = htmlentities(strip_tags($_POST['212279_nama_jurusan']));
    $query = "UPDATE jurusan_212279 SET 212279_nama_jurusan='$nama_jurusan' WHERE 212279_id_jurusan= '$id_jurusan'";
    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Ubah!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatajurusan.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Ubah!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatajurusan.php';
    });
</script>";
    }
}

if (isset($_POST['hapus'])) {
    $id_jurusan = $_POST['212279_id_jurusan'];
    $cek = mysqli_num_rows(mysqli_query($conn, "select * from siswa_212279 where 212279_id_jurusan = '$id_kelas'"));
    if ($cek <= 0) {
        $exec = mysqli_query($conn, "DELETE FROM jurusan_212279 WHERE 212279_id_jurusan='$id_jurusan'");
        if ($exec) {
            echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Hapus!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatajurusan.php';
    });
</script>";
        } else {
            echo "<script>
    Swal.fire({
        icon: 'warning',
        title: 'Data Gagal Di Hapus!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdatajurusan.php';
    });
</script>";
        }
    } else {
        echo "<script>
Swal.fire({
    icon: 'warning',
    title: 'Data Gagal Di Hapus!, jurusan ini terpakai.',
    showConfirmButton: true,
}).then((result) => {
    location = 'editdatajurusan.php';
});
</script>";
    }
}
