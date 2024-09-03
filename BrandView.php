<?php 

include('carconnect.php');

 ?>
 <form>
 	<table border="1" width=100% align="center">
 		<tr>
 			<th>BrandID</th>
 			<th>BrandName></th>
 			<th>BrandDetails</th>
 			<th>BrandDate</th>
 		</tr>
 		<?php 
 		$select=mysqli_query($connection,"SELECT * FROM Brand");
 		$count=mysqli_num_rows($select);
 		for($i=0; $i < $count; $i++) {
 			$data=mysqli_fetch_array($select);
 			$bid=$data['BrandID'];
 			$bname=$data['BrandName'];
 			$bdetails=$data['BrandDetails'];
 			$bdate=$data['BrandDate'];
 			echo "<tr>";
 			echo "<td>$bid</td>";
 			echo "<td>$bname</td>";
 			echo "<td>$bdetails</td>";
 			echo "<td>$bdate</td>";
 			echo "<td>
 			<a href='BrandUpdate.php?bid=$bid'>Update</a> /
 			<a href='BrandDelete.php?bid=$bid'>Delete</a>
 			</td>";
 			echo "</tr>";
 		}


 		 ?>
 	</table>
 </form>
