<?php 
session_start();
if (empty($_SESSION['admin']) OR empty($_SESSION['type'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Users Admin Dashboard - HMS</title>
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
	<div class="wrapper">
	<?php
		include "includes/header.php";
		include "includes/left.php";
	 ?>
		<div class="right"><br>
			<a href="adduser.php" style="margin-left:10px;"><button class="btnlink">Add Employees</button></a><br>
			<table class="table">
				<tr>
                    <th>Employee_ID</th>
					<th>Employee_Name</th>
                    <th>Employee_CNIC</th>
					<th>Employee_Type</th>
                    <th>Employee_Salary</th>
                    <th>Date of Joining</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				<?php 
				require '../includes/admin.php';
				users();
				 ?>
			</table>
		</div>
		<?php 
		include "includes/footer.php";
		 ?>
	</div>
</body>
</html>