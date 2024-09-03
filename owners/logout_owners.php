<?php
	session_start();
	session_destroy();
	header('location:../owners/login.php');
?>