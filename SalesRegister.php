<?php 
	include('carconnect.php');

 if(isset($_POST['btnSave']))
{
	$SalesID=$_POST['txtSalesID'];
	$SalesDetail=$_POST['txtSalesDetail'];
	$cboStaffID=$_GET['StaffID'];
	$cboCustomerID=$_GET['CustomerID'];
	$cboVehicleID=$_GET['VehicleID'];

	$insert=mysqli_query($connection,"INSERT INTO Sales values ('$SalesID','$SalesDetail','$cboStaffID','$cboCustomerID','$cboVehicleID')");
	if($insert)
	{
		echo "<script>alert('Sales Has Been Registered!')</script>";
		echo "<script>location='StaffDashboard.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
	}
}




 ?>

<html>
<head>
        <title>Sales Register</title>
    </head>
<body>
<form action="SalesRegister.php" method="post">
			<fieldset>
	<table width="70%" align="center">
		<tr>
			<td>Sales ID</td>
			<td>
				<input type="text" name="txtSalesID" required/>
			</td>
		</tr>
	<tr>
	<td>Sales Detail</td>
	<td>
	<input type="text" name="txtSalesDetail" required/>
	</td>
</tr>
	<tr>
			<td>Staff Code</td>
			<td>
				<select name="cboStaffID">
					<option>Choose Staff</option>
					<?php  
					$StaffQuery="SELECT * FROM Staff";
					$Staff_ret=mysqli_query($connection,$StaffQuery);
					$Staff_count=mysqli_num_rows($Staff_ret);

					for($i=0;$i<$Staff_count;$i++) 
					{ 
						$arr=mysqli_fetch_array($Staff_count);
						$StaffID=$arr['StaffID'];
						$StaffName=$arr['StaffName'];

						echo "<option value='$StaffID'>$StaffID ~ $StaffName</option>";
					}
					?>
				</select>
			</td>	</tr>
	<tr>
		<td>Customer Code</td>
			<td>
				<select name="cboCustomerID">
					<option>Choose Customer</option>
					<?php  
					$CustomerQuery="SELECT * FROM Customer";
					$Customer_ret=mysqli_query($connection,$CustomerQuery);
					$Customer_count=mysqli_num_rows($Customer_ret);

					for($i=0;$i<$Customer_count;$i++) 
					{ 
						$arr=mysqli_fetch_array($Customer_ret);
						$CustomerID=$arr['CustomerID'];
						$FirstName=$arr['FirstName'];
						$LastName=$arr['LastName'];


						echo "<option value='$CustomerID'>$CustomerID ~ $FirstName ~ $LastName</option>";
					}
					?>
				</select>
			</td>
	</tr>
	<tr>
		<td>Vehicle Code</td>
			<td>
				<select name="cboVehicleID">
					<option>Choose Vehicle</option>
					<?php  
					$VehicleQuery="SELECT * FROM Vehicle";
					$Vehicle_ret=mysqli_query($connection,$VehicleQuery);
					$Vehicle_count=mysqli_num_rows($Vehicle_ret);

					for($i=0;$i<$Vehicle_count;$i++) 
					{ 
						$arr=mysqli_fetch_array($Vehicle_ret);
						$VehicleID=$arr['VehicleID'];
						$VehicleName=$arr['VehicleName'];

						echo "<option value='$CustomerID'>$CustomerID ~ $CustomerName</option>";
					}
					?>
				</select>
			</td>
	</tr>
	<tr>
		<td>
			<input type="submit" name="btnSave" value="Save">
			<input type="reset" name="btnCancel" value="Cancel">
		</td>
	</tr>                                                                                                                                                                          
</table>

<legend align="center">Company Register</legend>
		</fieldset>
</form>

</body>
</html>