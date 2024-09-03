<?php 
	include('carconnect.php');
	include('header.php');

 if(isset($_POST['btnSave']))
{
	$FirstName=$_POST['txtFirstName'];
	$LastName=$_POST['txtLastName'];
	$Address=$_POST['txtAddress'];
	$Password=$_POST['txtPassword'];
	$Email=$_POST['txtEmail'];
	$NRC=$_POST['txtNRC'];
	$LicenseNo=$_POST['txtLicense'];
	$Gender=$_POST['rdogender'];
	$Phone=$_POST['txtPhone'];

	$insert=mysqli_query($connection,"INSERT INTO Customer (FirstName,LastName,Address,Password,Email,NRC,LicenseNo,Gender,PhoneNo) values ('$FirstName','$LastName','$Address','$Password','$Email','$NRC','$LicenseNo','$Gender','$Phone')");
	if($insert)
	{
		echo "<script>alert('Customer Has Been Registered!')</script>";
		echo "<script>location='CustomerRegister.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
	}
}




 ?>

<html>
<head>
        <title>Customer Register</title>
    </head>
<body>
<form action="CustomerRegister.php" method="post">
			<fieldset>
	<table width="70%" align="center">

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

<legend align="center">Customer Register</legend>
		</fieldset>
</form>

</body>
</html>

<?php include('footer.php'); ?>