<?php  
session_start();
include('carconnect.php');

if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];

	$SCheck="SELECT * FROM Staff 
			WHERE Email='$txtEmail'
			AND StaffPassword='$txtPassword'
			";
	$ret=mysqli_query($connection,$SCheck);
	$count=mysqli_num_rows($ret);
	$arr=mysqli_fetch_array($ret);
	//print_r($arr);

	if($count < 1) 
	{
		echo "<script>window.alert('User Email or Password Incorrect.')</script>";
		echo "<script>window.location='StaffLogin.php'</script>";
		exit();
	}
	else
	{
		$_SESSION['StaffID']=$arr['StaffID'];   
		$_SESSION['StaffName']=$arr['StaffName'];
		echo "<script>window.alert('Staff Login : Success')</script>";
		echo "<script>window.location='StaffDashboard.php'</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Login</title>
</head>
<body>
<form action="StaffLogin.php" method="post" enctype="multipart/form-data">

<fieldset>
<legend>Enter Staff Login Information :</legend>

<table align="center">
<tr>
	<td>Email</td>
	<td>
	<input type="email" name="txtEmail" placeholder="example@email.com" required/>	
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
	<input type="password" name="txtPassword" placeholder="XXXXXXXXXXX" required/>	
	</td>
</tr>
<tr>
	<td>
		<a href="StaffRegister.php">Register?</a>
	</td>
	<td>
		<input type="submit" name="btnLogin" value="Login"/>
		<input type="reset" name="btnClear" value="Clear"/>	
	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>