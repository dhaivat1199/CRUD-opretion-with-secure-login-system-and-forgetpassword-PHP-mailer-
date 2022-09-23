<?php include 'db_connection.php';

session_start();

if(!isset($_SESSION['studentid']))
{
    header("location:login.php");
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
        } );
    </script>
    <title>admin_display</title>
</head>

<body class="bg-secondary bg-opacity-10">

<?php include 'navbar2.php'; ?>

    <div class="container my-4">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">Note Number</th>
                <th scope="col">Note Title</th>
                <th scope="col">Note Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody>
            <!-- Sure To Want Delete Code Start -->
            <script>
                    function isconfirm(){
                        var a = confirm('Are you sure you want to delete');
                        if(a){
                            return true;
                        }else{
                            return false;
                        }
                    }
                </script>
                <!--Sure To Want Delete Code End -->
            <?php

             //Delete Code Start.
             if (isset($_GET['did'])) {
                $did = $_GET['did'];
                $deleteq =  mysqli_query($connection, "delete from tbl_crud where id = '{$did}' ") or die(mysqli_error($connection));
                if ($deleteq) {
                    echo "<script>alert('Record Deleted')</script>";
                }
            }
            //Delete Code End.
            
            //Data Fetch From Database.
            $selectq = mysqli_query($connection, "select * from tbl_crud where user_id='{$_SESSION['studentid']}' ");
            while($productrow = mysqli_fetch_array($selectq))
        {
           echo "<tr>";
           echo "<td>{$productrow['id']}</td>";
           echo "<td>{$productrow['note_title']}</td>";
           echo "<td>{$productrow['note_desc']}</td>";
           echo "<td> <a href='update.php?eid={$productrow['id']}'>Edit</a> | <a class='delete' href='view.php?did={$productrow['id']}' onclick='return isconfirm();'> Delete </a></td>";
           echo "</tr>";
        }
         ?>
        </tbody>

    </table>
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


