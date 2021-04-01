<?php
	include_once ('includes/db_conn.php');
	include_once('registration.php');
	$query = " select * from customer " ;
	$result=  mysqli_query($query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Profile</title>
</head>
<body>
	
	<table>
		<tr>
		<th colspan="4"><h2>User Profile</h2></th>
		</tr>

		<t>
		<th> ID </th>
		<th> Name </th>
		<th> Username </th>
		<th> Address </th>
		</t> 

		<?php
		while ( $row = mysql_fetch_assoc($result)) {

		?>
		
		<tr>
			<td><?php echo $rows ['Id']; ?></td>
			<td><?php echo $rows ['Name']; ?></td>
			<td><?php echo $rows ['User_name']; ?></td>
			<td><?php echo $rows ['Address 1']; ?></td>
			<td><?php echo $rows ['Address 2']; ?></td>
		</tr>

		<?php
			}
		?>
	</table>
	
</body>
</html>