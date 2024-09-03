<?php 

include('carconnect.php');

 ?>
 <form>
 	<table border="1" width=100% align="center">
 		<tr>
 			<th>ImportDetailsID</th>
 			<th>ImportDate></th>
 			<th>TotalAmount</th>
 			<th>CompanyID</th>
 			<th>Status</th>
 			<th>TaxAmount</th>
 			<th>GrandTotal</th>
 			<th>StaffID</th>
 			<th>TotalQuantity</th>
 		</tr>
 		<?php 
 		$select=mysqli_query($connection,"SELECT * FROM ImportDetails");
 		$count=mysqli_num_rows($select);
 		for($i=0; $i < $count; $i++) {
 			$data=mysqli_fetch_array($select);
 			$ipdid=$data['ImportDetailsID'];
 			$ipdate=$data['ImportDate'];
 			$tamount=$data['TotalAmount'];
 			$coid=$data['CompanyID'];
 			$stat=$data['Status'];
 			$tax=$data['TaxAmount'];
 			$gamount=$data['GrandTotal'];
 			$osid=$data['StaffID'];
 			$tquan=$data['TotalQuantity'];
 			 echo "<tr>";
 			echo "<td>$ipdid</td>";
 			echo "<td>$ipdate</td>";
 			echo "<td>$tamount</td>";
 			echo "<td>$coid</td>";
 			echo "<td>$stat</td>";
 			echo "<td>$tax</td";
 			echo "<td>$gamount</td>";
 			echo "<td>$osid</td>";
 			echo "<td>$tquan</td>";
 			echo "<td>
 			<a href='ImportUpdate.php?ipdid=$ipdid'>Update</a> /
 			<a href='ImportDelete.php?ipdid=$ipdid'>Delete</a>
 			</td>";
 			echo "</tr>";
 		}


 		 ?>
 	</table>
 </form>
