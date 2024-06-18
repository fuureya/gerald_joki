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
                        <th>Nama Admin</th>
                        <th>User Admin</th>
                        <th>Password Admin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM admin_212279 ";
                    $exec = mysqli_query($conn, $query);
                    while ($res = mysqli_fetch_assoc($exec)) :
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $res['212279_nama_admin'] ?></td>
                            <td><?= $res['212279_user_admin'] ?></td>
                            <td><?= $res['212279_pass_admin'] ?></td>
                            <td>
                                <a href="editdataadmin.php?212279_id_admin=<?= $res['212279_id_admin'] ?>" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" data-idj="<?= $res['212279_id_admin']; ?>">Hapus</a>
                                <a href=" #" class="view_data btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editj" data-idj="<?= $res['212279_id_admin']; ?>" data-namaj="<?= $res['212279_nama_admin']; ?>" data-user="<?= $res['212279_user_admin']; ?>" data-pass="<?= $res['212279_pass_admin']; ?>">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="editdataadmin.php" method="POST">
                <div class="modal-body">
                    <input type="text" name="212279_nama_admin" placeholder="Nama Admin" class="form-control mb-2">
                    <input type="text" name="212279_user_admin" placeholder="User Admin" class="form-control mb-2">
                    <input type="text" name="212279_pass_admin" placeholder="Password Admin" class="form-control mb-2">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="212279_id_admin" id="idj" class="form-control mb-2">
                    <input type="text" name="212279_nama_admin" id="namaj" placeholder=" Nama Admin" class="form-control mb-2">
                    <input type="text" name="212279_user_admin" id="user" placeholder=" User Admin" class="form-control mb-2">
                    <input type="text" name="212279_pass_admin" id="pass" placeholder=" Password Admin" class="form-control mb-2">
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="editdataadmin.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="idj" class="form-control mb-2">
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
            let idj = button.data('idj'); //data-idadmin
            let namaj = button.data('namaj'); //data-namaj
            let user = button.data('user'); //data-user
            let pass = button.data('pass'); //data-pass
            let modal = $('#editj');
            modal.find('#idj').val(idj);
            modal.find('#namaj').val(namaj);
            modal.find('#user').val(user);
            modal.find('#pass').val(pass);
        });
    });
    $(document).ready(function() {
        // $("#hapus").on("show.bs.modal", function(event) {
        //     let button = $(event.relatedTarget);
        //     let idj = button.data('idj'); //data-idadmin

        //     let modal = $('#hapus');
        //     modal.find('#idj').value = idj;



        // });

        $("#hapus").on("show.bs.modal", function(event) {
            let button = $(event.relatedTarget);
            let idj = button.data('idj'); // Mengambil nilai dari data-idj
            let modal = $(this);
            modal.find('#idj').val(idj); // Set nilai idj ke input dengan idj

            // Tambahkan script untuk mengirim nilai idj ke PHP menggunakan AJAX
            $('#hapusBtn').click(function() {
                let idj = modal.find('#idj').val();
                $.ajax({
                    type: 'POST',
                    url: 'editdataadmin.php', // Sesuaikan dengan file PHP yang akan menghandle proses hapus
                    data: {
                        'hapus': true,
                        '212279_id_admin': idj
                    },
                    success: function(response) {
                        // Handle response dari PHP (opsional)
                        console.log(response); // Cetak response ke konsol untuk debugging
                        // Gunakan SweetAlert atau pesan lain untuk memberitahu pengguna
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Dihapus!',
                            showConfirmButton: true,
                        }).then((result) => {
                            location.reload(); // Refresh halaman setelah menghapus
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Cetak error ke konsol untuk debugging
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menghapus data.',
                            showConfirmButton: true,
                        });
                    }
                });
            });
        });
    });
</script>

<?php
include 'footer.php';

if (isset($_POST['simpan'])) {
    $nama_admin = htmlentities(strip_tags($_POST['212279_nama_admin']));
    $user_admin = htmlentities(strip_tags($_POST['212279_user_admin']));
    $pass_admin = htmlentities(strip_tags($_POST['212279_pass_admin']));

    $query = "INSERT INTO admin_212279 (212279_nama_admin, 212279_user_admin, 212279_pass_admin) VALUES ('$nama_admin', '$user_admin', '$pass_admin') ";
    // var_dump($query);

    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataadmin.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Tambahkan!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataadmin.php';
    });
</script>";
    }
}

if (isset($_POST['edit'])) {
    $id_admin = $_POST['212279_id_admin'];
    $nama_admin = htmlentities(strip_tags($_POST['212279_nama_admin']));
    $user_admin = htmlentities(strip_tags($_POST['212279_user_admin']));
    $pass_admin = htmlentities(strip_tags($_POST['212279_pass_admin']));
    $query = "UPDATE admin_212279 SET 212279_nama_admin='$nama_admin', 212279_user_admin='$user_admin', 212279_pass_admin='$pass_admin' WHERE 212279_id_admin= '$id_admin'";
    $exec = mysqli_query($conn, $query);
    if ($exec) {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Ubah!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataadmin.php';
    });
</script>";
    } else {
        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Ubah!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataadmin.php';
    });
</script>";
    }
}

if (isset($_POST['hapus'])) {
    $id_admin = $_POST['id'];

    $cek = mysqli_num_rows(mysqli_query($conn, "select * from admin_212279 where 212279_id_admin = '$id_admin'"));
    echo "
    
    <script>
        alert($cek);
    </script>
    
    ";

    if ($cek >= 0) {
        $exec = mysqli_query($conn, "DELETE FROM admin_212279 WHERE 212279_id_admin='$id_admin'");
        if ($exec) {
            echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Di Hapus!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataadmin.php';
    });
</script>";
        } else {
            echo "<script>
    Swal.fire({
        icon: 'warning',
        title: 'Data Gagal Di Hapus!',
        showConfirmButton: true,
    }).then((result) => {
        location = 'editdataadmin.php';
    });
</script>";
        }
    } else {
        echo "<script>
Swal.fire({
    icon: 'warning',
    title: 'Data Gagal Di Hapus!, admin ini terpakai.',
    showConfirmButton: true,
}).then((result) => {
    location = 'editdataadmin.php';
});
</script>";
    }
}


// if (isset($_POST['hapus'])) {
//     $id_admin = $_POST['212279_id_admin']; // Ambil id_admin dari AJAX

//     // Lakukan penghapusan data
//     $exec = mysqli_query($conn, "DELETE FROM admin_212279 WHERE 212279_id_admin='$id_admin'");
//     if ($exec) {
//         echo "Data Berhasil Dihapus";
//     } else {
//         echo "Gagal menghapus data: " . mysqli_error($conn);
//     }
// }
