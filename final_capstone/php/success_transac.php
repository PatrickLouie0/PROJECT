<?php

	if (isset($_POST['submitpayment'])) {
$con = mysqli_connect("localhost","root","","store");
		
		# code...
	
	
	$customer ="INSERT INTO `success_transaction`(
	`cus_id`,
	 `name`,
	  `code`,
	   `color`,
	    `size`,
	     `class`,
	      `category`,
	       `quantity`,
	        `price`,
	         `discount`,
	          `total`,
	           ) 
    SELECT 
   `cus_id`,
    `productname`,
     `productcode`,
       `productcolor`,
        `productsize`,
         `productclass`,
    	   `productcategory`,
        	  `productquantity`,
        	   `productprice`,
        	 	`discount`,
			    `total`
			     FROM `store_transac`"
;
	
	$sql = mysqli_query($con,$customer);
	if ($sql) {
		# code...
		echo "sucess";
	}
	else
	{
		echo "failed";
	}
}
else
{
	echo "not success";
}