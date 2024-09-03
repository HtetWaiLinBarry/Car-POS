<?php 

include('carconnect.php');

 ?>
 <form>
 	<table border="1" width=100% align="center">
 		<tr>
 			<th>CustomerID</th>
 			<th>FirstName</th>
			<th>LastName</th>
			<th>Address</th>
			<th>Password</th>
			<th>Email</th>
			<th>NRC</th>
			<th>LicenseNo</th>
			<th>Gender</th>
			<th>Phone</th>
 		</tr>
 		<?php 
 		$select=mysqli_query($connection,"SELECT * FROM Customer");
 		$count=mysqli_num_rows($select);
 		for($i=0; $i < $count; $i++) {
 			$data=mysqli_fetch_array($select);
 			$ocid=$data['CustomerID'];
 			$ocfname=$data['FirstName'];
 			$oclname=$data['LastName'];
 			$ocadd=$data['Address'];
 			$ocpw=$data['Password'];
 			$ocemail=$data['Email'];
 			$ocnrc=$data['NRC'];
 			$oclicense=$data['LicenseNo'];
 			$ocgender=$data['Gender'];
 			$ocphone=$data['PhoneNo'];
 			echo "<tr>";
 			echo "<td>$ocid</td>";
 			echo "<td>$ocfname</td>";
 			echo "<td>$oclname</td>";
 			echo "<td>$ocadd</td>";
 			echo "<td>$ocpw</td>";
 			echo "<td>$ocemail</td>";
 			echo "<td>$ocnrc</td>";
 			echo "<td>$oclicense</td>";
 			echo "<td>$ocgender</td>";
 			echo "<td>$ocphone</td>";
 			echo "<td> 			
 			<a href='CustomerUpdateO.php?ocid=$ocid'>Update</a> /
 			<a href='CustomerDelete.php?ocid=$ocid'>Delete</a>
 			</td>";
 			echo "</tr>";
 		}


 		 ?>
 	</table>
 </form>
