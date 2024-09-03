<?php 	
session_start();
include('carconnect.php');
include('shoppingcartfunction.php');
include('header.php');



	if(isset($_REQUEST[0]))
	{
			$VID=$_REQUEST['VehicleID'];	
			$select=mysqli_query($connection,"SELECT v.*,s.*,bt.*,b.*,c.* FROM Vehicle v,Sales s, BrandType bt,Brand b
			WHERE s.VehicleID=v.VehicleID  
			AND bt.BrandID=b.BrandID 
			AND VehicleID=$VID");
			$row=mysqli_fetch_array($select);
			$VehicleName=$row['VehicleName'];
			$VehicleImage=$row['VehicleImage'];
			$Price=$row['VehiclePrice'];
			$BrandType=$row['BrandType'];
			$BrandTypeID=$row['BrandTypeID'];
			$Quantity=$row['Quantity'];

	if(isset($_POST['btnpurchase']))
	{
		$txtVehicleID = $_POST['txtVehicleID'];
    	$Quantity=$_POST['txtquantity'];
		AddtoCart($txtVehicleID,$Quantity);

	}
}
?>                           
<html>
<head>
	<title>	</title>
</head>
<body>
		<form action="" method="POST" enctype="multipart/form-data">
    			<input type="hidden" name="txtVehicleID" value="<?php echo $row['VehicleID'] ?>" readonly>
				<input type="hidden" name="txtprice" value="<?php 	echo $Price ?>">	
				<input type="hidden" name="txtVehicleID" value="<?php 	echo $VID ?>">	
				<table>	
						<tr>	
								<td>
									<img src="<?php echo $VehicleImage ?>" width="400px" height="400px">	
							
								</td>
								<td>	
										<table width="440px" height="300px">	
												<tr>	
														<td> Vehicle Name	</td>
														<td>	:<?php 	echo $VehicleName ?></td>	
												</tr>	
												<tr>	
														<td> Price	</td>
														<td>	:<?php 	echo $Price ?></td>
												</tr>
												<tr>	
														<td>	BrandType</td>
														<td>	:<?php 	echo $BrandType ?></td>	
												</tr>
												<tr>	
														<td>	Quantity </td>
														<td>	<?php 	echo $Quantity ?></td>	
												</tr>
												



										</table>

								</td>
						</tr>	
				</table>	
				<table align="center" width="400px" height="100px" border="1px">
						<tr>
							<td>Purchase Quantity :</td>
   							<td><input type="number" class="form-control" name="txtquantity"></td>
						</tr>        
						<tr>	
								<td>	Purchase Date</td>
								<td>	: <?php 	echo date('d-M-Y') ?></td>
						</tr>	
						<tr>
								<td> Vehicle Name</td>
								<td>:<?php echo $VehicleName ?></td>
						</tr>	
						
						
							 		
	<tr>
		<td>						 			
	<input type="submit" value="Purchase Confirm" name="btnpurchase">	
		</td>					 			
	</tr>						 		
				</table>
		</form>
</body>
</html>
<?php  
include('footer.php');
?>