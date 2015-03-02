<?php 
	require 'adminLoggedIn.php';
	include 'db.include';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = 'UPDATE Users SET Username=?, Password=?, Name=? WHERE UID=?';
		$query = $PDO->prepare($sql);
		$query->bindParam(1, $username);
		$query->bindParam(2, $password);
		$query->bindParam(3, $name);
		$query->bindParam(4, $id);
		$query->execute();

		if (isset($_GET['redirect'])) {
			header("Location: users.php");
			die();
		}
	}

	if (!isset($_GET['id']) || empty($_GET['id'])) {
		header("Location: users.php");
		die();
	} else {
		$id = $_GET['id'];
		$sql = 'SELECT * FROM `Users` WHERE `UID` = ?';
		$query = $PDO->prepare($sql);
		$query->bindParam(1, $id);
		$query->execute();
		$results = $query->fetchAll();

		$name = $results[0]['Name'];
		$username = $results[0]['Username'];
		$password = $results[0]['Password'];
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<?php include "menu.include"; ?>
 	<form method="POST" id="mainForm">
 	<input type="hidden" name="id" value="<?php echo $id;?>"/>
 	<label>Name: </label><span class="input_cover"><?php echo $name; ?></span><input type="hidden" name="name" value="<?php echo $name; ?>"/><br/>
 	<label>Username: </label><span class="input_cover"><?php echo $username; ?></span><input type="hidden" name="username" value="<?php echo $username; ?>"/><br/>
 	<label>Password: </label><span class="input_cover"><?php echo $password; ?></span><input type="hidden" name="password" value="<?php echo $password; ?>"/><br/>
 	<input type="submit" value="save & continue" onClick="submitForm('editUser.php?id=<?php echo $id?>')"/>
 	<input type="submit" value="save & exit" onClick="submitForm('editUser.php?id=<?php echo $id?>&redirect=1')"/>
 	</form>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script type="text/javascript">
 function submitForm(action) {
 	$("#mainForm")[0].action = action;
 	$("#mainForm")[0].submit();
 }

 $(".input_cover").on("click", function(){
 	$(this).css("display", "none");
 	$(this).next("input").attr("type", "text")
 });
 </script>
 </body>
 </html>