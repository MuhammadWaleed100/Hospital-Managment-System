<?php
function users()
{
	require 'connect.php';
	$sql = "SELECT * FROM employee";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		echo "<tr height=30px'>";
        echo "<td>".$row['E_ID']."</td>";
		echo "<td>".$row['E_Fname']." ".$row['E_Sname']."</td>";
        echo "<td>".$row['E_CNIC']."</td>";
		echo "<td>".$row['type']."</td>";
        echo "<td>".$row['Esal']."</td>";
        echo "<td>".$row['D_O_J']->format('d/m/Y')."</td>";
		echo "<td><center><a href='edituser.php?name=".$row['E_ID']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deleteuser.php?name=".$row['E_ID']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";

		echo "</tr>";
	}
}


function rooms()
{
	require 'connect.php';
	$sql = "SELECT * FROM rooms";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		echo "<tr height=30px'>";
		echo "<td>".$row['room_number']."</td>";
		//echo "<td>".$row['room_']."</td>";
		echo "<td>".$row['P_ID']."</td>";
		//echo "<td><center><a href='editroom.php?id=".$row['room_number']."'><img //src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deleteroom.php?id=".$row['room_number']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";

		echo "</tr>";
	}
}


function adduser()
{
	require 'connect.php';
	$E_ID = trim(htmlspecialchars($_POST['E_ID']));
	$password = trim(htmlspecialchars($_POST['password']));
	$E_Fname = trim(htmlspecialchars($_POST['E_Fname']));
	$E_Sname = trim(htmlspecialchars($_POST['E_Sname']));
	$E_email = trim(htmlspecialchars($_POST['E_email']));
    $E_CNIC = trim(htmlspecialchars($_POST['E_CNIC']));
	$E_Address = trim(htmlspecialchars($_POST['E_Address']));
	$E_sex = trim(htmlspecialchars($_POST['E_sex']));
	$E_CNO = trim(htmlspecialchars($_POST['E_CNO']));
    $type = trim(htmlspecialchars($_POST['type']));
	$Esal = trim(htmlspecialchars($_POST['Esal']));
    $D_O_J = trim(htmlspecialchars($_POST['D_O_J']));
	//$pass = sha1($password);

	$sql1 = "SELECT * FROM employee WHERE E_ID='$E_ID'";
	$query = sqlsrv_query($conn,$sql1,$params,$options);
	if (sqlsrv_num_rows($query)==0) {
		$sql = "INSERT INTO employee VALUES ('$E_ID','$password','$E_Fname','$E_Sname','$E_email','$E_CNIC','$E_Address','$E_sex','$E_CNO','$type','$Esal','$D_O_J')";
		$query = sqlsrv_query($conn,$sql,$params,$options);
		if (!empty($query)) {
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Employee is Succesifully Added</b>";
		}
	}
	else{
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Choose Unique Employee_ID</b>";
	}


}


function addroom()
{
	$number = trim(htmlspecialchars($_POST['number']));
	$name = trim(htmlspecialchars($_POST['name']));

	$sql1 = "SELECT * FROM rooms WHERE room_name='$name'";
	$query1 = sqlsrv_query($sql1);
	if (sqlsrv_num_rows($query1)==0) {
		$sql = "INSERT INTO `rooms` VALUES ('$number','$name','0')";
		$query = sqlsrv_query($conn,$sql,$params,$options);
		if (!empty($query)) {
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Room is Succesifully Added</b>";
		}
		else{
			echo "<br>".mysql_error();
		}
	}
	else{
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Choose Unique Name</b>";
	}


}


function updateuser()
{
		require 'connect.php';
	//$username = trim(htmlspecialchars($_POST['username']));
	$E_Fname = trim(htmlspecialchars($_POST['E_Fname']));
	$E_Sname = trim(htmlspecialchars($_POST['E_Sname']));
	$type = trim(htmlspecialchars($_POST['type']));
	$password = trim(htmlspecialchars($_POST['password']));
	//$pass = sha1($password);


	$name = $_GET['name'];

		$sql = "UPDATE employee SET E_Fname='$E_Fname',E_Sname='$E_Sname',type='$type',password='$password' WHERE E_ID='$name'";
		$query = sqlsrv_query($conn,$sql,$params,$options);
		if (!empty($query)) {
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>User is Succesifully Updated</b>";

		}
}
/*

function updateroom()
{
	$name = trim(htmlspecialchars($_POST['name']));


	$id = $_GET['id'];

		$sql = "UPDATE rooms` SET `room_name`='$name' WHERE `room_no`='$id'";
		$query = sqlsrv_query($conn,$sql,$params,$options);
		if (!empty($query)) {
			echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Room is Succesifully Updated</b>";

		}
}
*/
/*
function settings()
{
	require 'connect.php';
	//$username = trim(htmlspecialchars($_POST['username']));
	$E_ID = trim(htmlspecialchars($_POST['E_ID']));
	$E_Fname = trim(htmlspecialchars($_POST['E_Fname']));
    $E_Sname = trim(htmlspecialchars($_POST['E_Sname']));
    $E_CNIC = trim(htmlspecialchars($_POST['E_CNIC']));
    $Esal = trim(htmlspecialchars($_POST['Esal']));
	$password2 = trim(htmlspecialchars($_POST['password2']));
	$password = trim(htmlspecialchars($_POST['password']));
	if ($password != $password2) {
		echo "<br><b style='color:red;font-size:14px;font-family:Arial;'>Password Must Match</b>";
	}
	else{
		//$pass = sha1($password);
		$name = $_SESSION['admin'];
		$type = $_SESSION['type'];
        //$name = $_GET['name'];
				$sql = "UPDATE employee SET E_ID='$E_ID',E_Fname='$E_Fname',E_Sname='$E_Sname,E_CNIC='$E_CNIC,Esal='$Esal,password='$password' WHERE E_ID='$name'";
			$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Updated</b>";

				}
		}
	}
*/
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
		//$pass = sha1($password);
		$name = $_SESSION['admin'];
		$type = $_SESSION['type'];

				$sql = "UPDATE employee SET E_Fname='$E_Fname',E_Sname='$E_Sname',password='$password' WHERE E_ID='$name' AND type='$type'";
			$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Succesifully Updated</b>";

				}
		}
	}

?>
