<?php 
	include('carconnect.php');

 if(isset($_POST['btnSave']))
{
	$BrandName=$_POST['txtBrandName'];
	$BrandDetails=$_POST['txtBrandDetails'];
	$BrandDate=$_POST['setdate'];

	$insert=mysqli_query($connection,"INSERT INTO Brand (BrandName, BrandDetails, BrandDate) values ('$BrandName','$BrandDetails', '$BrandDate')");
	if($insert)
	{
		echo "<script>alert('Brand Has Been Registered!')</script>";
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
        <title>Brand Register</title>
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
			<input type="submit" name="btnSave" value="Save">
			<input type="reset" name="btnCancel" value="Cancel">
		</td>
	</tr>                                                                                                                                                                          
</table>

<legend align="center">Brand Register</legend>
		</fieldset>
</form>

</body>
</html>