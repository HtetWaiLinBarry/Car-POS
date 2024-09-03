<?php  
session_start();
include('carconnect.php');
include('AutoID_Functions.php');
include('ImportRegister_Functions.php');

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
					 ('$txtImportID','$txtImportName','$txtImportPrice','$txtImportQuantity','$ImportImage','$txtImportDate','$txtTotalAmount','$cboCompanyID','$cboStatus','$txtTaxAmount','txtGrandTotal','cboStaffID','txtTotalQuantity')
					 ";
	$ret=mysqli_query($connection,$Insert_Import);


	$count=count($_SESSION['ImportFunction']);

	for($i=0;$i<$count;$i++) 
	{ 
		$ImportID=$_SESSION['ImportFunction'][$i]['ImportID'];
		$ImportName=$_SESSION['ImportFunction'][$i]['ImportName'];
		$ImportPrice=$_SESSION['ImportFunction'][$i]['ImportPrice'];
		$ImportQuantity=$_SESSION['ImportFunction'][$i]['ImportQuantity'];

		$Insert_IN="INSERT INTO ImportDetails
					(ImportDetailsID,ImportID,ImportPrice,ImportQuantity) 
					VALUES
					('$ImportID','$ImportName','$ImportPrice','$ImportQuantity')
					";
		$ret=mysqli_query($connection,$Insert_IN);
		
	}

	if($ret) //True
	{
		unset($_SESSION['ImportFunction']);

		echo "<script>window.alert('Success : Import Order Successfully Saved.')</script>";
		echo "<script>window.location='ImportRegister.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in ImportRegister" . mysqli_error($connection) . "</p>";
	}
}

if (isset($_GET['btnAdd'])) 
{
	$VehicleID=$_GET['cboImportID'];
	$VehicleName=$_GET['txtImportName'];
	$VehiclePrice=$_GET['txtImportPrice'];
	$ImportQuantity=$_GET['txtImportQuantity'];

	AddImport($VehicleID,$VehicleName,$VehiclePrice,$ImportQuantity);
}

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if ($action === "remove") 
	{
		$VehicleID=$_GET['VehicleID'];
		RemoveImport($VehicleID);
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
	<title>Import Creation</title>

	<script type="text/javascript" src="DatePicker/datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css"/>

</head>
<body>
<form action="ImportRegister.php" method="get">
	
<fieldset>
<legend>Vehicle Import Form</legend>
<table>
<tr>
	<td>
		<table>
		<tr>
			<td>Import Number</td>
			<td>
				<input type="text" name="txtImportID" value="<?php echo AutoID('ImportDetails','ImportDetailsID','PUR-',6) ?>" readonly />
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
			<td>Staff Info</td>
			<td>
				<input type="text" name="txtStaffInfo" value="<?php echo $_SESSION['StaffName'] ?>" disabled />
			</td>
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
				<select name="cboImportID">
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
	<th>ImportID</th>
	<th>ImportName</th>
	<th>ImportPrice (USD)</th>
	<th>ImportQty (pcs)</th>
	<th>Image</th>
</tr>
<?php  
$Pcount=count($_SESSION['ImportFunction']);

for($i=0; $i<$Pcount;$i++) 
{ 
	$VehicleID=$_SESSION['ImportFunction'][$i]['VehicleID'];
	$VehicleName=$_SESSION['ImportFunction'][$i]['VehicleName'];
	$VehiclePrice=$_SESSION['ImportFunction'][$i]['VehiclePrice'];
	$ImportQuantity=$_SESSION['ImportFunction'][$i]['ImportQuantity'];

	$SubTotal=$VehiclePrice * $ImportQuantity;

	echo "<tr>";
	echo "<td>$VehicleID</td>";
	echo "<td>$VehicleName</td>";
	echo "<td>$ImportPrice</td>";
	echo "<td>$SubTotal</td>";
	echo "<td>
		  <a href='ImportRegister.php?action=remove&VehicleID=$VehicleID'>Remove</a>
		  </td>";
	echo "</tr>";
}
?>
	<tr>
		<td colspan="7">
		<b>CompanyID :</b>
		<select name="cboCompanyID">
			<option>Choose Company ID</option>
			<option value="1">M9 Group of Companies</option>
			<option value="2">Giordano Retail Shop</option>
		</select>

		<input type="submit" name="btnSave" value="Save" />
		<a href="ImportRegister.php?action=clearall">Empty Import Creation List</a> | 
		<a href="ImportRegister.php">Back >> </a>
		</td>
	</tr>
</table>


</fieldset>

</form>
</body>
</html>