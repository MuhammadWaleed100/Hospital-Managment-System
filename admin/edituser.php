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
	<title>Edit User - HMS</title>
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
			<?php

			$name = $_GET['name'];

			?>
			<center>
				<form action="edituser.php?name=<?php echo $name; ?>" method="POST">
				
				<?php
				require '../includes/connect.php';
				$sql = "SELECT * FROM employee WHERE E_ID='$name'";
				$query = sqlsrv_query($conn,$sql,$params, $options);
				//while ($row = sqlsrv_fetch_array($query)) 
                    
                    $row = sqlsrv_fetch_array($query);
                    {
					?>
                    
                    <input type="text" name="E_ID" class="form" value="<?php echo "$name"; ?>" required="required" disabled="disabled"><br><br>
				<select name="type" class="form" required="required">
					<option value="">Choose Type</option>
<option <?php if($row['type']=="Admin")         { ?> selected="selected" <?php } ?> > Admin</option>
<option <?php if($row['type']=="NormalDoctor")  { ?> selected="selected" <?php } ?> > NormalDoctor</option>
<option <?php if($row['type']=="DentalDoctor")  { ?> selected="selected" <?php } ?> > DentalDoctor</option>
<option <?php if($row['type']=="WomenDoctor")   { ?> selected="selected" <?php } ?> > WomenDoctor</option>
<option <?php if($row['type']=="Reception")      { ?> selected="selected" <?php } ?> > Reception</option>
<option <?php if($row['type']=="Pharmacy")       { ?> selected="selected" <?php } ?> > Pharmacy</option>
<option <?php if($row['type']=="Laboratory")    { ?> selected="selected" <?php } ?> > Laboratory</option>
<option <?php if($row['type']=="Bursar")        { ?> selected="selected" <?php } ?> > Bursar</option>
				</select><br><br>

					<input type="text" name="E_Fname" class="form" value="<?php echo $row['E_Fname']; ?>" required="required"><br><br>
					<input type="text" name="E_Sname" class="form" value="<?php echo $row['E_Sname']; ?>" required="required"><br><br>
					<?php
				}
				 ?>


				<input type="password" name="password" class="form" placeholder="Enter Password" required="required"><br><br>
				<input type="submit" value="Update" class="btnlink" name="btn">
			</form>
			<?php
			extract($_POST);
			if (isset($btn) && !empty($password) &&!empty($type)) {
				require "../includes/admin.php";
				updateuser();
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
