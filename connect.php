<?php

$user = 'root';
$pass = '';
$db='test_db';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to the server");

echo"Great work";
?>