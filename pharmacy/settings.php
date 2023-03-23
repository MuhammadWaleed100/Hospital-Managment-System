<?php
session_start();
if (empty($_SESSION['pharmacy']) OR empty($_SESSION['type'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Settings Pharmacy Dashboard - HMS</title>
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
	<div class="wrapper">
	<?php
		include "includes/header.php";
		include "includes/left.php";
	 ?>
		<div class="right"><br><br>
			<?php

			$name = $_SESSION['pharmacy'];
			$type = $_SESSION['type'];

			?>
			<center>
				<form action="settings.php" method="POST">
				<input type="text" name="username" class="form" value="<?php echo $name; ?>" required="required" disabled="disabled"><br><br>


				<?php
				require_once '../includes/connect.php';
				$sql = "SELECT * FROM employee WHERE E_ID='$name' AND type='$type'";
				$query = sqlsrv_query($conn,$sql,$params,$options);
				while ($row = sqlsrv_fetch_array($query)) {
					?>
					<input type="text" name="E_Fname" class="form" value="<?php echo $row['E_Fname']; ?>" required="required"><br><br>
					<input type="text" name="E_Sname" class="form" value="<?php echo $row['E_Sname']; ?>" required="required"><br><br>
					<input type="password" name="password" class="form" placeholder="Enter Password" required="required"><br><br>
					<input type="password" name="password2" class="form" placeholder="Re-enter Password" required="required"><br><br>
					<?php
				}
				 ?>
				<input type="submit" value="Update" class="btnlink" name="btn">
			</form>
			<?php
			extract($_POST);
			if (isset($btn) && !empty($E_Fname)&& !empty($E_Sname)&& !empty($password)&& !empty($password2)) {
				if ($password != $password2) {
					echo "<br><b style='color:red;font-size:14px;font-family:Arial;'>Password Must Match</b>";
				}
				else{
					require "../includes/pharmacy.php";
					settings();
				}

			}
			 ?>
			</center>
			</div>
		<?php
		include "includes/footer.php";
		 ?>
	</div>

</body>
</html>
