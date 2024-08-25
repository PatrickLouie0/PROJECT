<?php 
	require_once('store.php');
	$store->logout();
 	header("location:login.php");
 	?>