<?php
/* script for fixing appointment by the user */
require "connect.php";
session_start();
$date = $_POST['date_'];
$userID = $_SESSION['id'];
$lawyerID = $_POST['lawyerID'];
$query = "INSERT into appointment values('$lawyerID','$userID','$date','Fixed')";
$result = mysqli_query($db,$query);
echo "Appointment fixed"
?>