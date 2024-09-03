<?php
function AddtoCart($VehicleID,$qty)
{ 
  include('carconnect.php');
  $sql="SELECT * FROM Vehicle WHERE VehicleID='$VehicleID'";
  $ret=mysqli_query($connection,$sql);
  $data=mysqli_fetch_array($ret);
  $vname=$data['VehicleName'];
  $vprice=$data['VehiclePrice'];
  $qty=$data['Quantity'];
  $CustomerID=$data['CustomerID'];


  if(!isset($_SESSION['ShoppingCart']))
  {

    $_SESSION['ShoppingCart']=array();

    $_SESSION['ShoppingCart'][0]['VehicleID']=$VehicleID;
    $_SESSION['ShoppingCart'][0]['VehicleName']=$VehicleName;
    $_SESSION['ShoppingCart'][0]['Quantity']=$qty;
    $_SESSION['ShoppingCart'][0]['VehiclePrice']=$vprice;
    $_SESSION['ShoppingCart'][0]['Amount']=$price*$qty;
    $_SESSION['ShoppingCart'][0]['CustomerID']=$CustomerID;
   }
  else
  {

    $count=count($_SESSION['ShoppingCart']);
    if($count==0)
    {
      $_SESSION['ShoppingCart'][0]['VehicleID']=$VehicleID;
      $_SESSION['ShoppingCart'][0]['VehicleName']=$VehicleName;
      $_SESSION['ShoppingCart'][0]['Quantity']=$qty;
      $_SESSION['ShoppingCart'][0]['VehiclePrice']=$vprice;
      $_SESSION['ShoppingCart'][0]['Amount']=$price*$qty;
      $_SESSION['ShoppingCart'][0]['CustomerID']=$CustomerID;
    }
    else
    {
      $check=RIndexOf($VehicleID);
      if($check==-1)
      {
        $lastindex=count($_SESSION['ShoppingCart']);

        $_SESSION['ShoppingCart'][$lastindex]['VehicleID']=$VehicleID;
        $_SESSION['ShoppingCart'][$lastindex]['VehicleName']=$vname;
        $_SESSION['ShoppingCart'][$lastindex]['Quantity']=$qty;
        $_SESSION['ShoppingCart'][$lastindex]['VehiclePrice']=$vprice;
        $_SESSION['ShoppingCart'][$lastindex]['Amount']=$vprice*$qty;
        $_SESSION['ShoppingCart'][$lastindex]['CustomerID']=$CustomerID;
      }
      else
      {
        $_SESSION['ShoppingCart'][$check]['OrderQty']+=$qty;
        $_SESSION['ShoppingCart'][$check]['Amount']+=$qty*$vprice;
      }
    }
  }
  echo "<script>
    alert('Vehicle Added');
    location.assign('ShoppingCart.php');
  </script>";
}
  function RIndexOf($VehicleID)
      {
        for($i=0;$i<count($_SESSION['ShoppingCart']);$i++)
        {
          if($VehicleID==$_SESSION['ShoppingCart'][$i]['VehicleID'])
          {
            return $i;
          }
        }
        return -1;
      }

  function clearShoppingCart()
    {
      unset($_SESSION['ShoppingCart']);
    }
function netamount()
  { 
      $sum=calculateTotal()+calculateTax();
      return $sum;

  }
  function calculateTotal()
    {
      $sum=0;
      for($i=0;$i<count($_SESSION['ShoppingCart']);$i++)
      {
        $sum+=$_SESSION['ShoppingCart'][$i]['Amount'];
      }
      return $sum;
    }
  function calculateTax()
    {
      $total=calculateTotal();
      $tax=$total*0.05;
      return $tax;
    }
  function Remove($VehicleID)
    {
      $index=RIndexOf($VehicleID);
      if ($index != -1) 
      {
        unset($_SESSION['ShoppingCart'][$index]);
        $_SESSION['ShoppingCart']=array_values($_SESSION['ShoppingCart']);
      }
      echo "<script>window.location='ShoppingCart.php'</script>";
    }
  function Clear()
    {
      unset($_SESSION['ShoppingCart']);
      echo "<script>window.location='ShoppingCart.php'</script>";
    }  
?>