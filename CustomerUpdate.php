<?php  
include('carconnect.php');
include('header.php');

if(isset($_POST['btnUpdate'])) 
{
	$CustomerID=$_GET['$ocid'];
	$FirstName=$_POST['txtFirstName'];
	$LastName=$_POST['txtLastName'];
	$Address=$_POST['txtAddress'];
	$Password=$_POST['txtPassword'];
	$Email=$_POST['txtEmail'];
	$NRC=$_POST['txtNRC'];
	$LicenseNo=$_POST['txtLicense'];
	$Gender=$_POST['rdogender'];
	$Phone=$_POST['txtPhone'];

	$queryUpdate="UPDATE Customer
				  SET
				  CustomerID='$txtCustomerID',
				  FirstName='$txtFirstName',
				  LastName='$txtLastName',
				  Address='$txtAddress',
				  Password='$txtPassword',
				  Email='$txtEmail',
				  NRC='$txtNRC'
				  LicenseNo='$txtLicense',
				  Gender='$rdogender',
				  PhoneNo='$txtPhone'
				  WHERE
				  CustomerID='$CustomerID'
				";
	$ret=mysqli_query($connection,$queryUpdate);

	if($ret) //True
	{
		echo "<script>window.alert('Customer Information Updated.')</script>";
		echo "<script>window.location='CustomerView.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Customer Update" . mysqli_error($connection) . "</p>";
	}
}


if(isset($_GET['CustomerID']))
{
	$Customer=$_GET['$CustomerID'];

	$query="SELECT * FROM Customer WHERE CustomerID='$CustomerID'";
	$ret=mysqli_query($connection,$query);
	$arr=mysqli_fetch_array($ret);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Update</title>
</head>
<body>
<form action="CustomerView.php" method="post" enctype="multipart/form-data">

<fieldset>
<legend>Enter Customer Detail Information for Update :</legend>

<table align="center">
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
	<input type="text" name="txtPassword" required/>
		</td>
	</tr>
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
</fieldset>

</form>
</body>
</html>

<?php include('footer.php') ?>