<?php  
session_start();
include('carconnect.php');
include('AutoID_Functions.php');
include('ImportRegisterFunctions.php');

if(isset($_POST['btnSearch'])) 
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if ($rdoSearchType == 1) 
	{
		$cboImportID=$_POST['cboImportID'];

		$query="SELECT id.*, co.CompanyID, co.CompanyName
				FROM Import id, Company co
				WHERE id.ImportID='$cboImportID'
				AND id.CompanyID=co.CompanyID
				";
		$result=mysqli_query($connection,$query);
	}
	elseif ($rdoSearchType == 2) 
	{
		$From=date('Y-m-d',strtotime($_POST['txtFrom']));
		$To=date('Y-m-d',strtotime($_POST['txtTo']));

		$query="SELECT id.*, co.CompanyID, co.CompanyName
				FROM Import id, Company co
				WHERE id.ImportDate 
				BETWEEN '$From' AND '$To'
				AND id.CompanyID=co.CompanyID
				";
		$result=mysqli_query($connection,$query);
	}
	else
	{
		$cboStatus=$_POST['cboStatus'];

		$query="SELECT id.*, co.CompanyID, co.CompanyName
				FROM Import id, Company co
				WHERE id.Status='$cboStatus'
				AND id.CompanyID=co.CompanyID
				";
		$result=mysqli_query($connection,$query);
	}
}
elseif(isset($_POST['btnShowAll']))
{
	$query="SELECT id.*, co.CompanyID, co.CompanyName
				FROM Import id, Company co
				WHERE id.CompanyID=co.CompanyID
				";
	$result=mysqli_query($connection,$query);
}
else
{
	$today=date('Y-m-d');

	$query="SELECT id.*, co.CompanyID, co.CompanyName
				FROM Import id, Company co
				WHERE id.ImportDate='$today'
				AND id.CompanyID=co.CompanyID
				";
	$result=mysqli_query($connection,$query);
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Import List</title>
	<script type="text/javascript" src="DatePicker/datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css"/>
</head>
<body>
<form action="ImportListDash.php" method="post">
<table border="1">
<tr>
	<td>
	<input type="radio" name="rdoSearchType" value="1" checked />Search by Import_ID: <br/>
	<select name="cboImportID">
		<option>Choose Import ID</option>
		<?php  
		$IN_Query="SELECT * FROM Import";
		$IN_ret=mysqli_query($connection,$IN_Query);
		$IN_count=mysqli_num_rows($IN_ret);

		for($i=0;$i<$IN_count;$i++) 
		{ 
			$IN_arr=mysqli_fetch_array($IN_ret);
			$ImportID=$IN_arr['ImportID'];

			echo "<option value='$ImportID'>$ImportID</option>";
		}
		?>
	</select>
	</td>

	<td>
	<input type="radio" name="rdoSearchType" value="2" />Search by Import_Date: <br/>
	From <input type="text" name="txtFrom" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" />
	To	<input type="text" name="txtTo" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" />
	</td>

	<td>
	<input type="radio" name="rdoSearchType" value="3" />Search by Status: <br/>
	<select name="cboStatus">
		<option>Pending</option>
		<option>Confirmed</option>
	</select>
	</td>

	<td>
	<br/>
	<input type="submit" name="btnSearch" value="Search" />
	<input type="submit" name="btnShowAll" value="Show All" />
	<input type="reset" value="Clear" />
	</td>
</tr>
</table>

<hr/>

<fieldset>
<legend>Import Form Results:</legend>
<?php  
$count=mysqli_num_rows($result);

if ($count < 1) 
{
	echo "<p>No Data Found.</p>";
	exit();
}
?>

<table border="1" cellpadding="5px">
<tr>
	<th>Import ID</th>
	<th>Import Date</th>
	<th>Company Name</th>
	<th>Total Amount</th>
	<th>Grand Total</th>
	<th>Status</th>
	<th>Action</th>
</tr>
<?php 
	for ($i=0;$i<$count;$i++) 
	{ 
		$rows=mysqli_fetch_array($result);
		$ImportID=$rows['ImportID'];
		echo "<tr>";
		echo "<td>" . $rows['ImportID'] ."</td>";
		echo "<td>" . $rows['ImportDate'] ."</td>";
		echo "<td>" . $rows['CompanyName'] ."</td>";
		echo "<td>" . $rows['TotalAmount'] ."</td>";
		echo "<td>" . $rows['GrandTotal'] ."</td>";
		echo "<td>" . $rows['Status'] ."</td>";
		echo "</tr>";
	}

?>
</table>

</fieldset>


</form>
</body>
</html>