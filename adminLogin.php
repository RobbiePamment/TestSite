<?php
	include 'db.include';

	session_start();
	
	// if (isset($_GET['refer']) && !empty($_GET['refer'])) {
	// 	$refer = $_GET['refer'];
	// } else {
	// 	$refer = 'index.php';
	// }
	$refer = (isset($_GET['refer']) && !empty($_GET['refer']))? $_GET['refer'] : 'index.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['username']) && !empty($_POST['username'])) {
			$username = $_POST['username'];
		}
		if (isset($_POST['password']) && !empty($_POST['password'])) {
			$password = md5($_POST['password']);
		}
		if (isset($_POST['refer']) && !empty($_POST['refer'])) {
			$refer = md5($_POST['refer']);
		} else {
			$refer = 'index.php';
		}

		$sql = 'SELECT * FROM `AdminUser` WHERE `username`=? AND `password`=?';
		$query = $PDO->prepare($sql);
		$query->bindParam(1, $username);
		$query->bindParam(2, $password);
		$query->execute();
		$results = $query->fetchAll();

		if (empty($results)) {
			$error = 'Incorrect username or password';
		} else {
			if (sizeof($results) > 1) {
				$error = 'We\'re sorry, there was an error with the database. Please contact your server administrator [ERRCODE:1]';
			} else {
				$_SESSION['Admin_ID'] = $results[0]["AID"];
				header('Location: '. $refer);
				die();
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
</head>
<body>
<?php if (isset($error) && !empty($error)) { ?>
	<span class="error"><?php echo $error; ?></span>
<?php } ?>
<form action="adminLogin.php" method="POST">
	<label for="username">Username: </label><input type="text" name="username" text="<?php if (isset($username)) { echo $username; }?>"/><br>
	<label for="password">Password: </label><input type="password" name="password"/><br>
	<?php if (isset($refer) && !empty($refer)) { ?>
		<input type="hidden" text="<?php echo $refer; ?>" name="refer">
	<?php } ?>
	<input type="submit" text="Login"/>
</form>
</body>
</html>