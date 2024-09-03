<?php 
	include('carconnect.php');

 if(isset($_POST['btnSave']))
{
	$CompanyID=$_POST['txtCompanyID'];
	$CompanyName=$_POST['txtCompanyName'];

	$insert=mysqli_query($connection,"INSERT INTO Company(CompanyID,CompanyName) values ('$CompanyID','$CompanyName')");
	if($insert)
	{
		echo "<script>alert('Company Has Been Registered!')</script>";
		echo "<script>location='CompanyDash.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
	}
}




 ?>

<html>
<head>
        <title>Company Register</title>
    </head>
<body>
<form action="CompanyDash.php" method="post">
			<fieldset>
	<table width="70%" align="center">
		<tr>
			<td>Company ID</td>
			<td>
				<input type="text" name="txtCompanyID" required/>
			</td>
		</tr>
	<tr>
	<td>Company Name</td>
	<td>
	<input type="text" name="txtCompanyName" required/>
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