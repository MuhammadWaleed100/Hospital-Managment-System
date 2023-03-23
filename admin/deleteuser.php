<?php 
session_start();
if (empty($_SESSION['admin']) OR empty($_SESSION['type'])) {
	header("Location: ../index.php");
}
else{
	$name = $_GET['name'];

	require "../includes/connect.php";
	$sql = "DELETE FROM employee WHERE E_ID='$name'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	if (!empty($query)) {
		header("Location: users.php");
	}
}
?>