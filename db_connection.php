<?php   
$host = "localhost";
$username = "root";
$password = "";
$database = "real_madrid";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {

    echo ("Error: Unable to connect to connect".mysqli_connect_error());

}

else {

    echo "Successfully connected to database";

}

?>