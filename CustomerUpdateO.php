<?php 
	include('carconnect.php');
	include ('header.php');

 if(isset($_POST['btnSave']))
{
	$CustomerID=$_POST['cboCustomerID'];
	$FirstName=$_POST['txtFirstName'];
	$LastName=$_POST['txtLastName'];
	$Address=$_POST['txtAddress'];
	$Password=$_POST['txtPassword'];
	$Email=$_POST['txtEmail'];
	$NRC=$_POST['txtNRC'];
	$LicenseNo=$_POST['txtLicense'];
	$Gender=$_POST['rdogender'];
	$Phone=$_POST['txtPhone'];
	$update=mysqli_query($connection,"UPDATE Customer SET CustomerID='$CustomerID', FirstName='$FirstName', LastName='$LastName', Address='$Address', Password='$Password', Email='$Email', NRC='$NRC', LicenseNo='$LicenseNo', Gender='$Gender', PhoneNo='$Phone' WHERE CustomerID='$CustomerID'");
	if($update)
	{
		echo "<script>alert('Customer Has Been Updated!')</script>";
		echo "<script>location='CustomerView.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
	}
}




 ?>

<html>
<head>
	<title>Customer Update</title>
</head>
<body>
<form action="CustomerUpdateO.php" method="post">
			<fieldset>
	<table width="70%" align="center">
		<tr>
			<td>Select Customer ID</td>
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
	<td>First Name</td>
	<td>
	<input type="text" name="txtFirstName" required/>
	</td>
</tr>
	<tr>
		<td>Last Name</td>
		<td>
	<input type="text" name="txtLastName"required />
		</td>
	</tr>
	<tr>
		<td>Address</td>
		<td>
	<input type="text" name="txtAddress" required/>
		</td>
	</tr>
	<tr>
		<td>Password</td>
		<td>
			<input type="password" name="txtPassword" required/>
		</td>
	<tr>
		<td>Email</td>
		<td>
			<input type="email" name="txtEmail" placeholder="example@gmail.com" required/>
		</td>
	</tr>
	
	<tr>
		<td>NRC</td>
		<td>
			<input type="text" name="txtNRC" required/>
		</td>
	
	</tr>

	<tr>
		<td>LicenseNo</td>
		<td>
			<input type="text" name="txtLicense" required/>
	
	</tr>

	<tr>
		<td>Gender</td>
		<td>
			<input type="radio" name="rdogender" value="Male" required/> Male
  			<input type="radio" name="rdogender" value="Female" required/> Female
  			<input type="radio" name="rdogender" value="Other" required/> Other
  		</td>
	</tr>

	<tr>
		<td>Phone</td>
		<td>
			<input type="number" name="txtPhone" required/>
	
	</tr>
		<td>
			<input type="submit" name="btnSave" value="Save">
			<input type="reset" name="btnCancel" value="Cancel">
		</td>
	</tr>                                                                                                                                                                          
</table>
<legend align="center">Customer Update</legend>
		</fieldset>
</form>
</body>
</html>

<?php include('footer.php'); ?>