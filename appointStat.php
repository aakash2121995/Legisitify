<?php
/* script for updating status*/
require "connect.php"; 
session_start();
$userID = $_POST['userID']; //UserID
$lawyerID = $_SESSION['id']; // lawyerID
$status = $_POST['action']; //new status to be updated

$query_ = "Update appointment set status = '$status' where lawyerID = $lawyerID and userID = $userID"; //query
$result_ = mysqli_query($db,$query_);
                        
?>