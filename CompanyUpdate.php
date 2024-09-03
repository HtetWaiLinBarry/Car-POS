<?php 
	include('carconnect.php');

 if(isset($_POST['btnUpdate']))
{
	$CompanyID=$_POST['cboCompanyID'];
	$CompanyName=$_POST['txtCompanyName'];
	$update=mysqli_query($connection,"UPDATE Company SET CompanyID='$CompanyID', CompanyName='$CompanyName'");
	if($update)
	{
		echo "<script>alert('Company Has Been Updated!')</script>";
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
	<title>Company Update</title>
</head>
<body>
<form action="CompanyDash.php" method="post">
			<fieldset>
	<table width="70%" align="center">
		<tr>
			<td>Select Company ID</td>
			<td>Company Code</td>
			<td>
				<select name="cboCompanyID">
					<option>Choose Company</option>
					<?php  
					$CoQuery="SELECT * FROM Company";
					$Co_ret=mysqli_query($connection,$CoQuery);
					$Co_count=mysqli_num_rows($Co_ret);

					for($i=0;$i<$Co_count;$i++) 
					{ 
						$arr=mysqli_fetch_array($Co_ret);
						$CompanyID=$arr['CompanyID'];
						$CompanyName=$arr['CompanyName'];

						echo "<option value='$CompanyID'>$CompanyID ~ $CompanyName</option>";
					}
					?>
				</select>
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
			<input type="submit" name="btnUpdate" value="Update">
			<input type="reset" name="btnCancel" value="Cancel">
		</td>
	</tr>                                                                                                                                                                          
</table>
<legend align="center">Company Update</legend>
		</fieldset>
</form>
</body>
</html>