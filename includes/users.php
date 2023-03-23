<?php
function login()
{
require_once 'connect.php';
$serverName = "DESKTOP-M3PPSA2\WALEED";
$databaseName = "hospital1";

$connectionInfo = array("Database"=>$databaseName);
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

    $E_ID = $_POST['E_ID'];
	$password = $_POST['password'];
	$pass = sha1($password);
	//echo "$password";
	$sql = "SELECT * FROM employee WHERE E_ID='$E_ID' AND password='$password'";
	
	$query=sqlsrv_query( $conn,$sql,$params,$options);
	
	 $row = sqlsrv_num_rows( $query );
	
	 if ($row == 0) {
		echo "<b style='font-size:12px;'>Wrong E_ID/Password Combination</b>";
	}
	elseif ($row == 1) {
		$fetch = sqlsrv_fetch_array( $query) ;
		$type = $fetch['type'];
		$name = $fetch['E_ID'];
		if ($type == "Admin") {
			@session_start();
			$_SESSION['type'] = $type;
			$_SESSION['admin'] = $name;
			header("Location: admin/");
		}
		elseif ($type=="Doctor" OR $type=="NormalDoctor" OR $type=="DentalDoctor" OR $type=="WomenDoctor") {
			@session_start();
			$_SESSION['type'] = $type;
			$_SESSION['doctor'] = $name;
			header("Location: doctor/");
		}
		elseif ($type=="Reception") {
			@session_start();
			$_SESSION['type'] = $type;
			$_SESSION['reception'] = $name;
			header("Location: reception/");
		}
		elseif ($type=="Laboratory") {
			@session_start();
			$_SESSION['type'] = $type;
			$_SESSION['laboratory'] = $name;
			header("Location: laboratory/");
		}
		elseif ($type=="Pharmacy") {
			@session_start();
			$_SESSION['type'] = $type;
			$_SESSION['pharmacy'] = $name;
			header("Location: pharmacy/");
		}
		elseif ($type=="Bursar") {
			@session_start();
			$_SESSION['type'] = $type;
			$_SESSION['bursar'] = $name;
			header("Location: bursar/");
		}
		else{
			echo "<b>Error</b>";
		}
	}
	else{
		echo "<b>Error</b>";
	}

}



function admindetails()
{$serverName = "DESKTOP-M3PPSA2\WALEED";
$databaseName = "hospital1";

$connectionInfo = array("Database"=>$databaseName);
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	@session_start();
	$type = $_SESSION['type'];
	$E_ID = $_SESSION['admin'];
	$sql = "SELECT * FROM employee WHERE E_ID='$E_ID' AND type='$type'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row =sqlsrv_fetch_array($query)) {
		echo "Welcome, <i>".$row['E_Fname']." ".$row['E_Sname']."</i> (<a href='../logout.php'>Logout</a>)";
	}
}






	function logout()
{
	@session_start();
	session_destroy();
	header("Location: ./index.php");
}



function bursardetails()
{$serverName = "DESKTOP-M3PPSA2\WALEED";
$databaseName = "hospital1";

$connectionInfo = array("Database"=>$databaseName);
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	@session_start();
	$type = $_SESSION['type'];
	$E_ID = $_SESSION['bursar'];
	$sql = "SELECT * FROM employee WHERE E_ID='$E_ID' AND type='$type'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row =sqlsrv_fetch_array($query)) {
		echo "Welcome, <i>".$row['E_Fname']." ".$row['E_Sname']."</i> (<a href='../logout.php'>Logout</a>)";
	}
}


function doctordetails()
{$serverName = "DESKTOP-M3PPSA2\WALEED";
$databaseName = "hospital1";

$connectionInfo = array("Database"=>$databaseName);
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	@session_start();
	$type = $_SESSION['type'];
	$E_ID = $_SESSION['doctor'];
	$sql = "SELECT * FROM employee WHERE E_ID='$E_ID' AND type='$type'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row =sqlsrv_fetch_array($query)) {
		echo "Welcome, <i>".$row['E_Fname']." ".$row['E_Sname']."</i> (<a href='../logout.php'>Logout</a>)";
	}
}

function receptiondetails()
{$serverName = "DESKTOP-M3PPSA2\WALEED";
$databaseName = "hospital1";

$connectionInfo = array("Database"=>$databaseName);
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	@session_start();
	$type = $_SESSION['type'];
	$E_ID = $_SESSION['reception'];
	$sql = "SELECT * FROM employee WHERE E_ID='$E_ID' AND type='$type'";
	$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row =sqlsrv_fetch_array($query)) {
		echo "Welcome, <i>".$row['E_Fname']." ".$row['E_Sname']."</i> (<a href='../logout.php'>Logout</a>)";
	}
}

function laboratorydetails()
{
	@session_start();
	require 'connect.php';
	$type = $_SESSION['type'];
	$E_ID = $_SESSION['laboratory'];
	$sql = "SELECT * FROM employee WHERE E_ID='$E_ID' AND type='$type'";
$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row =sqlsrv_fetch_array($query)) {
		echo "Welcome, <i>".$row['E_Fname']." ".$row['E_Sname']."</i> (<a href='../logout.php'>Logout</a>)";
	}
}

function pharmacydetails()
{
	@session_start();
	require 'connect.php';
	$type = $_SESSION['type'];
	$E_ID = $_SESSION['pharmacy'];
	$sql = "SELECT * FROM employee WHERE E_ID='$E_ID' AND type='$type'";
$query = sqlsrv_query($conn,$sql,$params,$options);
	while ($row =sqlsrv_fetch_array($query)) {
		echo "Welcome, <i>".$row['E_Fname']." ".$row['E_Sname']."</i> (<a href='../logout.php'>Logout</a>)";
	}
}


?>
