<?php 
session_start();
if (empty($_SESSION['reception']) OR empty($_SESSION['type'])) {
	header("Location: ../index.php");
}
else{
	$id = $_GET['id'];

	require_once "../includes/connect.php";
	$sql = "DELETE FROM patient WHERE P_ID='$id'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	if (!empty($query)) {
		header("Location: patients.php");
	}
}
?>