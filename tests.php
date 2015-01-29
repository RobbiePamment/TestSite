<?php
	include 'db.include';

	$sql = 'SELECT * FROM `Tests`';
	$query = $PDO->query($sql);
	$query->execute();
	$results = $query->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quizes</title>
</head>
<body>
<?php include "menu.include"; ?>
<a href="createTest.php">Create new test</a>
<br>
<br>
<table>
	<tr>
		<th>Test title</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach($results as $test) { ?>
		<tr>
			<td><?php echo $test['Name']; ?></td>
			<td><a href="editTest.php?id=<?php echo $test['TID'];?>"><div class="accept-button">View results</div></a></td>
			<td><a href="editTest.php?id=<?php echo $test['TID'];?>"><div class="accept-button">Edit</div></a></td>
			<td><a href="deleteTest.php?id=<?php echo $test['TID'];?>"><div class="cancel-button">Delete</div></a></td>
		</tr>
	<?php } ?>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
	$(".cancel-button").on("click", function(){
		answer = confirm("are you sure you want to delete this Test");
		if (answer===false) {
			return false;
		}
	});
</script>
</body>
</html>
