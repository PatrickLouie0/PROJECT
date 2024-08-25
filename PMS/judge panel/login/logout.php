<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['event_id']);
session_destroy();
   	header('location: login.php');
?>