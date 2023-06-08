<?php 
session_start();
unset($_SESSION );
session_destroy();
session_unset();     // unset $_SESSION variable for the run-time 
header('Location:index.php');
exit();
?>