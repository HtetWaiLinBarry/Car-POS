<?php  
session_start();
include('carconnect.php');
include('AutoID_Functions.php');
include('ImportRegisterFunctions.php');

if(isset($_GET['btnSave'])) 
{
	$txtImportID=$_GET['txtImportID'];
	$txtImportName=$_GET['txtImportName'];
	$txtImportPrice=$_GET['txtImportPrice'];
	$txtImportQuantity=$_GET['txtImportQuantity'];
	$txtImportImage=$_FILES['txtImage']['name'];
	if($ImportImage)
	{
		$folder="Images/";
		$path=$folder.$ImportImage;
		$copied=copy($_FILES['txtImage']['tmp_name'],$path);
		if(!copied)
		{
			echo"Copy Image Error!";
		}
	}
	$txtImportDate=$_GET['txtImportDate'];
	$txtTotalAmount=$_GET['txtTotalAmount'];
	$cboCompanyID=$_GET['cboCompanyID'];
	$cboStatus=$_GET['cboStatus'];
	$txtVAT=$_GET['txtVAT'];
	$txtGrandTotal=$_GET['txtGrandTotal'];
	$cboStaffID=$_GET['cboStaffID'];
	$txtTotalQuantity=$_GET['txtTotalQuantity'];

	$StaffID=$_SESSION['StaffID'];
	$Status="Pending";

	$Insert_Import="INSERT INTO Import
					 (ImportID,ImportName,ImportPrice,ImportQuantity,ImportImage,ImportDate,TotalAmount,CompanyID,Status,TaxAmount,GrandTotal,StaffID,TotalQuantity) 
					 VALUES
					 ('$txtImportID','$txtImportName','$txtImportPrice','$txtImportQuantity','$ImportImage','$txtImportDate','$txtTotalAmount','$cboCompanyID','$cboStatus','$txtTaxAmount','$txtGrandTotal','$cboStaffID','$txtTotalQuantity')
					 ";
	$ret=mysqli_query($connection,$Insert_Import);


	$count=count($_SESSION['ImportFunction']);

	for($i=0;$i<$count;$i++) 
	{ 
		$VehicleID=$_SESSION['ImportFunction'][$i]['VehicleID'];
		$ImportQuantity=$_SESSION['ImportFunction'][$i]['ImportQuantity'];
		$ImportPrice=$_SESSION['ImportFunction'][$i]['ImportPrice'];

		$Insert_IN="INSERT INTO ImportDetails
					(ImportDetailsID,VehicleID,ImportPrice,ImportQuantity) 
					VALUES
					('$txtImportID','$VehicleID','$ImportPrice','$ImportQuantity')
					";
		$ret=mysqli_query($connection,$Insert_IN);
		
	}

	if($ret) //True
	{
		unset($_SESSION['ImportFunction']);

		echo "<script>window.alert('Success : Import Order Successfully Saved.')</script>";
		echo "<script>window.location='ImportDash.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Import_Register" . mysqli_error($connection) . "</p>";
	}
}

if (isset($_GET['btnAdd'])) 
{
	$cboVehicleID=$_GET['cboVehicleID'];
	$txtImportPrice=$_GET['txtImportPrice'];
	$txtImportQuantity=$_GET['txtImportQuantity'];

	AddVehicle($cboVehicleID,$txtImportPrice,$txtImportQuantity);
}

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if ($action === "remove") 
	{
		$VehicleID=$_GET['VehicleID'];
		RemoveVehicle($VehicleID);
	}
	elseif ($action === "clearall") 
	{
		ClearAll();
	}
}
else
{
	$action="";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Import Order</title>

	<script type="text/javascript" src="DatePicker/datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css"/>

</head>
<body>
<form action="ImportDash.php" method="get">
	
<fieldset>
<legend>Import Order Form</legend>
<table>
<tr>
	<td>
		<table>
		<tr>
			<td>Import Number</td>
			<td>
				<input type="text" name="txtImportID" value="<?php echo AutoID('Import','ImportID','PUR-',6) ?>" readonly />
			</td>

			<td>Import Name<td>
				<td>
					<input type="text" name="txtImportName">
				</td>
			</td>

			<td>Total Amount</td>
			<td>
				<input type="text" name="txtTotalAmount" value="<?php echo CalculateTotalAmount() ?>" readonly /> USD
			</td>

		</tr>

		<tr>
			<td>Import Date</td>
			<td>
				<input type="text" name="txtImportDate" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly />
			</td>
			<td>GOV Tax (5%)</td>
			<td>
				<input type="text" name="txtVAT" value="<?php echo CalculateTax() ?>" readonly /> USD
			</td>
		</tr>
		<tr>
			<td>Total Quantity</td>
			<td>
				<input type="text" name="txtTotalQuantity" value="<?php echo CalculateTotalQty() ?>" readonly /> Pcs
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<hr>
			</td>
			<td>Grand Total</td>
			<td>
				<input type="text" name="txtGrandTotal" value="<?php echo CalculateTotalAmount() + CalculateTax() ?>" readonly /> USD
			</td>
		</tr>
		<tr>
			<td>Vehicle Code</td>
			<td>
				<select name="cboVehicleID">
					<option>Choose Vehicle</option>
					<?php  
					$VehicleQuery="SELECT * FROM Vehicle";
					$Vehicle_ret=mysqli_query($connection,$VehicleQuery);
					$Vehicle_count=mysqli_num_rows($Vehicle_ret);

					for($i=0;$i<$Vehicle_count;$i++) 
					{ 
						$arr=mysqli_fetch_array($Vehicle_ret);
						$VehicleID=$arr['VehicleID'];
						$VehicleName=$arr['VehicleName'];

						echo "<option value='$VehicleID'>$VehicleID ~ $VehicleName</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				<select name="cboStatus">
		<option>Pending</option>
		<option>Confirmed</option>
	</select>
			</td>
		<tr>
			<td>Import Price</td>
			<td>
				<input type="number" name="txtImportPrice" value="0" /> USD
			</td>
		</tr>
		<tr>
			<td>Import Quantity</td>
			<td>
				<input type="number" name="txtImportQuantity" value="0" /> Pcs
			</td>
		</tr>
		<tr>
			<td>Staff Select</td>
			<td>
				<select>
					<option>AAA</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
			<input type="submit" name="btnAdd" value="Add" />
			<input type="reset" value="Clear" />
			</td>
		</tr>
		</table>
	</td>
</tr>
		</table>
	</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Import Details :</legend>

<?php  
if(!isset($_SESSION['ImportFunction'])) 
{
	echo "<p>No Import Details Found.</p>";
	exit();
}
?>

<table border="1">
<tr>
	<th>VehicleID</th>
	<th>VehiclePrice</th>
	<th>VehicleName</th>
	<th>ImportPrice (USD)</th>
	<th>ImportQuantity</th>
	<th>Sub-Total</th>
	<th>Action</th>
</tr>
<?php  
$Pcount=count($_SESSION['ImportFunction']);

for($i=0; $i<$Pcount;$i++) 
{ 
	$VehicleID=$_SESSION['ImportFunction'][$i]['VehicleID'];
	$VehiclePrice=$_SESSION['ImportFunction'][$i]['VehiclePrice'];
	$VehicleName=$_SESSION['ImportFunction'][$i]['VehicleName'];
	$ImportPrice=$_SESSION['ImportFunction'][$i]['ImportPrice'];
	$ImportQuantity=$_SESSION['ImportFunction'][$i]['ImportQuantity'];
	$SubTotal=$ImportPrice * $ImportQuantity;

	echo "<tr>";
	echo "<td>$VehicleID</td>";
	echo "<td>$VehiclePrice</td>";
	echo "<td>$VehicleName</td>";
	echo "<td>$ImportPrice</td>";
	echo "<td>$ImportQuantity</td>";
	echo "<td>$SubTotal</td>";
	echo "<td>
		  <a href='ImportDash.php?action=remove&VehicleID=$VehicleID'>Remove</a>
		  </td>";
	echo "</tr>";
}
?>
	<tr>
		<td colspan="7">
		<b>CompanyID :</b>
		<select name="cboSupplierID">
			<option>Choose Company ID</option>
			<option value="1">M9 Group of Companies</option>
			<option value="2">Giordano Retail Shop</option>
		</select>

		<input type="submit" name="btnSave" value="Save" />
		<a href="ImportDash.php?action=clearall">Empty Import Cart</a> | 
		<a href="Home.php">Back >> </a>
		</td>
	</tr>
</table>


</fieldset>

</form>
</body>
</html>