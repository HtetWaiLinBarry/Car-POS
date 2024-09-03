<?php 
	include('carconnect.php');

 if(isset($_POST['btnUpdate']))
{

	$BrandName=$_POST['txtBrandName'];
	$BrandDetails=$_POST['txtBrandDetails'];
	$BrandDate=$_POST['setdate'];
	$update=mysqli_query($connection,"UPDATE Customer SET BrandID='$BrandID', BrandName='$BrandName', BrandDetails='$BrandDetails', BrandDate='$BrandDate' WHERE BrandID='$BrandID'");
	if($update)
	{
		echo "<script>alert('Brand Has Been Updated!')</script>";
		echo "<script>location='BrandDash.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
	}
}




 ?>

<html>
<head>
	<title>Brand Update</title>
</head>
<body>
<form action="BrandDash.php" method="post">
			<fieldset>
	<table width="70%" align="center">
		<tr>
		<td>Brand Name</td>
		<td>
			<input type="text" name="txtBrandName" required/>
		</td>
	</tr>
	<tr>
		<td>Brand Details</td>
		<td>
			<input type="text" name="txtBrandDetails" required/>
		</td>
	</tr>
	<tr>
		<td>Choose Date</td>
		<td>
			<input type="date" name="setdate" required/>
		</td>
	</tr>
	<tr>
		<td>
			<input type="submit" name="btnUpdate" value="Update">
			<input type="reset" name="btnCancel" value="Cancel">
		</td>
	</tr>                                                                                                                                                                       
</table>
<legend align="center">Brand Update</legend>
		</fieldset>
</form>
</body>
</html>