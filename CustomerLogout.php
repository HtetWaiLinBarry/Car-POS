<?php  
session_start();
//session_destroy();
unset($_SESSION['CustomerID']);
unset($_SESSION['FirstName']);
unset($_SESSION['LastName']);
unset($_SESSION['Email']);
echo "<script>window.alert('Customer Logout Success')</script>";
echo "<script>window.location='CustomerLogin.php'</script>";
?>
 ?> 