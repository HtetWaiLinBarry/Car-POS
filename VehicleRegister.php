<?php 
include ('carconnect.php');

if(isset($_POST['btnSave']))
{
	$VehicleName=$_POST['txtName'];
	$VehicleImage=$_POST['txtImage'];
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

	$insert=mysqli_query($connection,"INSERT INTO Vehicle(VehicleName,VehicleImage,Quantity,VehiclePrice,Model,Company,Plate) values ('$VehicleName','$VehicleImage','$Quantity','$VehiclePrice','$Model','$Company','$Plate')");
	if($insert)
	{
		echo "<script>alert('Vehicle Has Been Registered Successfully!')</script>";
		echo "<script>location='VehicleDash.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
	}
}
 ?>

 <form action="VehicleRegister.php" method="post" enctype="multipart/form-data">

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

</form>

<fieldset>
	<legend>
Vehicle List
	</legend>
	<table border="1"  width="100%">
		<tr>
			<th>Vehicle ID</th>
			<th>Vehicle Name</th>
			<th>Vehicle Image</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Model</th>
			<th>Company</th>
			<th>Plate</th>

		</tr>
		<?php 
		$select=mysqli_query($connection,"SELECT * FROM Vehicle");
		$count=mysqli_num_rows($select);
		for ($i=0; $i < $count; $i++)
		{ 
			$data=mysqli_fetch_array($select);
			$VehicleID=$data['VehicleID'];
			$VehicleName=$data['VehicleName'];
			$VehicleImage=$data['VehicleImage'];
			$Quantity=$data['Quantity'];
			$VehiclePrice=$data['VehiclePrice'];
			$Model=$data['Model'];
			$Company=$data['Company'];
			$Plate=$data['Plate'];

			echo "<tr>";
				echo "<td>$VehicleID</td>";
				echo "<td>$VehicleName</td>";
				echo "<td>$VehicleImage</td>";
				echo "<td>$Quantity</td>";
				echo "<td>$VehiclePrice</td>";
				echo "<td>$Model</td>";
				echo "<td>$Company</td>";
				echo "<td>$Plate</td>";
				echo "<td><a href='VehicleUpdate.php?VehicleID=$VehicleID'>Update</a> </td> /
 			<td><a href='VehicleDelete.php?VehicleID=$VehicleID'>Delete</a>
 			</td>";
			echo "</tr>";
		}

		 ?>

	</table>
	</fieldset>
