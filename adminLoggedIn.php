<?php
	session_start();
		if (!isset($_SESSION['Admin_ID'])) {
			header('Location: adminLogin.php?refer='.basename($_SERVER['PHP_SELF']));
			die();
		}
