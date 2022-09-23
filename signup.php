<?php   

require 'db_connection.php';

//Code Forn Sign Up Page Start
if(isset($_POST['submitbtn'])){

    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    $cpassword = mysqli_real_escape_string($connection,$_POST['cpassword']);
    $user_imagepath = $_FILES['user_imagepath']['name'];

    $selectquery = mysqli_query($connection,"select * from tbl_user where email='{$email}' ");
    
    $count = mysqli_num_rows($selectquery);
    $row = mysqli_fetch_array($selectquery);

    if($email == '' && $password == '' && $cpassword == '')
    {
        echo "<script>alert('Plz Enter Valid Values.')</script>";
    }

    else
    {

    if($count > 0){

        echo "<script>alert('Email Already Exists')</script>";

    }else{

    if($password==$cpassword) {

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $inserquery = mysqli_query($connection, "insert into tbl_user (email,password,user_imagepath) values('{$email}','{$hash}','{$user_imagepath}')");

    $fileupload = move_uploaded_file($_FILES['user_imagepath']['tmp_name'],"uploads/". $user_imagepath);

    if($fileupload){

    echo "<script>alert('You Are Signin now you can login.')</script>";

    }
    
    }else

    {
        echo "<script>alert('Password And Confirm Password Must Be Same')</script>";
    }

}
}
}
//Code Forn Sign Up Page End
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

<?php include 'navbar.php' ?>

    <!--Form Start-->
    <div class="container mt-4">
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="user_imagepath" class="form-label">User Image</label>
            <input type="file" class="form-control" name="user_imagepath" id="user_imagepath" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword">
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