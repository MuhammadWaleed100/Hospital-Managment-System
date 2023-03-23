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
	<title>Add User - HMS</title>
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
	<div class="wrapper">
	<?php
		include "includes/header.php";
		include "includes/left.php";
	 ?>
		<div class="right"><br>
			<a href="users.php" style="margin-left:10px;"><button class="btnlink">View Employees</button></a><br>
			<center>
				<form action="adduser.php" method="POST">
				<input type="text" name="E_ID" class="form" placeholder="Enter ID" required="required"><br><br>
                    <input type="password" name="password" class="form" placeholder="Enter Password" required="required"><br><br>
                    <input type="text" name="E_Fname" class="form" placeholder="Enter FirstName" required="required"><br><br>
                    <input type="text" name="E_Sname" class="form" placeholder="Enter SecondName" required="required"><br><br>
                    <input type="email" name="E_email" class="form" placeholder="Enter Email" required="required"><br><br>
                    <input type="text" name="E_CNIC" class="form" placeholder="Enter CNIC" required="required"><br><br>
                    <input type="text" name="E_Address" class="form" placeholder="Enter Address" required="required"><br><br>
                    <input type="text" name="E_sex" class="form" placeholder="Enter Gender" required="required"><br><br>
                    <input type="text" name="E_CNO" class="form" placeholder="Enter Contract_No" required="required"><br><br>
                    
				<select name="type" class="form" required="required">
					<option value="">Choose Type</option>
					<option>Admin</option>
					<option>Bursar</option>
					<option>NormalDoctor</option>
					<option>DentalDoctor</option>
					<option>WomenDoctor</option>
					<option>Reception</option>
					<option>Pharmacy</option>
					<option>Laboratory</option>
				</select><br><br>
				<input type="number" name="Esal" class="form" placeholder="Enter Salary" required="required"><br><br>
                   <input type="date" name="D_O_J" class="form" placeholder="Enter Joining date" required="required"><br><br>
				<input type="submit" value="Add" class="btnlink" name="btn">
			</form>
			<?php 
			extract($_POST);
			if (isset($btn) && !empty($E_ID) && !empty($password) &&!empty($type)) {
				require "../includes/admin.php";
				adduser();
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