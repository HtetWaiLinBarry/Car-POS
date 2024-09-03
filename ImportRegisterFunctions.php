<?php
function AddVehicle($VehicleID,$ImportPrice,$ImportQuantity)
{
	include('carconnect.php');
	$query="SELECT * FROM Vehicle WHERE VehicleID='$VehicleID'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);

	if ($count < 1) 
	{
		return false;
	}

	$row=mysqli_fetch_array($ret);

	$VehicleName=$row['VehicleName'];
	$VehiclePrice=$row['VehiclePrice'];


	if(isset($_SESSION['ImportFunction'])) 
	{
		$Index=Indexof($VehicleID);
	
		if ($Index == -1) 
		{
			$size=count($_SESSION['ImportFunction']);

			$_SESSION['ImportFunction'][$size]['VehicleID']=$VehicleID;
			$_SESSION['ImportFunction'][$size]['VehicleName']=$VehicleName;
			$_SESSION['ImportFunction'][$size]['VehiclePrice']=$VehiclePrice;
			$_SESSION['ImportFunction'][$size]['ImportPrice']=$ImportPrice;
			$_SESSION['ImportFunction'][$size]['ImportQuantity']=$ImportQuantity;
		}
		else
		{
			$_SESSION['ImportFunction'][$Index]['ImportQuantity']+=$ImportQuantity;
		}
	}
	else
	{
		$_SESSION['ImportFunction']=array();

		$_SESSION['ImportFunction'][0]['VehicleID']=$VehicleID;
		$_SESSION['ImportFunction'][0]['VehicleName']=$VehicleName;
		$_SESSION['ImportFunction'][0]['VehiclePrice']=$VehiclePrice;
		$_SESSION['ImportFunction'][0]['ImportPrice']=$ImportPrice;
		$_SESSION['ImportFunction'][0]['ImportQuantity']=$ImportQuantity;
	}

	echo "<script>window.location='Import_Register.php'</script>";
}

function RemoveVehicle($VehicleID)
{
	$index=Indexof($VehicleID); 
	unset($_SESSION['ImportFunction'][$index]);
	$_SESSION['ImportFunction']=array_values($_SESSION['ImportFunction']);

	echo "<script>window.location='Import_Register.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['ImportFunction']);

	echo "<script>window.location='Import_Register.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;
	$size=count($_SESSION['ImportFunction']);

	for($i=0; $i<$size;$i++) 
	{ 
		$ImportPrice=$_SESSION['ImportFunction'][$i]['ImportPrice'];
		$ImportQuantity=$_SESSION['ImportFunction'][$i]['ImportQuantity'];
		$TotalAmount += ($ImportPrice * $ImportQuantity);
	}

	return $TotalAmount;
}

function CalculateTotalQty()
{
	$TotalQty=0;
	$size=count($_SESSION['ImportFunction']);

	for($i=0; $i<$size;$i++) 
	{ 
		$ImportQuantity=$_SESSION['ImportFunction'][$i]['ImportQuantity'];
		$TotalQty += $ImportQuantity;
	}

	return $TotalQty;
}

function CalculateTax()
{
	$VAT=0;

	$VAT=CalculateTotalAmount() * 0.05;

	return $VAT;
}

function Indexof($VehicleID)
{
	if(!isset($_SESSION['ImportFunction'])) 
	{
		return -1;
	}

	$count=count($_SESSION['ImportFunction']);

	if ($count < 1) 
	{
		return -1;
	}

	for ($i=0;$i<$count;$i++) 
	{ 
		if ($VehicleID == $_SESSION['ImportFunction'][$i]['VehicleID']) 
		{
			return $i;
		}
	}

	return -1;
}
?>