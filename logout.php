<?php



session_start();


$_SESSION['session_id'] =0;

session_destroy();


header("Location: login.php");
exit;
?>