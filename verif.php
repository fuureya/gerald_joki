<?php
include 'koneksi.php';

// $id = $_GET['id'];
$email = $_GET['gmail'];

$query = mysqli_query($conn, "UPDATE admin_212279 SET 212279_status_admin ='1' WHERE 212279_email_admin = '$email' ");

if ($query) {
    echo "
    <script>
    alert('Selamat Sudah Verif')
    document.location.href='loginauth.php';
    </script>
    ";
}
