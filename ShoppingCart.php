<?php 
session_start();
  include('shoppingcartfunction.php');
  include('AutoID_Functions.php');
  include('carconnect.php');
  include('header.php');
  if (isset($_POST['btncheckout']))
  {
    $SalesID=AutoID('Sales','SalesID','SA_',4);
    $SalesDate=date('Y-m-d');
    $StaffID=$_SESSION['StaffID'];
    $VehicleID=$_SESSION['VehicleID'];
    $CustomerID=$_SESSION['CustomerID'];
    $PurchaseAmount=calculateTotal();
    $taxamount=calculateTax();
    $netamount=netAmount();
    $paymenttype=$_POST['rdopaymenttype'];
    $insert="INSERT into Sales
            values('$SalesID','$SalesDate','$StaffID','$VehicleID','$CustomerID','$PurchaseAmount','$taxamount','$netamount','$paymenttype')";
    $run=mysqli_query($connection,$insert);

    $count=count($_SESSION['ShoppingCart']);
    
     for($i=0;$i<$count;$i++)
      {
         $vid=$_SESSION['ShoppingCart'][$i]['VehicleID'];
         $price=$_SESSION['ShoppingCart'][$i]['VehiclePrice'];
         $quantity=$_SESSION['ShoppingCart'][$i]['Quantity'];

         $insert="INSERT into SalesDetail values('$SalesDetailID','$vid','$price','$quantity')";
         $run1=mysqli_query($connection,$insert);
      }   
         if($run1)
         {
           $update="UPDATE Vehicle
                    set Quantity=Quantity-'$quantity'
                    Where VehicleID='$vid'";
           $update_run=mysqli_query($connection,$update);
           if($update_run)
           {
              clearShoppingCart();
              echo "<script>window.alert('Shopping Cart Confirm')</script>";
              echo "<script>window.location='CarDisplay.php'</script>";
           }
         }
  }
  if (isset($_REQUEST['action'])) 
  {
    $Action=$_REQUEST['action'];
    if ($Action === "removel") 
    {
        $VehicleID=$_REQUEST['VehicleID'];
        Remove($VehicleID);
    }
    else
    {
      clearShoppingCart();
    }
  }
  else
  {
    $Action="";
  }
  
 ?>
<html>
<head>
	<title></title>
</head>
<body>
   <form action="ShoppingCart.php" method="post">
     <fieldset>
       <legend>Check Out The Information</legend>
         <table>
           <tr>
             <td>Payment Type</td>
             <td>
               <input type="radio" name="rdopaymenttype" value="Cash">Cash
               <input type="radio" name="rdopaymenttype" value="Via">Via
               <input type="radio" name="rdopaymenttype" value="MPU">MPU
             </td>
           </tr>
           
           <tr>
             <td>MPU Cart No or Visa Card No(Ignore this if payment type is cash or visa)</td>
             <td><input type="text" name="txtcardno"></td>
           </tr>
           <tr>
             <td>Order Amount</td>
             <td><?php echo calculateTotal();?>MMK</td>
           </tr>
           <tr>
             <td>Tax Amount</td>
             <td><?php echo calculateTax();?>MMK</td>
           </tr>
           <tr>
             <td>Net Amount</td>
             <td><?php echo netAmount();?>MMK</td>
           </tr>
           <tr>
             <td><a href="MenuDisplay.php">Back To Vehicle Display</a></td>
             <td><input type="submit" name="btncheckout" value="Check Out/Confirm Order"></td>
           </tr>
         </table>
     </fieldset>

       <fieldset>
        <legend>My Shopping List</legend>
          <table>
            <tr>
              <th>Vehicle Name</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Amount</th>
            </tr>
            <?php 
               for($i=0;$i<count($_SESSION['ShoppingCart']);$i++)
               {
                 $MenuID=$_SESSION['ShoppingCart'][$i]['MenuID'];
                  echo "<tr>";
                  echo "<td>" . $_SESSION['ShoppingCart'][$i]['VehicleName'] . "</td>";
                  echo "<td>" . $_SESSION['ShoppingCart'][$i]['VehiclePrice'] . "</td>";
                  echo "<td>" . $_SESSION['ShoppingCart'][$i]['Quantity'] . "</td>";
                  echo "<td>" . $_SESSION['ShoppingCart'][$i]['Amount'] . "</td>";
                  echo"<td> 
                  <a href='ShoppingCarto.php?action=removel&VehicleID=$VehicleID'>Remove
                  </a>
                </td>";
                  echo "</tr>";
               }
             ?>
                                      

          </table>

       </fieldset>
   </form>
</body>
</html>
<?php
include('footer.php');
?>