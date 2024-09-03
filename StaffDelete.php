<?php 
include('carconnect.php');

if(isset($_REQUEST['osid']))
{
	$StaffID=$_REQUEST['osid'];
	$delete="DELETE From Staff WHERE StaffID='$StaffID'";
	$runquery=mysqli_query($connection,$delete);
	if($runquery)
{
	echo "<script>alert('Successfully Deleted')</script>";
	echo "<script>location='StaffView.php'</script>";
}
}
 ?>