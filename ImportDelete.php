<?php 
include('carconnect.php');

if(isset($_REQUEST['ipdid']))
{
	$ImportDetailsID=$_REQUEST['ipdid'];
	$delete="DELETE From ImportDetails WHERE ImportDetailsID='$ImportDetailsID'";
	$runquery=mysqli_query($connection,$delete);
	if($runquery)
{
	echo "<script>alert('Successfully Deleted')</script>";
	echo "<script>location='ImportDash.php'</script>";
}
}
 ?>