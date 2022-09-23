<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'db_connection.php';

session_start();

if(!isset($_SESSION['studentid']))
{
    header("location:login.php");
}

if($_POST)
{
    $email = $_POST['email'];

    $selectquery = mysqli_query($connection,"select * from tbl_user where email='{$email}' ");
    $count = mysqli_num_rows($selectquery);
    $row = mysqli_fetch_array($selectquery);

    if($count>0)
    {
        
// Import PHPMailer classes at the top

// Load Composer's autoloader
require 'vendor/autoload.php';
// Instantiation
$mail = new PHPMailer(true);
// Server settings
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure= 'tls';
$mail->Port = 587;
$mail->Username = 'Enter your dummy email address';
$mail->Password = 'Enter Password that generated by Gmail after two step verification. NOTE:-Gmail ids password will not work.';

// Sender &amp; Recipient
$mail->From = 'Enter your dummy email address';
$mail->FromName = $email;
$mail->addAddress($email);

// Content
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->Subject = 'Forget Password';
$body = "Hi $email Your Password is {$row['password']}";
$mail->Body = $body;
if($mail->send()){
  echo "<script>alert('Your Password has been Sent On Your Register Email')</script>";
  exit;
}else{
  echo 'Error Message';
  exit;
}

    }
    else {
        echo "<script>alert('Email Not Found.')</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class="bg-secondary bg-opacity-10">

<?php include 'navbar2.php' ?>

    <!--Form Start-->
    <div class="container mt-4">
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email" class="form-label">Enter Your Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <button type="submit" name="submitbtn" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <!--Form End-->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>