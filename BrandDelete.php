<?php 
include('carconnect.php');

if(isset($_REQUEST['bid']))
{
	$BrandID=$_REQUEST['bid'];
	$delete="DELETE From Brand WHERE BrandID='$BrandID'";
	$runquery=mysqli_query($connection,$delete);
	if($runquery)
{
	echo "<script>alert('Successfully Deleted')</script>";
	echo "<script>location='BrandDash.php'</script>";
}
}
 ?>