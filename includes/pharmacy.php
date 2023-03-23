<?php

function patients()
{
	require 'connect.php';
			//$typee = $_SESSION['type'];
			$sql = "SELECT * From medication WHERE  status='pharmacy'";
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
			echo "<td><center><a href='medicine.php?id=".$row['P_ID']."'>view</a></center></td>";
			echo "</tr>";
		}

	}
}

function addmedicine()
{
			$price = trim(htmlspecialchars($_POST['price']));
			if (!empty($price)) {
				$id = $_GET['id'];
				@require "connect.php";

				$sql = "UPDATE medication SET status='finish',medical_price='$price'  WHERE id='$id'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Finished!</b><br><br>";
				}
			}
}

function addmedicines()
{
			$name = trim(htmlspecialchars($_POST['name']));
			$price = trim(htmlspecialchars($_POST['price']));
			if (!empty($name)&&!empty($price)) {
				@require "connect.php";

				//$sql = "UPDATE `medication` SET `status`='finish',`medical_price`='$price'  WHERE `id`='$id'";
				$sql = "INSERT INTO medicine VALUES ('$name','$price')";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Medicine Added</b><br><br>";
				}
			}
}

function updatemedicines()
{
    require 'connect.php';
			$name = trim(htmlspecialchars($_POST['name']));
			$price = trim(htmlspecialchars($_POST['price']));
			if (!empty($name)&&!empty($price)) {
				@require_once "connect.php";

				$id = $_GET['id'];

				$sql = "UPDATE medicine SET medicine_name='$name',price='$price'  WHERE id='$id'";
				//$sql = "INSERT INTO `medicine` VALUES ('','$name','$price')";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Medicine Updated</b><br><br>";
				}
			}
}

function searchmedicine()
{
			require 'connect.php';
			$name = $_GET['s'];
				$sql2 = "SELECT * FROM medicine WHERE medicine_name LIKE '%$name%'";
				$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
		echo "<td>".$row2['medicine_name']."</td>";
		echo "<td>".$row2['price']."</td>";
		echo "<td><center><a href='editmedicine.php?id=".$row2['id']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deletemedicine.php?id=".$row2['id']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";

		echo "</tr>";
		}
}

function searchpatients()
{
	$name = $_GET['s'];
	$sql = "SELECT * From medication WHERE  status='pharmacy'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		$ido = $row['patient_id'];
		$sql2 = "SELECT * FROM patient WHERE id='$ido' AND id LIKE '%$name%'";
		$query2 = sqlsrv_query($conn,$sql2,$params,$options);
		while ($row2 = sqlsrv_fetch_array($query2)) {
			echo "<tr height=30px'>";
			echo "<td>P-".$row2['id']."</td>";
			echo "<td>".$row2['fname']."</td>";
			echo "<td>".$row2['sname']."</td>";
			echo "<td>".$row2['sex']."</td>";
			echo "<td><center><a href='medicine.php?id=".$row['id']."'>view</a></center></td>";
			echo "</tr>";
		}

	}
}

function medicine()
{
	@require 'connect.php';
	$sql = "SELECT * FROM medicine";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		echo "<tr height=30px'>";
		echo "<td>".$row['medicine_name']."</td>";
		echo "<td>".$row['price']."</td>";
		echo "<td><center><a href='editmedicine.php?id=".$row['id']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deletemedicine.php?id=".$row['id']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";

		echo "</tr>";
	}
}

function settings()
{
    @require 'connect.php';
	//$username = trim(htmlspecialchars($_POST['username']));
	$E_Fname = trim(htmlspecialchars($_POST['E_Fname']));
	$E_Sname = trim(htmlspecialchars($_POST['E_Sname']));
	$password2 = trim(htmlspecialchars($_POST['password2']));
	$password = trim(htmlspecialchars($_POST['password']));
	if ($password != $password) {
		echo "<br><b style='color:red;font-size:14px;font-family:Arial;'>Password Must Match</b>";
	}
	else{
		//$pass = sha1($password);
		$name = $_SESSION['pharmacy'];
		$type = $_SESSION['type'];

				$sql = "UPDATE employee SET E_Fname='$E_Fname',E_Sname='$E_Sname',password='$password' WHERE E_ID='$name' AND type='$type'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Updated</b>";

				}
		}
	}
?>
