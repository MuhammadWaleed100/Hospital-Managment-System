<?php 
session_start();
if (empty($_SESSION['admin']) OR empty($_SESSION['type'])) {
	header("Location: ../index.php");
}
else{
	$id = $_GET['id'];

	require "../includes/connect.php";
	$sql = "DELETE FROM rooms WHERE room_number='$id'";
	$query = sqlsrv_query($conn,$sql);
	if (!empty($query)) {
		header("Location: rooms.php");
	}
}
?>