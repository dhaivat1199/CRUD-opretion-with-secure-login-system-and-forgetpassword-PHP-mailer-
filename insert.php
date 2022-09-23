<?php

include 'db_connection.php';

session_start();

if(!isset($_SESSION['studentid']))
{
    header("location:login.php");
}

if (isset($_POST['submitbtn'])) {

    $user_id = $_SESSION['studentid'];
    $note_title = mysqli_real_escape_string($connection, $_POST['note_title']);
    $note_desc = mysqli_real_escape_string($connection, $_POST['note_desc']);

    $insertquery = mysqli_query($connection, "insert into tbl_crud(note_title,note_desc,user_id)  values('{$note_title}','{$note_desc}','{$user_id}')");

    if ($insertquery) {
        echo "<script>alert('Recored Inserted Succesfully.')</script>";
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

    <title>Insert</title>
</head>

<?php include 'navbar2.php'; ?>

<body class="bg-secondary bg-opacity-10">

    <div class="container mt-4">

        <h2>Welcome to iNotes.</h2>

        <form class="mt-4" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="note_title" class="form-label">Note Title</label>
                <input type="text" class="form-control" name="note_title" id="note_title">
            </div>

            <div class="mb-3">
                <label for="note_desc" class="form-label">Note Description</label>
                <textarea type="text" class="form-control" name="note_desc" id="note_desc"></textarea>
            </div>

            <button type="submit" name="submitbtn" class="btn btn-primary">Add Notes</button>
            <button type="button" onclick="window.location='view.php';" class="btn btn-primary">View</button>
        </form>
    </div>

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