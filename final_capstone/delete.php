
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "storedb";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['edit']))
{
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

	//query delete
		$target = 'product/' . $productpicture;
		if(move_uploaded_file($_FILES['productpicture']['tmp_name'],$target))
		{
	 	   $sql = " UPDATE `product` SET 
	 	   `productpicture`=?,
	 	   `productcode`=?,
	 	   `productname`=?,
	 	   `productcolor`=?,
	 	   `productsize`=?,
	 	   `productclass`=?,
	 	   `productcategory`=?,
	 	   `productquantity`=?,
	 	   `productprice`=?,
	 	   `productaddedprice`=?,
	 	   `productnewprice`=?
	 	    WHERE `id`=? ";

	   		$stmt = $con->prepare($sql);
	   		$stmt->blind_param('sississssss',
	   			$productpicture,
	   			$productcode,
	   			$productname,
	   			$productcolor,
	   			$productsize,
	   			$productclass,
	   			$productcategory,
	   			$productquantity,
	   			$productprice,
	   			$productaddedprice,
	   			$productnewprice);
	  		if ($stmt->execute()) {
	  			
	  		}
	  		$stmt->close();
	  		$con->close();
	  	}
	  	else
	  	{
	  		echo "not succeed";
	  	}
	  }
	  else
	  {
	  	echo "submit failed";
	  }