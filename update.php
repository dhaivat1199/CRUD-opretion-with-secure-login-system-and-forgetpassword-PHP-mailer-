<?php  

include 'db_connection.php';

session_start();

if(!isset($_SESSION['studentid']))
{
    header("location:login.php");
}

//Update Code Start

$editid = $_GET['eid'];

if(!isset($_GET['eid']) || empty($_GET['eid']))

{
    header("location:insert.php");
}

$selectq = mysqli_query($connection, "select * from tbl_crud where id='{$editid}'") or die (mysqli_error($connection));
$selectrow = mysqli_fetch_array($selectq);

if($_POST)

{
    $id = $_POST['id'];
    $enote_title = $_POST['enote_title'];
    $enote_desc = $_POST['enote_desc'];

    $updatequery = mysqli_query($connection, "update tbl_crud set note_title='{$enote_title}', note_desc='{$enote_desc}' where id='{$id}' ")
    or die (mysqli_error($connection)); 
    if($updatequery){

        echo "<script>alert('Notes Update Sucessfully.')</script>";

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

    <title>Update Notes</title>
</head>

<body class="bg-secondary bg-opacity-10">

    <div class="container mt-4">
    <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $selectrow['id'] ?>">
        <div class="mb-3">
            <label for="enote_title" class="form-label">Edit Note Title</label>
            <input type="text" value="<?php echo $selectrow['note_title']?>" class="form-control" name="enote_title" id="enote_title">
        </div>

        <div class="mb-3">
            <label for="enote_desc" class="form-label">Edit Admin Email</label>
            <input type="text" value="<?php echo $selectrow['note_desc']?>" class="form-control" name="enote_desc" id="enote_desc">
        </div>
       
        <button type="submit" name="submitbtn" class="btn btn-primary">Update Notes</button>
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