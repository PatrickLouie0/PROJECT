<?php  
require('vendor/autoload.php');

session_start();
$msg = "";
$css_class = "";
$success = "";
if (isset($_POST['submit'])) 
{
	$con = mysqli_connect("localhost","root","","storenewdb") or die("not connect");
		$productpicture = time() . '_' . $_FILES['productpicture']['name'];
		$productcode = strtoupper($_POST['productcode']);
	    $productname = strtoupper($_POST['productname']);
	    $productcolor = strtoupper($_POST['productcolor']);
	    $productsize = strtoupper($_POST['productsize']);
	    $productclass = strtoupper($_POST['productclass']);
	    $productcategory = strtoupper($_POST['category']);
	    $productquantity = $_POST['productquantity'];
	    $productprice = $_POST['productprice'];
	    $productaddedprice = $_POST['addedprice'];
	    $productnewprice = $_POST['newprice'];
	    $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
		$uniqid = rand(1000000000,9999999999);
		echo $uniqid;
		$barcodename = $uniqid.'.jpg';
		$bar = $uniqid;
	    $checkdata = "SELECT * FROM available_product where product_code = '$productcode' AND product_name = '$productname' 
	    AND 'product_color' = '$productcolor' AND product_size = '$productsize'";
		$run_check_data = mysqli_query($con,$checkdata);
		if (mysqli_num_rows($run_check_data) > 0) {		
			$_SESSION['available'] = "Product Added Successfully!";
		}
		else
		{
		file_put_contents('../barcode/'.$uniqid.'.jpg', $generator->getBarcode($bar, $generator::TYPE_CODE_128));

		$target = '../product_picture/' . $productpicture;

		if($move = move_uploaded_file($_FILES['productpicture']['tmp_name'],$target))
		{
		
	 	   $sql = " INSERT INTO `available_product`(`barcode`,`barcode_con`,`product_picture`,`product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`,`product_quantity`, `product_cost`, `product_added_price`, `product_new_price`) VALUES ('$barcodename','$bar','$productpicture','$productcode','$productname','$productcolor','$productsize','$productclass','$productcategory','$productquantity','$productprice','$productaddedprice','$productnewprice');";

	   		$result = mysqli_query($con,$sql);
	  		if ($result) 
	  		{
	  				$_SESSION['status'] = "Product Added Successfully!";

	  		}
		}
		else
		{
			$box = 'box.png';
		   $sql = " INSERT INTO `available_product`(`barcode`,`barcode_con`,`product_picture`,`product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`,`product_quantity`, `product_cost`, `product_added_price`, `product_new_price`) VALUES ('$barcodename','$bar','$box','$productcode','$productname','$productcolor','$productsize','$productclass','$productcategory','$productquantity','$productprice','$productaddedprice','$productnewprice');";

	   		$result = mysqli_query($con,$sql);
	  		if ($result) 
	  		{
	  				$_SESSION['status'] = "Product Added Successfully!";

	  		}
		
		}
	}
header("location:../productpage.php");
}
?>
<?php
if (isset($_POST['update_data'])) 
{
	$con = mysqli_connect("localhost","root","","storenewdb") or die("not connect");
		$productpicture = time() . '_' . $_FILES['productpicture']['name'];
		$productcode = $_POST['productcode'];
	    $productname = $_POST['productname'];
	    $productcolor = $_POST['productcolor'];
	    $productsize = $_POST['productsize'];
	    $productclass = $_POST['productclass'];
	    $productcategory = $_POST['category'];
	    $productquantity = $_POST['productquantity'];
	    $productprice = $_POST['productprice'];
	    $productaddedprice = $_POST['addedprice'];
	    $productnewprice = $_POST['newprice'];

		$target = '../product_picture/' . $productpicture;
		if(move_uploaded_file($_FILES['productpicture']['tmp_name'],$target))
		{
	 	   $sql = " UPDATE `available_product` SET `product_picture`='$productpicture',`product_code`='$productcode',`product_name`='$productname',`product_color`='$productcolor',`product_size`='$productsize',`product_brand`='$productclass',`product_category`='$productcategory',`product_quantity`='$productquantity',`product_cost`='$productprice',`product_added_price`='$productaddedprice',`product_new_price`='$productnewprice' where product_code = '$productcode' ";

	   		$result = mysqli_query($con,$sql);
	  		if ($result) 
	  		{
	  			 $_SESSION['update'] = "Product Added Successfully!";


	  		}
	  	}
		else
			{

	 	   	$sql = " UPDATE `available_product` SET `product_code`='$productcode',`product_name`='$productname',`product_color`='$productcolor',`product_size`='$productsize',`product_brand`='$productclass',`product_category`='$productcategory',`product_quantity`='$productquantity',`product_cost`='$productprice',`product_added_price`='$productaddedprice',`product_new_price`='$productnewprice' where product_code = '$productcode'";

	   		$result = mysqli_query($con,$sql);
	  		if ($result) 
	  		{
	  			$_SESSION['update'] = "Product Added Successfully!";


	  		}
	  	}
header("location:../productpage.php");
}
?>
