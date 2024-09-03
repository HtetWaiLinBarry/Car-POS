<?php  
session_start();
//session_destroy();
unset($_SESSION['StaffID']);
unset($_SESSION['StaffName']);
unset($_SESSION['Email']);
echo "<script>window.alert('Staff Logout Success')</script>";
echo "<script>window.location='StaffLoginDash.php'</script>";
?>
 ?> 