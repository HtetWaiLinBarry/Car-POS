<?php  
session_start();
include('connect.php');
include('AutoID_Functions.php');
include('Purchase_Order_Functions.php');

if(isset($_GET['btnSave'])) 
{
	$txtPurchaseOrderID=$_GET['txtPurchaseOrderID'];
	$txtPurchaseOderDate=$_GET['txtPurchaseOderDate'];
	$cboSupplierID=$_GET['cboSupplierID'];
	$txtTotalAmount=$_GET['txtTotalAmount'];
	$txtVAT=$_GET['txtVAT'];
	$txtTotalQuantity=$_GET['txtTotalQuantity'];
	$txtGrandTotal=$_GET['txtGrandTotal'];

	$StaffID=$_SESSION['StaffID'];
	$Status="Pending";

	$Insert_Purchase="INSERT INTO `purchaseorder`
					 (`PurchaseOrderID`, `PurchaseOrderDate`, `TotalAmount`, `SupplierID`, `Status`, `TaxAmount`, `GrandTotal`, `StaffID`, `TotalQuantity`) 
					 VALUES
					 ('$txtPurchaseOrderID','$txtPurchaseOderDate','$txtTotalAmount','$cboSupplierID','$Status','$txtVAT','$txtGrandTotal','$StaffID','$txtTotalQuantity')
					 ";
	$ret=mysqli_query($connection,$Insert_Purchase);


	$count=count($_SESSION['PurchaseFunction']);

	for($i=0;$i<$count;$i++) 
	{ 
		$ProductID=$_SESSION['PurchaseFunction'][$i]['ProductID'];
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['PurchaseQuantity'];
		$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['PurchasePrice'];

		$Insert_PD="INSERT INTO `purchaseorderdetail`
					(`PurchaseOrderID`, `ProductID`, `Quantity`, `PurchasePrice`) 
					VALUES
					('$txtPurchaseOrderID','$ProductID','$PurchaseQuantity','$PurchasePrice')
					";
		$ret=mysqli_query($connection,$Insert_PD);
		
	}

	if($ret) //True
	{
		unset($_SESSION['PurchaseFunction']);

		echo "<script>window.alert('Success : Purchase Order Successfully Saved.')</script>";
		echo "<script>window.location='Purchase_Order.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Purchase_Order" . mysqli_error($connection) . "</p>";
	}
}

if (isset($_GET['btnAdd'])) 
{
	$cboProductID=$_GET['cboProductID'];
	$txtPurchasePrice=$_GET['txtPurchasePrice'];
	$txtPurchaseQuantity=$_GET['txtPurchaseQuantity'];

	AddProduct($cboProductID,$txtPurchasePrice,$txtPurchaseQuantity);
}

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if ($action === "remove") 
	{
		$ProductID=$_GET['ProductID'];
		RemoveProduct($ProductID);
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
	<title>Purchase Order</title>

	<script type="text/javascript" src="DatePicker/datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css"/>

</head>
<body>
<form action="Purchase_Order.php" method="get">
	
<fieldset>
<legend>Purchase Order Form</legend>
<table>
<tr>
	<td>
		<table>
		<tr>
			<td>PO Number</td>
			<td>
				<input type="text" name="txtPurchaseOrderID" value="<?php echo AutoID('purchaseorder','PurchaseOrderID','PUR-',6) ?>" readonly />
			</td>

			<td>Total Amount</td>
			<td>
				<input type="text" name="txtTotalAmount" value="<?php echo CalculateTotalAmount() ?>" readonly /> USD
			</td>

		</tr>

		<tr>
			<td>PO Date</td>
			<td>
				<input type="text" name="txtPurchaseOderDate" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly />
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
			<td>Product Code</td>
			<td>
				<select name="cboProductID">
					<option>Choose Product</option>
					<?php  
					$ProductQuery="SELECT * FROM product";
					$Product_ret=mysqli_query($connection,$ProductQuery);
					$Product_count=mysqli_num_rows($Product_ret);

					for($i=0;$i<$Product_count;$i++) 
					{ 
						$arr=mysqli_fetch_array($Product_ret);
						$ProductID=$arr['ProductID'];
						$ProductName=$arr['ProductName'];

						echo "<option value='$ProductID'>$ProductID ~ $ProductName</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Puchase Price</td>
			<td>
				<input type="number" name="txtPurchasePrice" value="0" /> USD
			</td>
		</tr>
		<tr>
			<td>Puchase Quantity</td>
			<td>
				<input type="number" name="txtPurchaseQuantity" value="0" /> Pcs
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
<legend>Purchase Details :</legend>

<?php  
if(!isset($_SESSION['PurchaseFunction'])) 
{
	echo "<p>No Purchase Details Found.</p>";
	exit();
}
?>

<table border="1">
<tr>
	<th>Image</th>
	<th>ProductID</th>
	<th>ProductName</th>
	<th>PurchasePrice (USD)</th>
	<th>PurchaseQty (pcs)</th>
	<th>Sub-Total (USD)</th>
	<th>Action</th>
</tr>
<?php  
$Pcount=count($_SESSION['PurchaseFunction']);

for($i=0; $i<$Pcount;$i++) 
{ 
	$ProductID=$_SESSION['PurchaseFunction'][$i]['ProductID'];
	$ProductImage1=$_SESSION['PurchaseFunction'][$i]['ProductImage1'];
	$ProductName=$_SESSION['PurchaseFunction'][$i]['ProductName'];
	$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['PurchasePrice'];
	$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['PurchaseQuantity'];
	$SubTotal=$PurchasePrice * $PurchaseQuantity;

	echo "<tr>";
	echo "<td><img src='$ProductImage1' width='50px' height='50px'/></td>";
	echo "<td>$ProductID</td>";
	echo "<td>$ProductName</td>";
	echo "<td>$PurchasePrice</td>";
	echo "<td>$PurchaseQuantity</td>";
	echo "<td>$SubTotal</td>";
	echo "<td>
		  <a href='Purchase_Order.php?action=remove&ProductID=$ProductID'>Remove</a>
		  </td>";
	echo "</tr>";
}
?>
	<tr>
		<td colspan="7">
		<b>SupplierID :</b>
		<select name="cboSupplierID">
			<option>Choose Supplier ID</option>
			<option value="1">M9 Group of Companies</option>
			<option value="2">Giordano Retail Shop</option>
		</select>

		<input type="submit" name="btnSave" value="Save" />
		<a href="Purchase_Order.php?action=clearall">Empty Purchase Cart</a> | 
		<a href="Staff_Home.php">Back >> </a>
		</td>
	</tr>
</table>


</fieldset>

</form>
</body>
</html>