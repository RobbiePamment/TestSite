<?php
	#localhost/deleteUser.php?id=1

	if (isset($_GET['id']) and !empty($_GET['id'])) {
		//id has been passed successfully
		$id = $_GET['id'];
		include 'db.include';
		$sql = 'DELETE FROM `Users` WHERE `UID`=?';
		$query = $PDO->prepare($sql);
		$query->bindParam(1, $id);
		$query->execute();
	}
	header('Location: users.php');
?>