<?php
	require_once('Function.php');
	
	session_start();
    unset($_SESSION['user_id']);
	unset($_SESSION['cart']);
	unset($_SESSION['order']);
	Logout();
	header( "Refresh:1; url=LoginPage.php", true, 303);
	session_destroy(); 
?>
