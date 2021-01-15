<?php
	session_start();

	if (!empty($_SESSION['username'])) {
		session_unset();
		session_destroy();
		header('location:halamanlogin.php');
	}
?>