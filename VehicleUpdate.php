<?php 
	include('carconnect.php');

 if(isset($_POST['btnSave']))
{
	$VehicleID=$_GET['ovid'];
	$VehicleName=$_POST['txtName'];
	$Quantity=$_POST['txtQuantity'];
	$VehiclePrice=$_POST['txtPrice'];
	$Model=$_POST['txtModel'];
	$Company=$_POST['txtCompany'];
	$Plate=$_POST['txtPlate'];
	if($VehicleImage)
	{
		$folder="images/";
		$path=$folder.$VehicleImage;
		$copied=copy($_FILES['txtImage']['tmp_name'],$path);
		if(!copied)
		{
			echo"Copy Image Error!";
		}
	}

	$Image=$_FILES['txtImage']['name'];
	$insert=mysqli_query($connection,"INSERT INTO Vehicle(VehicleName,VehicleImage,Quantity,VehiclePrice,Model,Company,Plate) values ('$VehicleName','$VehicleImage',$Quantity','$VehiclePrice','$Model','$Company','$Plate'");
	if($insert)
	{
		echo "<script>alert('Vehicle Has Been Updated!')</script>";
		echo "<script>location='VehicleDash.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
	}
}





 ?>

<html>
<head>
	<title>Update Vehicle</title>
</head>
<body>
<form action="VehicleDash.php" method="post">
			<fieldset>
	<table width="70%" align="center">

	 <label>Vehicle Name</label>
 <input type="text" name="txtName" required>
 <br>

 <label>Vehicle Image</label>
 <input type="file" name="txtImage" required>
 <br>

 <label>Vehicle Quantity</label>
 <input type="text" name="txtQuantity" required>
 <br>

 <label>Vehicle Price</label>
 <input type="text" name="txtPrice" required>
<br>

<label>Model</label>
<input type="text" name="txtModel" required>
<br>

<label>Company</label>
<input type="text" name="txtCompany" required>
<br>

<label>Plate</label>
<input type="text" name="txtPlate" required>

<input type="submit" name="btnSave" value="Save">
<input type="reset" name="btnCancel" value="Cancel">                                                                                                                                                                         
</table>
<legend align="center">Update Vehicle</legend>
		</fieldset>
</form>
</body>
</html>