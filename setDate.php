<?php
/* script for updating date of non availabitlty */
require "connect.php";
session_start();
$date = $_POST['date_']; // date details
$lawyerID = $_SESSION['id']; // lawyer details
$query_ = "Update lawyer set NonAvailablity = '$date' where lawyerId = $lawyerID";
$result_ = mysqli_query($db,$query_);
?>