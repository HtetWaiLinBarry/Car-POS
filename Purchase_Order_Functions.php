<?php
function AddProduct($ProductID,$PurchasePrice,$PurchaseQuantity)
{
	include('connect.php');
	$query="SELECT * FROM Product WHERE ProductID='$ProductID'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);

	if ($count < 1) 
	{
		return false;
	}

	$row=mysqli_fetch_array($ret);

	$ProductName=$row['ProductName'];
	$ProductImage1=$row['ProductImage1'];


	if(isset($_SESSION['PurchaseFunction'])) 
	{
		$Index=Indexof($ProductID);
	
		if ($Index == -1) 
		{
			$size=count($_SESSION['PurchaseFunction']);

			$_SESSION['PurchaseFunction'][$size]['ProductID']=$ProductID;
			$_SESSION['PurchaseFunction'][$size]['ProductName']=$ProductName;
			$_SESSION['PurchaseFunction'][$size]['ProductImage1']=$ProductImage1;
			$_SESSION['PurchaseFunction'][$size]['PurchasePrice']=$PurchasePrice;
			$_SESSION['PurchaseFunction'][$size]['PurchaseQuantity']=$PurchaseQuantity;
		}
		else
		{
			$_SESSION['PurchaseFunction'][$Index]['PurchaseQuantity']+=$PurchaseQuantity;
		}
	}
	else
	{
		$_SESSION['PurchaseFunction']=array();

		$_SESSION['PurchaseFunction'][0]['ProductID']=$ProductID;
		$_SESSION['PurchaseFunction'][0]['ProductName']=$ProductName;
		$_SESSION['PurchaseFunction'][0]['ProductImage1']=$ProductImage1;
		$_SESSION['PurchaseFunction'][0]['PurchasePrice']=$PurchasePrice;
		$_SESSION['PurchaseFunction'][0]['PurchaseQuantity']=$PurchaseQuantity;
	}

	echo "<script>window.location='Purchase_Order.php'</script>";
}

function RemoveProduct($ProductID)
{
	$index=Indexof($ProductID); 
	unset($_SESSION['PurchaseFunction'][$index]);
	$_SESSION['PurchaseFunction']=array_values($_SESSION['PurchaseFunction']);

	echo "<script>window.location='Purchase_Order.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['PurchaseFunction']);

	echo "<script>window.location='Purchase_Order.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;
	$size=count($_SESSION['PurchaseFunction']);

	for($i=0; $i<$size;$i++) 
	{ 
		$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['PurchasePrice'];
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['PurchaseQuantity'];
		$TotalAmount += ($PurchasePrice * $PurchaseQuantity);
	}

	return $TotalAmount;
}

function CalculateTotalQty()
{
	$TotalQty=0;
	$size=count($_SESSION['PurchaseFunction']);

	for($i=0; $i<$size;$i++) 
	{ 
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['PurchaseQuantity'];
		$TotalQty += $PurchaseQuantity;
	}

	return $TotalQty;
}

function CalculateTax()
{
	$VAT=0;

	$VAT=CalculateTotalAmount() * 0.05;

	return $VAT;
}

function Indexof($ProductID)
{
	if(!isset($_SESSION['PurchaseFunction'])) 
	{
		return -1;
	}

	$count=count($_SESSION['PurchaseFunction']);

	if ($count < 1) 
	{
		return -1;
	}

	for ($i=0;$i<$count;$i++) 
	{ 
		if ($ProductID == $_SESSION['PurchaseFunction'][$i]['ProductID']) 
		{
			return $i;
		}
	}

	return -1;
}
?>