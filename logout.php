<?php
	session_start();
	unset($_SESSION['UserId']); // remove the session variable
	session_destroy(); // destroy session
	header("Location: gaelHomePage.php");
?>