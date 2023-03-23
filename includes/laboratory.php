<?php

function patients()
{
		require 'connect.php';
			//$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE  status='laboratory'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		$ido = $row['P_ID'];
		$sql2 = "SELECT * FROM patient WHERE P_ID='$ido'";
		$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
			echo "<td>P-".$row2['P_ID']."</td>";
			echo "<td>".$row2['fname']."</td>";
			echo "<td>".$row2['sname']."</td>";
			echo "<td>".$row2['sex']."</td>";
			echo "<td><center><a href='test.php?id=".$row['P_ID']."'>view</a></center></td>";
			echo "</tr>";
		}

	}
}

function resultpatients()
{
		require 'connect.php';
			//$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE  status='labdoctor' OR status='pharmacy' OR status='finish'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		$ido = $row['P_ID'];
		//$result = $row['patient_id'];
		$sql2 = "SELECT * FROM patient WHERE P_ID='$ido'";
		$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
			echo "<td>P-".$row2['P_ID']."</td>";
			echo "<td>".$row2['fname']." ".$row2['sname']."</td>";
			echo "<td>".$row2['sex']."</td>";
			echo "<td>".$row['date']." - ".$row['month']." - ".$row['year']."</td>";
			echo "<td>".$row['test_results']."</td>";
			echo "</tr>";
		}

	}
}

function addresult()
{
		require 'connect.php';
			$results = trim(htmlspecialchars($_POST['results']));
			$price = trim(htmlspecialchars($_POST['price']));
			if (!empty($results)) {
				$id = $_GET['id'];
			//	@require_once "connect.php";

				$sql = "UPDATE medication SET status='labdoctor',test_results='$results',test_price='$price' WHERE id='$id'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Sent</b><br><br>";
				}
			}
}

function searchpatients()
{
			require 'connect.php';
			$fname = $_GET['s'];
			$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE status='laboratory'";
			$query = sqlsrv_query($conn,$sql,$params,$options);
			while ($row = sqlsrv_fetch_array($query)) {
				$ido = $row['patient_id'];
				$sql2 = "SELECT * FROM patient WHERE id='$ido' AND id LIKE '%$fname%'";
				$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
			echo "<td>P-".$row2['id']."</td>";
			echo "<td>".$row2['fname']."</td>";
			echo "<td>".$row2['sname']."</td>";
			echo "<td>".$row2['sex']."</td>";
			echo "<td><center><a href='test.php?id=".$row['id']."'>view</a></center></td>";
			echo "</tr>";
		}

	}
}


function settings()
{
		require 'connect.php';
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
		$name = $_SESSION['laboratory'];
		$type = $_SESSION['type'];

				$sql = "UPDATE employee SET E_Fname='$E_Fname',E_Sname='$E_Sname',password='$password' WHERE E_ID='$name' AND type='$type'";
			$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Updated</b>";

				}
		}
	}

?>
