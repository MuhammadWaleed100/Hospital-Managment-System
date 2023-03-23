<?php 
session_start();
if (empty($_SESSION['reception']) OR empty($_SESSION['type'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Rooms - HMS</title>
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
	<div class="wrapper">
	<?php
		include "includes/header.php";
		include "includes/left.php";
	 ?>
        
		<div class="right"><br>
			<a href="viewrooms.php" style="margin-left:10px;"><button class="btnlink">View Rooms</button></a>
			<?php $id = $_GET['id']; ?>
            <center>
                <form action="addroom.php?id=<?php echo $id; ?>" method="POST">
				<select name="rooms" class="form" required="required">
					<option value="">Choose Room</option>
					<option>101</option>
					<option>102</option>
					<option>103</option>
					<option>104</option>
                    <option>105</option>
				</select><br><br>
				<input type="number" name="price" class="form" placeholder="Enter Room Price" required="required"><br><br>
				<input type="submit" value="Add" class="btnlink" name="btn">
			</form>
			<?php 
			extract($_POST);
			if (isset($btn) && !empty($rooms) && !empty($price)) {
				require "../includes/reception.php";
				addroom();
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