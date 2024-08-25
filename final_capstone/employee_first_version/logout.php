<?php 
	require_once('../store.php');
	$store->employee_logout();
 	header("location:login.php");
 	?>