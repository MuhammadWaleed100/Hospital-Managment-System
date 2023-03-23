<?php
session_start();
if (empty($_SESSION['doctor']) OR empty($_SESSION['type'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Symptoms - HMS</title>
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
	<div class="wrapper">
	<?php
		include "includes/header.php";
		include "includes/left.php";
	 ?>
		<div class="right"><br>
			<br>
			<br>
			<center>
				<form action="addsymptom.php?id=<?php echo $id = $_GET['id']; ?>" method="POST">
				<input type="text" name="name" class="form" value="

				<?php
				require '../includes/connect.php';
				$id = $_GET['id'];
				$sql = sqlsrv_query($conn,"SELECT * FROM medication WHERE id='$id'",$params,$options);
				while ($row=sqlsrv_fetch_array($sql)) {
					$idd = $row['P_ID'];

					$sql1 = sqlsrv_query($conn,"SELECT * FROM patient WHERE P_ID='$idd'",$params,$options);
					while ($roww = sqlsrv_fetch_array($sql1)) {
						echo $roww['fname']." ".$roww['sname'];
					}
				}
				 ?>" required="required"  disabled="disabled"><br><br>
				 <center><label for="symptoms"><b>Enter Sysmptoms</b></label></center><br>
				<textarea required="required" name="symptoms" id="symptoms" class="form" style="height:200px; padding-left:20px;padding-top:20px;font-family:Arial;" placeholder=""></textarea><br><br>

				<center><label for="medicine"><b>Enter Medicines</b></label></center><br>
				<textarea required="required" name="medicine" id="test" class="form" style="height:200px; padding-left:20px;padding-top:20px;font-family:Arial;" placeholder=""></textarea><br><br>

				<input type="submit" value="Send To Pharmist" class="btnlink" name="btn"><br><br>
			</form>
			<?php
			extract($_POST);
			if (isset($btn) && !empty($symptoms)) {
				require "../includes/doctor.php";
				addmedicine();
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
