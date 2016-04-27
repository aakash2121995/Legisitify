<?php
/*script for user login */
  require_once 'connect.php';
    session_start();
    
  $_SESSION['loggedin'] = 0;
   $uName = $_POST['email'];
   $pass = $_POST['password'];
   $result = mysqli_query($db,"SELECT userId FROM user where email = '$uName' and password = '$pass'");
   if(mysqli_num_rows($result)>0)
   {
   	$_SESSION['loggedin'] = 1;
   	$_SESSION['id'] = mysqli_fetch_row($result)[0];
   	header("Location: userIndex.php");
   }
   else
   {header("Location: userLogin.php");
   }
?>

