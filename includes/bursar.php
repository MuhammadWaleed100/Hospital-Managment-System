<?php

function settings()
{
		require "../includes/connect.php";
	//$username = trim(htmlspecialchars($_POST['username']));
	$E_Fname = trim(htmlspecialchars($_POST['E_Fname']));
	$E_Sname = trim(htmlspecialchars($_POST['E_Sname']));
	$password2 = trim(htmlspecialchars($_POST['password2']));
	$password = trim(htmlspecialchars($_POST['password']));
	if ($password != $password) {
		echo "<br><b style='color:red;font-size:14px;font-family:Arial;'>Password Must Match</b>";
	}
	else{
	//	$pass = sha1($password);
		$name = $_SESSION['bursar'];
		$type = $_SESSION['type'];

				$sql = "UPDATE employee SET E_Fname='$E_Fname',E_Sname='$E_Sname',password='$password' WHERE E_ID='$name' AND type='$type'";
					$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Updated</b>";

				}
		}
	}


?>
