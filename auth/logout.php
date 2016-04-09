<?php
	session_start();
	if(session_destroy())
	{
		unset($_SESSION['login_user']);
		// echo $_SESSION['login_user'];
		header("Location: ../index.php"); // Redirecting To Home Page
	}
?>