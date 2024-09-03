<?php 
include('carconnect.php');

if(isset($_REQUEST['ocoid']))
{
	$CompanyID=$_REQUEST['ocoid'];
	$delete="DELETE From Company WHERE CompanyID='$CompanyID'";
	$runquery=mysqli_query($connection,$delete);
	if($runquery)
{
	echo "<script>alert('Successfully Deleted')</script>";
	echo "<script>location='CompanyDash.php'</script>";
}
}
 ?>