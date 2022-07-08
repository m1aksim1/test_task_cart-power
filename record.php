<?php
include 'config.php';

$link = mysqli_connect($server, $user, $password, $database);
$email = $_POST['email'];
$username = $_POST['username'];
$task = $_POST['task'];

$sql = "INSERT INTO `$table_name` (`email`, `user_name`, `text_task`) VALUES ('$email', '$username','$task');";
$result = mysqli_query($link,$sql);
mysqli_close($link);
?>