<?php 
	include('carconnect.php');

 if(isset($_POST['btnSave']))
{
	$StaffName=$_POST['txtStaffName'];
	$Phone=$_POST['txtPhoneNo'];
	$Email=$_POST['txtEmail'];
	$Password=$_POST['txtPassword'];
	$Center=$_POST['cboCenter'];
	$Position=$_POST['cboPosition'];

	$Image=$_FILES['txtImage']['name'];
	if($Image)
	{
		$folder="Images/";
		$path=$folder.$Image;
		$copied=copy($_FILES['txtImage']['tmp_name'],$path);
		if(!copied)
		{
			echo"Copy Image Error!";
		}
	}
	$insert=mysqli_query($connection,"INSERT INTO Staff (StaffName,Phone,Email,StaffPassword,Center,Position,StaffImage) values ('$StaffName','$Phone','$Email','$Password','$Center','$Position','$path')");
	if($insert)
	{
		echo "<script>alert('Staff Has Been Registered!')</script>";
		echo "<script>location='StaffEntryDash.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
	}
}




 ?>

<html>
<head>
        <title>StaffEntry</title>
    </head>
<body>
<form action="StaffEntry.php" method="post">
			<fieldset>
	<table width="70%" align="center">

	<tr>
	<td>Staff Name</td>
	<td>
	<input type="text" name="txtStaffName" placeholder="Eg. Steven" required/>
	</td>
</tr>
	<tr>
		<td>Phone</td>
		<td>
	<input type="text" name="txtPhoneNo" placeholder="Eg. 09123456789" required />
		</td>
	</tr>
	<tr>
		<td>Email</td>
		<td>
	<input type="email" name="txtEmail" placeholder="Eg. example@gmail.com" required/>
		</td>
	</tr>
	<tr>
		<td>Password</td>
		<td>
			<input type="password" name="txtPassword" required/>
	
	<tr>
		<td>
			Center
		</td>
		<td>
			<select name="cboCenter">
				<option>Choose Center</option>
				<option>Reception</option>
				<option>Office</option>
				<option>Sales Center</option>
				<option>Service Center</option>
				<option>Showroom</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>
			Position
		</td>
		<td>

			<select name="cboPosition">
				<option>Choose Position</option>
				<option>Staff</option>
				<option>Receptionist</option>
				<option>Manager</option>
				<option>Jenitor</option>
				<option>Assistant</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>
			Staff Image
		</td>
		<td>
			<input type="file" name="txtImage" required>
		</td>
	</tr>
	<tr>
		<td>
			<input type="submit" name="btnSave" value="Save">
			<input type="reset" name="btnCancel" value="Cancel">
		</td>
	</tr>                                                                                                                                                                          
</table>

<legend align="center">Staff Register</legend>
		</fieldset>
</form>

</body>
</html>