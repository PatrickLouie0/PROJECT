<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "storenewdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
      if (isset($_POST['submit'])) 
      {
	    $reason = $_POST['reason'];
	    $cost = $_POST['cost'];
        $sql = "INSERT INTO `expenses`(`reason`, `cost`) VALUES ('$reason','$cost')";
	   $run = mysqli_query($conn,$sql);
	       if ($run) 
           {
		     $_SESSION['status'] = "transaction complete";
                
    	   }
}

header("location:../expenses.php");
?>