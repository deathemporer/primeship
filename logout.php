<?php
	//session_start();
	session_start();
	unset($_SESSION["user_id"]);    
	header("location:index.php");
?>