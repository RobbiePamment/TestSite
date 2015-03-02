<?php 
	require 'adminLoggedIn.php';
	include 'db.include';

	$sql = 'SELECT * FROM `Users`';
	$query = $PDO->query($sql);
	$query->execute();
	$results = $query->fetchAll();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<?php include "menu.include"; ?>
 	<a href="createUser.php">Create new user</a>
	<br>
	<br>
 	<table>
	<tr>
		<th>Name</th>
		<th>usernmame</th>
		<th>password</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach($results as $user) { ?>
		<tr>
			<td><?php echo $user['Name']; ?></td>
			<td><?php echo $user['Username']; ?></td>
			<td><?php echo $user['Password'];?></td>
			<td><a href="editUser.php?id=<?php echo $user['UID'];?>"><div class="accept-button">Edit</div></a></td>
			<td><a href="deleteUser.php?id=<?php echo $user['UID'];?>"><div class="cancel-button">Delete</div></a></td>
		</tr>
	<?php } ?>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
	$(".cancel-button").on("click", function(){
		answer = confirm("are you sure you want to delete this user");
		if (answer===false) {
			return false;
		}
	});
</script>
 </body>
 </html>