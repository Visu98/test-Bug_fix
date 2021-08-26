<?php
$server_name = 'localhost';
$DB_name = 'test';
$user = 'root';
$pass = '';

//connection to database
$conn = mysqli_connect($server_name,$user,$pass,$DB_name);
$sql = "SELECT * FROM `admin` WHERE 1";
$result = mysqli_query($conn,$sql);
if ($conn){
    // echo "Successfully";

}else{
    die('Connection faild');
}

?>