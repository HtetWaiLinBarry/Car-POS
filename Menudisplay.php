<?php 
	session_start();
	include('carconnect.php');
	include ('header.php');
if(isset($_POST['btnSearch'])) 
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if ($rdoSearchType == 1) 
	{
		$cboID=$_POST['cboID'];

		 $query="SELECT s.*, v.*
				FROM Sales s, Vehicle v
				WHERE s.VehicleID='$cboID'
				AND v.VehicleID=s.VehicleID
				";

		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);
	}
	else if ($rdoSearchType == 2) 
	{
		$cboName=$_POST['cboName'];

		$query="SELECT s.*, v.*
				FROM Sales s, Vehicle v
				WHERE v.VehicleName='$cboName'
				AND v.VehicleID=s.VehicleID
				";
		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);
	}
	else if ($rdoSearchType == 3) 
	{
		$cboBrandType=$_POST['cboBrandType'];

		 $query="SELECT s.*, v.*,bt.*,b.*
				FROM Sales s, Vehicle v, BrandType bt
				WHERE bt.BrandType='$cboBrandType'
				AND b.BrandID=bt.BrandID
				";
		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);
	}
	else
	{	
		$query="SELECT v.*,s.*,bt.*,b.* FROM Vehicle v,Sales s, BrandType bt, Brand b
				WHERE v.VehicleID=s.VehicleID  
				AND b.BrandID=bt.BrandID";
		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);

	}

}
elseif(isset($_POST['btnShowAll']))
{
	$query="SELECT v.*,s.*,bt.*,b.* FROM Vehicle v,Sales s, BrandType bt, Brand b 
			WHERE s.VehicleID=v.VehicleID  
			AND b.BrandID=bt.BrandID
				";

	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);
}
else
{
	$query="SELECT v.*,s.*,bt.*,b.* FROM Vehicle v,Sales s, BrandType bt, Brand b 
				WHERE v.VehicleID=s.VehicleID  
				AND b.BrandID=bt.BrandID";

	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu Display</title>
	<script type="text/javascript" src="DatePicker/datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css"/>
</head>
<body>
<form action="Menudisplay.php" method="post">
<table class="table table-striped table-hover">
<tr>
	<td>
		<input type="radio" name="rdoSearchType" value="1" checked />Vehicle: <br/>
	<select name="cboID">
		<option>Choose Vehicle:</option> 
		<?php  
		$sales_Query="SELECT * FROM Vehicle";
		$sales_ret=mysqli_query($connection,$sales_Query);
		$sales_count=mysqli_num_rows($sales_ret); 
		for($i=0;$i<$sales_count;$i++) 
		{ 
			$sales_arr=mysqli_fetch_array($sales_ret);
			$VehicleID=$sales_arr['VehicleID'];

			echo "<option value='$VehicleID'>$VehicleID</option>";
		}
		?>
	</select>
		
</td>
	<td>
	<input type="radio" name="rdoSearchType" value="2" />By Name: <br/>
	<select name="cboName">
		<option>Choose Vehicle :</option>
		<?php
		$sales_Query="SELECT * FROM Vehicle";
		$sales_ret=mysqli_query($connection,$sales_Query);
		$sales_count=mysqli_num_rows($sales_ret);
		for ($i=0; $i <$sales_count; $i++) 
		{ 
			$sales_arr=mysqli_fetch_array($sales_ret);
			$VehicleName=$sales_arr['VehicleName'];
			echo "<option value='$VehicleName'>$VehicleName</option>";
		}
		?>
	</select>
	</td>

	<td>
	<input type="radio" name="rdoSearchType" value="3" />MenuTypeName: <br/>
	<select name="cboBrandType">
		<option>Choose MenuType Name :</option>
		<?php
		$brandtype_Query="SELECT * FROM BrandType";
		$brandtype_ret=mysqli_query($connection,$brandtype_Query);
		$brandtype_count=mysqli_num_rows($brandtype_ret);
		for ($i=0; $i <$brandtype_count; $i++) 
		{ 
			$brandtype_arr=mysqli_fetch_array($brandtype_ret);
			$BrandType=$menutype_arr['BrandType'];
			echo "<option value='$BrandType'>$BrandType</option>";
		}
		?>
	</select>
	</td>

	<td>
	</td>

	<td>
	<br/>
	<input type="submit" name="btnSearch" value="Search" />
	<input type="submit" name="btnShowAll" value="Show All" />
	<input type="reset" value="Clear" />
	</td>
</tr>
</table>

<!-- 	<?php

	// $query="SELECT m.*,s.*,mt.* FROM Menu m,shop s, menutype mt 
	// 			WHERE m.ShopID=s.ShopID  
	// 			AND m.MenuTypeID=mt.MenuTypeID";
	// 	$result=mysqli_query($connection,$query);
	// 	$count=mysqli_num_rows($result);

	// if ($count < 1) 
	// {
	// 	echo "<p>No Data Found.</p>";
	// 	exit();
	// }

	?> -->

	<?php

	for ($i=0; $i < $count; $i++) 
	{ 	
		$row=mysqli_fetch_array($result);

		$VID=$row['VehicleID'];
		$VehicleName=$row['VehicleName'];
		$Quantity=$row['Quantity'];
		$Price=$row['VehiclePrice'];
		$SalesID=$row['SalesID'];
		$SalesDetail=$row['SalesDetail'];
		$BrandType=$row['BrandType'];
		$BrandTypeID=$row['BrandTypeID'];
	}
	?>
	

</form>

<?php include 'footer.php'; ?>