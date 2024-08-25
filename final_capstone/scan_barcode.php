<?php
$con = mysqli_connect("localhost","root","","storenewdb");
if (isset($_POST['submit'])) 
{
	$barcode = $_POST['barcode'];
	$qry = "INSERT INTO transaction( `product_code`, `product_name`, `product_color`, `product_size`, `product_price`, `product_quantity`, `sub_total`, `discount`, `total`, `product_brand`, `product_category`) 
            SELECT   `product_code`, `product_name`, `product_color`, `product_size`,`product_new_price`,'1',`product_new_price`,'0',`product_new_price`, `product_brand`, `product_category`FROM available_product where barcode_con = $barcode";	
    $qry_run = mysqli_query($con,$qry);
}
 $barcode_name = rand(1000000000,9999999999);
echo $barcode_name;

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

	<form method="POST" name="myform">
		<input type="text" name="barcode">
		<input type="submit" name="submit" value="submit" OnClick="document.myform.productcode.focus();">
	</form>
	<script type="text/javascript">
		document.forms['myform'].elements['productcode'].focus();
	</script>
</body>
</html>