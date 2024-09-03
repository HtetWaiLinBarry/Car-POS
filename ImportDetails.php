<?php  
session_start();
include('carconnect.php');
include('AutoID_Functions.php');
include('ImportRegisterFunctions.php');

if(isset($_POST['btnConfirm'])) 
{
	$txtPurchaseOrderID=$_POST['txtImportID'];

	$query=mysqli_query($connection, "SELECT * FROM ImportDetails WHERE ImportID='$txtImportID'");

	while($row=mysqli_fetch_array($query)) 
	{
		$VehicleID=$row['VehicleID'];
		$Quantity=$row['Quantity'];

		$UpdateQty="UPDATE Vehicle
					SET Quantity= Quantity + '$Quantity'
					WHERE VehicleID='$VehicleID'
					";
		$ret=mysqli_query($connection,$UpdateQty);
	}

	$UpdateStatus="UPDATE Import
				   SET Status='Confirmed'
				   WHERE ImportID='$txtImportID'";
	$ret=mysqli_query($connection,$UpdateStatus);

	if($ret) //True
	{
		echo "<script>window.alert('SUCCESS : Import Order Successfully Confirmed.')</script>";
		echo "<script>window.location='ImportList.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Import Details" . mysqli_error($connection) . "</p>";
	}


}

if (isset($_GET['ImportID'])) 
{
	$ImportID=$_GET['ImportID'];
	
	$query1="SELECT id.*, co.CompanyID, co.CompanyName, s.StaffID,s.StaffName
			FROM Import id, Company co, staff s
			WHERE id.CompanyID=co.CompanyID
			AND id.StaffID=s.StaffID
			AND id.ImportID='$ImportID'
			";
	$result1=mysqli_query($connection,$query1);
	$row1=mysqli_fetch_array($result1);

	$query2="SELECT id.*, ipd.*, v.VehicleID, v.VehicleName
			FROM Import id, ImportDetails ipd, Vehicle v
			WHERE id.ImportID=ipd.ImportID
			AND ipd.VehicleID=v.VehicleID
			";
	//echo $query2;
	$result2=mysqli_query($connection,$query2);
	$count=mysqli_num_rows($result2);

}
else
{
	$ImportID="";

	echo "<script>window.alert('ERROR : Import Order Details not Found.')</script>";
	echo "<script>window.location='ImportList.php'</script>"; 
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Import Details</title>
</head>
<body>
<form action="ImportDetails.php" method="post">

<fieldset>
<legend>Import Order Detail Report for ImportID : <?php echo $ImportID ?></legend>

<table align="center" border="1" cellpadding="5px">
<tr>
	<td>Import_ID</td>
	<td><b><?php echo $ImportID ?></b></td>
	<td>Status</td>
	<td><b><?php echo $row1['Status'] ?></b></td>
</tr>
<tr>
	<td>Import Date</td>
	<td><b><?php echo $row1['ImportDate'] ?></b></td>
	<td>Report Date</td>
	<td><b><?php echo date('Y-m-d') ?></b></td>
</tr>
<tr>
	<td>Company Name</td>
	<td><b><?php echo $row1['CompanyName'] ?></b></td>
	<td>StaffName</td>
	<td><b><?php echo $row1['StaffName'] ?></b></td>
</tr>

<tr>
	<td colspan="4">
		<table align="center" border="1">
			<tr>
				<th>VehicleName</th>
				<th>Import_Price</th>
				<th>Import_Quantity</th>
				<th>Sub-Total</th>
			</tr>
			<?php  
			for ($i=0; $i < $count ; $i++) 
			{ 
				$row2=mysqli_fetch_array($result2);
				echo "<tr>";
				echo "<td>" . $row2['VehicleName'] ."</td>";
				echo "<td>" . $row2['ImportPrice'] ."</td>";
				echo "<td>" . $row2['ImportQuantity'] ."</td>";
				echo "<td>" . ($row2['GrandTotal'] * $row2['ImportQuantity']) ."</td>";
				echo "</tr>";
			}

			?>
		</table>
	</td>
</tr>

<tr>
	<td colspan="4" align="right">
	Total Amount : <b><?php echo $row1['TotalAmount'] ?> USD</b> <br/>
	Tax Amount (VAT) : <b><?php echo $row1['TaxAmount'] ?> USD</b> <br/>
	GrandTotal : <b><?php echo $row1['GrandTotal'] ?> USD</b> <br/>
	Total Quantity : <b><?php echo $row1['TotalQuantity'] ?> Pcs</b> 
	</td>
</tr>

<tr>
	<td colspan="4" align="right">
	<input type="hidden" name="txtImportID" value="<?php echo $ImportID ?>" />
	<?php  
	if ($row1['Status'] === "Pending") 
	{
		echo "<input type='submit' name='btnConfirm' value='Comfirm'/>";
	}
	else
	{
		echo "<input type='submit' name='btnConfirm' value='Comfirm' disabled/>";
	}
	?>
	<!---Print--->
	<script>var pfHeaderImgUrl = '';var pfHeaderTagline = 'Order%20Report';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>
	<a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onClick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
	<!---Print--->

	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>