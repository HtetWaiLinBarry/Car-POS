<?php 

include('carconnect.php');

 ?>
 <form>
 	<table border="1" width=100% align="center">
 		<tr>
 			<th>CompanyID</th>
			<th>CompanyName</th>
 		</tr>
 		<?php 
 		$select=mysqli_query($connection,"SELECT * FROM Company");
 		$count=mysqli_num_rows($select);
 		for($i=0; $i < $count; $i++) {
 			$data=mysqli_fetch_array($select);
 			$ocoid=$data['CompanyID'];
 			$oconame=$data['CompanyName'];
 			echo "<tr>";
 			echo "<td>$ocoid</td>";
 			echo "<td>$oconame</td>";
 			echo "<td> 			
 			<a href='CompanyUpdate.php?ocoid=$ocoid'>Update</a> /
 			<a href='CompanyDelete.php?ocoid=$ocoid'>Delete</a>
 			</td>";
 			echo "</tr>";
 		}


 		 ?>
 	</table>
 </form>
