<?php
function recdoctor()
{
	require 'connect.php';
			$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE doctor_type='$typee' AND status='recdoctor'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		$ido = $row['P_ID'];
		$sql2 = "SELECT * FROM patient WHERE P_ID='$ido'";
		$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
			echo "<td>".$row2['P_ID']."</td>";
			echo "<td>".$row2['fname']."</td>";
			echo "<td>".$row2['sname']."</td>";
			echo "<td>".$row2['sex']."</td>";
			echo "<td><center><a href='addsymptoms.php?id=".$row['id']."'>Add</a></center></td>";
            echo "<td><center><a href='addsymptom.php?id=".$row['id']."'>Add</a></center></td>";
			echo "</tr>";
		}

	}
}


function viewpatients()
{
	require 'connect.php';
			$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE doctor_type='$typee'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		$ido = $row['P_ID'];
		$sql2 = "SELECT * FROM patient WHERE P_ID='$ido'";
		$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
			echo "<td>".$row2['P_ID']."</td>";
			echo "<td>".$row2['fname']."</td>";
			echo "<td>".$row2['sname']."</td>";
			echo "<td>".$row2['sex']."</td>";
            echo "<td>".$row['medical']."</td>";
			//echo "<td><center><a href='addsymptoms.php?id=".$row['id']."'>Add</a></center></td>";
            //echo "<td><center><a href='addsymptom.php?id=".$row['id']."'>Add</a></center></td>";
			//echo "</tr>";
		}

	}
}



function labdoctor()
{
		require 'connect.php';
			$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE doctor_type='$typee' AND status='labdoctor'";
	$query = sqlsrv_query($conn,$sql,$params,$options);;
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
			echo "<td><center><a href='medicine.php?id=".$row['id']."'>view</a></center></td>";
			echo "</tr>";
		}

	}
}


function searchpatients()
{
			require 'connect.php';
			$fname = $_GET['s'];
			$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE doctor_type='$typee' AND status='recdoctor'";
			$query = sqlsrv_query($conn,$sql,$params,$options);;
			while ($row = sqlsrv_fetch_array($query)) {
				$ido = $row['P_ID'];
				$sql2 = "SELECT * FROM patient WHERE P_ID='$ido' AND id LIKE '%$fname%'";
			$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
			echo "<td>P-".$row2['id']."</td>";
			echo "<td>".$row2['fname']."</td>";
			echo "<td>".$row2['sname']."</td>";
			echo "<td>".$row2['sex']."</td>";
			echo "<td><center><a href='addsymptoms.php?id=".$row['id']."'>Add</a></center></td>";
			echo "</tr>";
		}

	}
}

function searchnewpatients()
{
			require 'connect.php';
			$fname = $_GET['s'];
			$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE doctor_type='$typee' AND status='labdoctor'";
			$query = sqlsrv_query($conn,$sql,$params,$options);;
			while ($row = sqlsrv_fetch_array($query)) {
				$ido = $row['P_ID'];
				$sql2 = "SELECT * FROM patient WHERE P_ID='$ido' AND id LIKE '%$fname%'";
			$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
			echo "<td>P-".$row2['id']."</td>";
			echo "<td>".$row2['fname']."</td>";
			echo "<td>".$row2['sname']."</td>";
			echo "<td>".$row2['sex']."</td>";
			echo "<td><center><a href='medicine.php?id=".$row['id']."'>View</a></center></td>";
			echo "</tr>";
		}

	}
}

function addsymptoms()
{
		require 'connect.php';
	$symptoms = trim(htmlspecialchars($_POST['symptoms']));
	$test = trim(htmlspecialchars($_POST['test']));
	if (!empty($symptoms)) {
		$id = $_GET['id'];
		$sql = "UPDATE medication SET status='laboratory',symptoms='$symptoms',tests='$test' WHERE id='$id'";
		$query = sqlsrv_query($conn,$sql,$params,$options);;
		if (!empty($query)) {
			$day = date('d');
			$month = date('m');
			$year = date('Y');
			$doctor = $_SESSION['doctor'];
			$report = sqlsrv_query($conn,"INSERT INTO doctorreport VALUES ('$doctor','$id','$day','$month','$year')",$params,$options);
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Sent</b>";
		}
	}
}

function addmedicine()
{
	$medicine = trim(htmlspecialchars($_POST['medicine']));
	if (!empty($medicine)) {
		$id = $_GET['id'];
		require "connect.php";

		$sql = "UPDATE medication SET status='pharmacy',medical='$medicine' WHERE id='$id'";
		$query = sqlsrv_query($conn,$sql,$params,$options);;
		if (!empty($query)) {
            $day = date('d');
			$month = date('m');
			$year = date('Y');
			$doctor = $_SESSION['doctor'];
			$report = sqlsrv_query($conn,"INSERT INTO doctorreport VALUES ('$doctor','$id','$day','$month','$year')",$params,$options);
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Sent</b>";
		}
		else{
			echo sqlsrv_errors();
		}
	}
	else{
		echo sqlsrv_errors();
	}
}

function settings()
{
		require "connect.php";
	//$username = trim(htmlspecialchars($_POST['username']));
	$E_Fname = trim(htmlspecialchars($_POST['E_Fname']));
	$E_Sname = trim(htmlspecialchars($_POST['E_Sname']));
	$password2 = trim(htmlspecialchars($_POST['password2']));
	$password = trim(htmlspecialchars($_POST['password']));
	if ($password != $password2) {
		echo "<br><b style='color:red;font-size:14px;font-family:Arial;'>Password Must Match</b>";
	}
	else{
	//	$pass = sha1($password);
		$name = $_SESSION['doctor'];
		$type = $_SESSION['type'];

				$sql = "UPDATE employee SET E_Fname='$E_Fname',E_Sname='$E_Sname',password='$password' WHERE E_ID='$name' AND type='$type'";
				$query = sqlsrv_query($conn,$sql,$params,$options);;
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Updated</b>";

				}
		}
	}
