<?php 
include('carconnect.php');

if(isset($_REQUEST['VehicleID']))
{
	$VehicleID=$_REQUEST['VehicleID'];
	$delete="DELETE From Vehicle WHERE VehicleID='$VehicleID'";
	$runquery=mysqli_query($connection,$delete);
	if($runquery)
{
	echo "<script>alert('Successfully Deleted')</script>";
	echo "<script>location='VehicleDash.php'</script>";
}
}

 ?>