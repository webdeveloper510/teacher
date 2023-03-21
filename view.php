<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "teacher"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

$qry = "select * from edit_table limit 1";
$result  = $conn->query($qry);

$getRow = $result->fetch_assoc();
// echo "<pre>";
// print_r($getRow);die;

?>

