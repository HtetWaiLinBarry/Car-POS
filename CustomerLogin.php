<?php  
session_start();
include('carconnect.php');

if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];

	$CCheck="SELECT * FROM Customer 
			WHERE Email='$txtEmail'
			AND Password='$txtPassword'
			";
	$ret=mysqli_query($connection,$CCheck);
	$count=mysqli_num_rows($ret);
	$arr=mysqli_fetch_array($ret);
	//print_r($arr);

	if($count < 1) 
	{
		echo "<script>window.alert('User Email or Password Incorrect.')</script>";
		echo "<script>window.location='CustomerLogin.php'</script>";
		exit();
	}
	else
	{
		$_SESSION['CustomerID']=$arr['CustomerID'];   
		$_SESSION['FirstName']=$arr['FirstName'];
		$_SESSION['LastName']=$arr['LastName'];
		echo "<script>window.alert('Customer Login : Success')</script>";
		echo "<script>window.location='Home.php'</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Login</title>
	<link rel="stylesheet" type="text/css" href="customercss.css">
</head>
<body>
<form action="CustomerLogin.php" method="post" enctype="multipart/form-data">



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
		<a href="CustomerRegister.php">Register?</a>
	</td>
	<td>
		<input type="submit" name="btnLogin" value="Login"/>
		<input type="reset" name="btnClear" value="Clear"/>	
	</td>
</tr>
</table>

</form>
</body>
</html>

<?php include('footer.php') ?>