<?php 

include('carconnect.php');

 ?>
 <form>
 	<table border="1" width=100% align="center">
 		<tr>
 			<th>Staff ID</th>
			<th>Staff Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Staff Password</th>
			<th>Center</th>
			<th>Position</th>
 		</tr>
 		<?php 
 		$select=mysqli_query($connection,"SELECT * FROM Staff");
 		$count=mysqli_num_rows($select);
 		for($i=0; $i < $count; $i++) {
 			$data=mysqli_fetch_array($select);
 			$osid=$data['StaffID'];
 			$osname=$data['StaffName'];
 			$osphone=$data['Phone'];
 			$osemail=$data['Email'];
 			$ospassword=$data['StaffPassword'];
 			$oscenter=$data['Center'];
 			$osposition=$data['Position'];
 			$osstaffimage=$data['StaffImage'];
 			echo "<tr>";
 			echo "<td>$osid</td>";
 			echo "<td>$osname</td>";
 			echo "<td>$osphone</td>";
 			echo "<td>$osemail</td>";
 			echo "<td>$ospassword</td>";
 			echo "<td>$oscenter</td>";
 			echo "<td>$osposition</td>";
 			echo "<td>$osstaffimage</td>";
 			echo "<td> 			
 			<a href='StaffUpdate.php?osid=$osid'>Update</a> /
 			<a href='StaffDelete.php?osid=$osid'>Delete</a>
 			</td>";
 			echo "</tr>";
 		}


 		 ?>
 	</table>
 </form>
