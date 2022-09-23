<?php

require 'db_connection.php';

session_start();

//Login Condition
if(!isset($_SESSION['studentid']))
{
    header("location:login.php");
}

//Code For Change Password Start
if($_POST)
{
$opass = $_POST['opass'];
$npass = $_POST['npass'];
$cpass = $_POST['cpass'];

//Fetch Old Password From Database
$oldpasswordquery = mysqli_query($connection, "select password from tbl_user where id ='{$_SESSION['studentid']}' ")
or die(mysqli_error($connection));

$oldpasswordfromdb = mysqli_fetch_array($oldpasswordquery);

//Old Password Condition
if($oldpasswordfromdb['password'] == $opass){

    //New And Confirm Password Must Be Same
    if($npass == $cpass){

        //New And Old Password Must Be Diffrent
        if($opass == $npass)
        {
            echo "<script>alert('New And Old Password Must Be Diffrent')</script>";
        }
        else
        {
           $updateq = mysqli_query($connection, "update tbl_user set password='{$npass}' where id ='{$_SESSION['studentid']}' ");
           if($updateq){
            echo "<script>alert('Password Changed.')</script>";
           }
        }

    }

else{
    echo "<script>alert('New And Confirm Password Must Be Same')</script>";
}

}
else{

    echo "<script>alert('Old Password Not Match')</script>";

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
            <label for="opass" class="form-label">Old Password</label>
            <input type="password" class="form-control" name="opass" id="opass">
        </div>

        <div class="mb-3">
            <label for="npass" class="form-label">New Password</label>
            <input type="password" class="form-control" name="npass" id="npass">
        </div>

        <div class="mb-3">
            <label for="cpass" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="cpass" id="cpass">
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