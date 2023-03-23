<?php
function patients()
{
	require 'connect.php';
	$sql = "SELECT * FROM patient";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		echo "<tr height=30px'>";
		echo "<td>P-".$row['P_ID']."</td>";
		echo "<td>".$row['fname']."</td>";
		echo "<td>".$row['sname']."</td>";
		echo "<td>".$row['phone']."</td>";
		echo "<td>".$row['sex']."</td>";
		echo "<td><a href='viewpatient.php?id=".$row['P_ID']."'>View  |  </a>";
		echo "<a href='editpatient.php?id=".$row['P_ID']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a>";
        echo "   |   ";
		echo "<a   href='deletepatient.php?id=".$row['P_ID']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'>";
		//echo "</tr>";
          echo "   |   ";
                echo "<a href='addroom.php?id=".$row['P_ID']."'><img src='../assets/img/room.png' height='20px' width='40px'></a>";
		echo "</tr>";
         
	}
}

function viewpatient()
{
	$id = $_GET['id'];
	require 'connect.php';
	$sql = "SELECT * FROM patient WHERE P_ID='$id'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		$year = date('Y') - $row['birthyear'];
		echo "
		<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>ID</b></td>
				<td>P-".$row['P_ID']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>FIRSTNAME</b></td>
				<td>".$row['fname']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>SURNAME</b></td>
				<td>".$row['sname']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>EMAIL</b></td>
				<td>".$row['email']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>ADDRESS</b></td>
				<td>".$row['address']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>PHONE</b></td>
				<td>".$row['phone']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>GENDER</b></td>
				<td>".$row['sex']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>BLOOD GRUOP</b></td>
				<td>".$row['bloodgroup']."</td>
			</tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>YEARS</b></td>
				<td>".$year."</td>
			</tr>
            </tr>
			<tr style='height:40px;'>
				<td style='width:40%;padding-left:20px;'><b>D_O_A</b></td>
				<td>".$row['D_O_A']->format('d/m/Y')."</td>
			</tr>
		";

	}
}


function searchpatients()
{
	require 'connect.php';
	$sachi = $_GET['s'];
	$sql = "SELECT * FROM patient WHERE P_ID LIKE '%$sachi%'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		echo "<tr height=30px'>";
		echo "<td>P-".$row['P_ID']."</td>";
		echo "<td>".$row['fname']."</td>";
		echo "<td>".$row['sname']."</td>";
		echo "<td>".$row['phone']."</td>";
		echo "<td>".$row['sex']."</td>";
		echo "<td><center><a href='viewpatient.php?id=".$row['P_ID']."'>View</a></center></td>";
		echo "<td><center><a href='editpatient.php?id=".$row['P_ID']."'><img src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		echo "<td><center><a href='deletepatient.php?id=".$row['P_ID']."'><img src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";
		echo "</tr>";
	}
}


function addpatient()
{
	require 'connect.php';

	$fname = trim(htmlspecialchars($_POST['fname']));
	$sname = trim(htmlspecialchars($_POST['sname']));
	$email = trim(htmlspecialchars($_POST['email']));
	$phone = trim(htmlspecialchars($_POST['phone']));
	$address = trim(htmlspecialchars($_POST['address']));
	$gender = trim(htmlspecialchars($_POST['gender']));
	$birthyear = trim(htmlspecialchars($_POST['birthyear']));
	$bloodgroup = trim(htmlspecialchars($_POST['bloodgroup']));
    $D_O_A = trim(htmlspecialchars($_POST['date']));

	$sql = "INSERT INTO patient VALUES ('$fname','$sname','$email','$address','$phone','$gender','$bloodgroup','$birthyear','$D_O_A')";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	if (!empty($query)) {
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient is Succesifully Added</b><br><br>";
	}
	else{
		echo sqlsrv_errors();
	}
}


function addroom()
{
	require 'connect.php';

    $price = trim(htmlspecialchars($_POST['price']));
    $rooms = trim(htmlspecialchars($_POST['rooms']));
			if (!empty($price)) {
				$id = $_GET['id'];
				//@require "connect.php";

				//$sql = "UPDATE medication SET status='finish',room_price='$price' WHERE id='$id'";
				//$query = sqlsrv_query($conn,$sql,$params,$options);
                //$sql1 = "UPDATE patient SET room_number='$rooms' WHERE P_ID='$id'";
				//$query1 = sqlsrv_query($conn,$sql1,$params,$options);
                 $sql2 = "insert into rooms values('$rooms','$price','busy','$id')";
				$query2 = sqlsrv_query($conn,$sql2,$params,$options);
				if (!empty($query2)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Finished!</b><br><br>";
				}
                else{
		echo sqlsrv_errors();
	}
			}
}
    



function viewrooms()
{
	require 'connect.php';
	$sql = "SELECT * FROM rooms";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row = sqlsrv_fetch_array($query)) {
		echo "<tr height=30px'>";
		echo "<td>".$row['room_number']."</td>";
		//echo "<td>".$row['room_']."</td>";
		echo "<td>".$row['status']."</td>";
		//echo "<td><center><a href='editroom.php?id=".$row['room_number']."'><img //src='../assets/img/glyphicons-151-edit.png' height='16px' width='17px'></a></center></td>";
		//echo "<td><center><a href='deleteroom.php?id=".$row['room_number']."'><img //src='../assets/img/glyphicons-17-bin.png' height='16px' width='12px'></a></center></td>";

		echo "</tr>";
	}
}




function assigntodoctor()
{
	$doctor = trim(htmlspecialchars($_POST['doctor']));

	require "connect.php";
	$id = $_GET['id'];
	$day = date('d');
		$month = date('m');
		$year = date('Y');


	if ($doctor=="WomenDoctor") {
		$price = 40000;

				$sql = "INSERT INTO medication VALUES ('$id','recdoctor','','','','','$doctor','$price','','','$day','$month','$year')";

			$query = sqlsrv_query($conn,$sql,$params,$options);
			if (!empty($query)) {
				echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient is Succesifully Assigned To Doctor</b><br><br>";
			}
			else{
				echo sqlsrv_errors();
			}
	}
	elseif ($doctor=="NormalDoctor") {
		$price = 20000;
		$sql = "INSERT INTO medication VALUES ('$id','recdoctor','','','','','$doctor','$price','','','$day','$month','$year')";

			$query = sqlsrv_query($conn,$sql,$params,$options);
			if (!empty($query)) {
				echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient is Succesifully Assigned To Doctor</b><br><br>";
			}
			else{
				echo sqlsrv_errors();
			}
	}
	elseif ($doctor=="DentalDoctor") {
		$price = 30000;

		$sql = "INSERT INTO medication VALUES ('$id','recdoctor','','','','','$doctor','$price','','','$day','$month','$year')";

			$query = sqlsrv_query($conn,$sql,$params,$options);
			if (!empty($query)) {
				echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient is Succesifully Assigned To Doctor</b><br><br>";
			}
			else{
				echo sqlsrv_errors();
			}
	}


}

function updatepatient()
{
	$id = $_GET['id'];
	$fname = trim(htmlspecialchars($_POST['fname']));
	$sname = trim(htmlspecialchars($_POST['sname']));
	$email = trim(htmlspecialchars($_POST['email']));
	$phone = trim(htmlspecialchars($_POST['phone']));
	$address = trim(htmlspecialchars($_POST['address']));
	$gender = trim(htmlspecialchars($_POST['gender']));
	$birthyear = trim(htmlspecialchars($_POST['birthyear']));
	$bloodgroup = trim(htmlspecialchars($_POST['bloodgroup']));

	require "connect.php";

	$sql = "UPDATE patient SET fname='$fname',sname='$sname',email='$email',address='$address',phone='$phone',sex='$gender',bloodgroup='$bloodgroup',birthyear='$birthyear' WHERE P_ID='$id'";
	//$sql = "INSERT INTO `` VALUES ('','$fname','$sname','$email','$address','$phone','$gender','$bloodgroup','$birthyear')";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	if (!empty($query)) {
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient is Succesifully Updated</b><br><br>";
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
		//$pass = sha1($password);
		$name = $_SESSION['reception'];
		$type = $_SESSION['type'];
				$sql = "UPDATE employee SET E_Fname='$E_Fname',E_Sname='$E_Sname',password='$password' WHERE E_ID='$name' AND type='$type'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				if (!empty($query)) {
					echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Successfully Updated</b>";

				}
		}
	}

?>
