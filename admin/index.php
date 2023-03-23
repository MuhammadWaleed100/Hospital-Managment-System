<?php
session_start();
if (empty($_SESSION['admin']) OR empty($_SESSION['type'])) {
	header("Location: /index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
</style>
	<meta charset="UTF-8">
	<title>Admin Dashboard - HMS</title>
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
	<style type="text/css">
	.total{
        border-radius: 25px;
		height: 120px;
		width: 170px;
		border: 1px solid #408080;
		margin-top: 25px;
		margin-left: 40px;
		float: left;
		text-align: center;
		padding-top: 20px;
	}
	</style>
</head>
<body>
	<div class="wrapper">
	<?php
		include "includes/header.php";
		include "includes/left.php";
	 ?>
		<div class="right">
			<div class="total">
				<b>Total Receptionist</b><hr>
				<?php
				require_once "../includes/connect.php";

				$sql = "SELECT * FROM employee WHERE type='Reception'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				echo "<br><b style='color:#408080; font-family:Arial; font-size:35px;'>".$row = sqlsrv_num_rows($query)."</b>";
				 ?>
			</div>

			<div class="total">
				<b>Total Doctors</b><hr>
				<?php
				require_once "../includes/connect.php";
				$sql = "SELECT * FROM employee WHERE type='NormalDoctor' OR type='DentalDoctor' OR type='WomenDoctor'";

				$query = sqlsrv_query($conn,$sql,$params,$options);
				echo "<br><b style='color:#408080; font-family:Arial; font-size:35px;'>".$row = sqlsrv_num_rows($query)."</b>";
				 ?>
			</div>

			<div class="total">
				<b>Total Laboratorist</b><hr>
				<?php
				require_once "../includes/connect.php";

				$sql = "SELECT * FROM employee WHERE type='Laboratory'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				echo "<br><b style='color:#408080; font-family:Arial; font-size:35px;'>".$row = sqlsrv_num_rows($query)."</b>";
				 ?>
			</div>
			<div class="total">
				<b>Total Admins</b><hr>
				<?php
				require_once "../includes/connect.php";

				$sql = "SELECT * FROM employee WHERE type='Admin'";

				$query = sqlsrv_query($conn,$sql,$params,$options);
				echo "<br><b style='color:#408080; font-family:Arial; font-size:35px;'>".$row = sqlsrv_num_rows($query)."</b>";
				 ?>
			</div>

			<div class="total">
				<b>Total Pharmatist</b><hr>
				<?php
				require_once "../includes/connect.php";

				$sql = "SELECT * FROM employee WHERE type='Pharmacy'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				echo "<br><b style='color:#408080; font-family:Arial; font-size:35px;'>".$row = sqlsrv_num_rows($query)."</b>";
				 ?>
			</div>

			<div class="total">
				<b>Total Bursar</b><hr>
				<?php
				require_once "../includes/connect.php";

				$sql = "SELECT * FROM employee WHERE type='Bursar'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				echo "<br><b style='color:#408080; font-family:Arial; font-size:35px;'>".$row = sqlsrv_num_rows($query)."</b>";
				 ?>
			</div>
		</div>
		<?php
		include "includes/footer.php";
		 ?>
	</div>
</body>
</html>
