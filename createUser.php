<?php
	require 'adminLoggedIn.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['name']) && !empty($_POST['name'])) {
			$name = $_POST['name'];
		} else {
			$errors[] = 'Name is required';
		}
		if (isset($_POST['username']) && !empty($_POST['username'])) {
			$username = $_POST['username'];
		} else {
			$errors[] = 'A username is required';
		}
		if (isset($_POST['password']) && !empty($_POST['password'])) {
			$password = $_POST['password'];
		} else {
			$errors[] = 'A password is required';
		}

		if (!isset($errors)) {
			//quiz fine so far
			include 'db.include';

			//create new test

			$sql = 'INSERT INTO Users (Username, Password, Name) VALUES (?, ?, ?)';
			$query = $PDO->prepare($sql);
			$query->bindParam(1, $username);
			$query->bindParam(2, $password);
			$query->bindParam(3, $name);
			$query->execute();

			$success = true;

			if (isset($_GET['redirect'])) {
				header("Location: users.php");
				die();
			}

		}

	}




?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Test</title>
</head>
<body>
<?php if (isset($errors) && !empty($errors)) { ?>
	<?php foreach ($errors as $error) { ?>
		<span class="error"><?php echo $error; ?></span><br>
	<?php } ?>
<?php }?>
<?php if (isset($success) && $success) { ?>
	<span class="success">User created</span><br>
<?php }?>
<form method="POST" id="mainForm">
	<label for="name">Name: </label><input type="text" name="name"/><br>
	<label for="description">Username: </label><input type="text" name="username"/><br>
	<label for="description">Password: </label><input type="text" name="password"/>
	<input type="button" value="generate password" id="generate_password"/><br>

	<input type="submit" value="save & continue" onClick="submitForm('createUser.php')"/>
 	<input type="submit" value="save & exit" onClick="submitForm('createUser.php?redirect=1')"/>
 	
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function submitForm(action) {
	$("#mainForm")[0].action = action;
	$("#mainForm")[0].submit();
}
function generatePassword(){
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

	$("#generate_password").on("click", function(){
		$("input[name=password]").val(generatePassword());
	});

</script>
</body>
</html>