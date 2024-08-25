<?php
$con = mysqli_connect("localhost","root","","storenewdb");
if (isset($_POST['submit'])) {
$category = $_POST['category'];
$employee = $_POST['employee'];
	if ($category == 'all') 
	{
		$sql = "UPDATE `available_product` SET `check_stock_status`='1',`checkby`='$employee'";
		$run = mysqli_query($con,$sql);
		if ($run) 
		{
			$_SESSION['check'] = "Selected record is Successfully Deleted..";
			header("location:request_inventory_check.php");
		}
		else 
		{

		}
	}
	else 
	{
		$status = '0';
		$sqls = "UPDATE `available_product` SET `check_stock_status`='1',`checkby`='$employee' WHERE product_category = '$category'";
		$runs = mysqli_query($con,$sqls);
		if ($runs) 
		{
			$_SESSION['check'] = "Selected record is Successfully Deleted..";
			header("location:request_inventory_check.php");
		}
		else 
		{

		}
	
	}

}



