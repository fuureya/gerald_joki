<?php
ob_start();
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



if (isset($_SESSION['admin_212279'])) {
    header('location: index.php');
    die();
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaAdmin = htmlentities(strip_tags($_POST['nama_admin']));
    $userAdmin = htmlentities(strip_tags($_POST['user_admin']));
    $emailAdmin = htmlentities(strip_tags($_POST['email_admin']));
    $passAdmin = htmlentities(strip_tags($_POST['pass_admin']));
    $confirmPassAdmin = htmlentities(strip_tags($_POST['confirm_pass_admin']));

    // Validasi dasar
    if ($passAdmin !== $confirmPassAdmin) {
        echo "<script>alert('Kata sandi tidak cocok.');
              document.location = 'register.php';
              </script>";
        die();
    }

    if (strlen($passAdmin) < 8) {
        echo "<script>alert('Kata sandi harus memiliki panjang minimal 8 karakter.');
              document.location = 'register.php';
              </script>";
        die();
    }

    $kode = "<a href='http://localhost/Gerald/verif.php?gmail=$emailAdmin'>Verif Di Sini</a>";


    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'fahrulshevavanjovie@gmail.com';
    $mail->Password = 'hqdj btwg fsnx apyo';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom("admin@gmail.com");

    $mail->addAddress($emailAdmin);

    $mail->isHTML(true);

    $mail->Subject = "Verifikasi";

    $mail->Body = "Haloo $userAdmin, Silahkan verif di sini  $kode";

    $cekemail = $emailAdmin; // Ganti dengan email yang diinputkan dari form
    $sql = mysqli_query($conn, "SELECT * FROM admin_212279 WHERE 212279_email_admin='$cekemail'");



    if (mysqli_num_rows($sql) > 0) {
        echo "
        <script>
        alert('Email Sudah Terdaftar')
        document.location.href='register.php';
        </script>
        ";
    } else {

        $mail->send();
        $query = "INSERT INTO admin_212279 (212279_nama_admin, 212279_user_admin, 212279_pass_admin, 212279_email_admin) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $namaAdmin, $userAdmin, $passAdmin, $emailAdmin);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Pendaftaran berhasil.');
              document.location = 'loginauth.php';
              </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        $stmt->close();
        mysqli_close($conn);
    }




    // Masukkan data ke database
    $query = "INSERT INTO admin_212279 (212279_nama_admin, 212279_user_admin, 212279_pass_admin) VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $namaAdmin, $userAdmin, $passAdmin);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Pendaftaran berhasil.');
              document.location = 'loginauth.php';
              </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    $stmt->close();
    mysqli_close($conn);
}
?>

<!-- HTML code remains the same -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-8 shadow-1g my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img width="100%" height="100%" src="img/sma.jpg">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" name="nama_admin" id="exampleFirstName" placeholder="First Name" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" name="user_admin" id="exampleLastName" placeholder="Username" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email_admin" id="exampleInputEmail" placeholder="Email Address" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" name="pass_admin" id="exampleInputPassword" placeholder="Password" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" name="confirm_pass_admin" id="exampleRepeatPassword" placeholder="Repeat Password" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </button>

                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="loginauth.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>