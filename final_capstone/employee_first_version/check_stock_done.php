<?php
 $cons = mysqli_connect("localhost","root","","store_member");
 session_start();
$username=$_SESSION['usernames'];
$sql = "SELECT * from employee where username = '$username'";
$run = mysqli_query($cons,$sql);
while ($get = mysqli_fetch_assoc($run)) {
  $fullname = $get['lastname'].', '.$get['firstname'];
}

$con = mysqli_connect("localhost","root","","storenewdb");

	# code...
if (isset($_POST['submit'])) {
	# code...

	$id = $_POST['id'];
	$stock = $_POST['check_quantity'];
	$sql_insert = "INSERT INTO`check_stock`(`product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `check_quantity`,`username`) 
                    SELECT `product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`,'$stock','$fullname' FROM available_product where id = $id";
	$insert_run = mysqli_query($con,$sql_insert);
		if ($insert_run) 
		{
		$sql = "UPDATE `available_product` SET `check_stock_status`='',checkby = '' WHERE id = $id";
		$run = mysqli_query($con,$sql);
			if ($run) 
			{
			echo "dine";
			}
			else
			{
				echo "failed";
			}
		}
		header("location:check_stock.php");
			
}
