<?php 
include('carconnect.php');

if(isset($_REQUEST['ocid']))
{
	$CustomerID=$_REQUEST['ocid'];
	$delete="DELETE From Customer WHERE CustomerID='$CustomerID'";
	$runquery=mysqli_query($connection,$delete);
	if($runquery)
{
	echo "<script>alert('Successfully Deleted')</script>";
	echo "<script>location='CustomerView.php'</script>";
}
}
 ?>