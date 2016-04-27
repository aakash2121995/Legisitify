<?php
/*Log out script common for the user and lawyer */
session_start();
unset($_SESSION["id"]);
unset($_SESSION['loggedin']);
header("Location: index.html");
?>