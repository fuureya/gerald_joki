<?php

ob_start();
session_start();

// Include your database connection file
require_once 'koneksi.php';

// Check if the user is already logged in
if (isset($_SESSION['admin_212279'])) {
  header('location: index.php');
  die();
}

// Check if the user has clicked the login button
if (isset($_POST['login'])) {
  // Sanitize and validate user input
  $user = htmlentities(strip_tags($_POST['user']));
  $pass = htmlentities(strip_tags($_POST['pass']));

  // Check if the password is at least 8 characters long
  if (strlen($pass) >= 8) {
    // Query to check if the username exists in the database
    $query = "SELECT * FROM admin_212279 WHERE 212279_user_admin ='$user'";
    $exec = mysqli_query($conn, $query);

    // Check if the username exists
    if (mysqli_num_rows($exec) !== 0) {
      // Query to check if the password matches the username
      $query = "SELECT * FROM admin_212279 WHERE 212279_pass_admin ='$pass'";
      $exec = mysqli_query($conn, $query);

      // Check if the password matches
      if (mysqli_num_rows($exec) !== 0) {
        // Get the user's data from the database
        $res = mysqli_fetch_assoc($exec);

        // Set session variables
        $_SESSION['admin_212279'] = $res['212279_id_admin'];
        $_SESSION['212279_nama_admin'] = $res['212279_nama_admin'];

        // Redirect to the index page
        header('location: index.php');
      } else {
        // Display an error message if the password is incorrect
        echo "<script>alert('Password Yang Anda Masukkan Salah');
        document.location = 'loginauth.php';
        </script>";
      }
    } else {
      // Display an error message if the username is not found
      echo "<script>alert('User Admin Tidak Tersedia');
        document.location = 'loginauth.php';
        </script>";
    }
  }
}

// Google login code
if (isset($_GET['code'])) {
  // Exchange the authorization code for an access token
  $token = getAccessToken($_GET['code']);

  // Use the access token to get the user's information
  $user = getUserInfo($token);

  // Check if the user already exists in the database
  $query = "SELECT * FROM admin_212279 WHERE 212279_email_admin = '" . $user['email'] . "'";
  $exec = mysqli_query($conn, $query);

  // If the user exists, log them in
  if (mysqli_num_rows($exec) !== 0) {
    $res = mysqli_fetch_assoc($exec);
    $_SESSION['admin_212279'] = $res['212279_id_admin'];
    $_SESSION['212279_nama_admin'] = $res['212279_nama_admin'];
    header('location: index.php');
  } else {
    // If the user doesn't exist, create a new account
    $query = "INSERT INTO admin_212279 (212279_nama_admin, 212279_user_admin, 212279_pass_admin, 212279_email_admin) VALUES ('" . $user['name'] . "', '" . $user['email'] . "', '" . generateRandomPassword() . "', '" . $user['email'] . "')";
    if (mysqli_query($conn, $query)) {
      // Get the newly created user's ID
      $user_id = mysqli_insert_id($conn);

      // Set session variables
      $_SESSION['admin_212279'] = $user_id;
      $_SESSION['212279_nama_admin'] = $user['name'];

      // Redirect to the index page
      header('location: index.php');
    } else {
      // Display an error message if the account creation fails
      echo "<script>alert('Error creating account!');
            document.location = 'loginauth.php';
            </script>";
    }
  }
}

// Function to get the access token
function getAccessToken($code)
{
  // Replace with your Google Client ID and Client Secret
  $clientId = 'YOUR_GOOGLE_CLIENT_ID';
  $clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
  $redirectUri = 'http://localhost/your-project/loginauth.php'; // Replace with your actual redirect URI

  $url = "https://oauth2.googleapis.com/token";
  $data = array(
    'code' => $code,
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectUri,
    'grant_type' => 'authorization_code'
  );

  // Make an HTTP request to get the access token
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  curl_close($ch);

  // Parse the response and return the access token
  $token = json_decode($response, true);
  return $token['access_token'];
}

// Function to get the user's information
function getUserInfo($accessToken)
{
  $url = "https://www.googleapis.com/oauth2/v3/userinfo";

  // Make an HTTP request to get the user's information
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $accessToken
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  // Parse the response and return the user's information
  return json_decode($response, true);
}

// Function to generate a random password
function generateRandomPassword()
{
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $password = '';
  for ($i = 0; $i < 12; $i++) {
    $password .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $password;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
  <link href="foto/logos.png" rel="icon" type="images/x-icon">\
  <!-- Custom styles for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/
        css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <!-- Login Content -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-8 shadow-1g my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
                <img width="109%" height="100%" src="img/sma.jpg">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Silahkan Login</h1>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="text" autocomplete="off" required name="user" class="form-control form-control-user" id="exampleInputEmail" arla-describedby="emaiHelp" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                      <input type="text" autocomplete="off" required name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <button type="submit" name="login" class="btn-primary btn-user
                   btn-block">Login</button>

                    <!-- Google Login Button -->

                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="register.php">Create an Account!</a>
                  </div>
                </div>
                <div class="text-center">
                  <a c <hr>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
    $('input').attr('autocomplete', 'off');
  </script>
</body>

</html>