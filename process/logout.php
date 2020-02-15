<?php 
session_start();
if (isset($_SESSION['user'])) {
	require_once "config/functions.php";
	$con = connekt();
	$online_update = "UPDATE `users-online` SET `status` = 'offline' WHERE username ='{$_SESSION['user']}'";
	$online_update_query = mysqli_query($con, $online_update);
	session_destroy();
	$_SESSION = array();
	header('Location:../index.php');
}
 ?>