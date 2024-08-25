<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	*
	{
		margin:0px;
		padding:0px;
	}
	h1
	{
		text-align: center;
		font-size: 50px;
		font-weight: bolder;
	}
	table
	{
		width: 1200px;
		padding-bottom: 10px;
		text-align: center;
	}
	th,tr,td,table
	{
		border-style:solid;
		border-collapse: collapse;
		}
	td
	{
		text-align: right;
	}
	fieldset
	{
		margin-top: 15px;
		width: 1197px;
		font-size: 15px;
	}
</style>
	<title>BAD PRODUCT REPORT</title>
</head>
<body>
	<h1>Bad Product Report</h1>
	<div style='background-color: #f0f0f0; margin:20px;padding-left: 10px;padding-bottom: 10px;'>
  <?php
$con = mysqli_connect("localhost","root","","storenewdb");
$d = date("Y-m-d");


		
$query = "SELECT return_product.product_code,return_product.product_name, return_product.product_color, return_product.product_size, return_product.product_brand, return_product.product_category, return_product.product_quantity, return_product.product_price, return_product.total,SUM(return_product.total) as totals,SUM(available_product.product_cost *  return_product.product_quantity) as prodcost,date(return_product.date_time) as date_time
FROM
return_product
INNER JOIN available_product where return_product.product_id = available_product.id
   GROUP BY date(return_product.date_time) 
   ORDER BY date(return_product.date_time) DESC;";		
	$result =$con->query($query);
	$result->fetch_All(MYSQLI_ASSOC);

	foreach ($result as $row) 
	{

			echo "<table>";
			
			echo "<tr>";
			echo "<th>Time</th>";
			echo "<th>Product Code</th>";
			echo "<th>Product Name</th>";
			echo "<th>Product Color</th>";
			echo "<th>Product Size</th>";
			echo "<th>Product Brand</th>";
			echo "<th>Product Category</th>";
			echo "<th>Product  Cost</th>";
			echo "<th>Product Quantity</th>";
		
			echo "<th>Product Price</th>";
			echo "<th>Total</th>";

			echo "</tr>";
				echo "<fieldset>";			
		
	echo "<legend>Date:".$row['date_time']."</legend>";
		echo "</fieldset>";
    				
		
				$sql = "SELECT return_product.product_code, return_product.product_name, return_product.product_color, return_product.product_size, return_product.product_brand, return_product.product_category, return_product.product_quantity, return_product.product_price, return_product.total,(available_product.product_cost * return_product.product_quantity) as procost,date(return_product.date_time) as date_time,time(return_product.date_time) as time 
				FROM return_product INNER JOIN available_product ON return_product.product_id = available_product.id
				GROUP BY time(return_product.date_time),date(return_product.date_time) ORDER BY TIME(date_time) DESC ";
 		  		$results = mysqli_query($con,$sql);
				
					while ($res=mysqli_fetch_assoc($results)) 
					{
					 $t = $res['time'];
			 		$ntime = date('h:i:A',strtotime($t));

			 			if ($res['date_time']==$row['date_time']) 
			 			{		 

						  echo "  <tr>";
		            	  echo "  <td style = 'text-align:left'>".$ntime."</td>";
		            	  echo "  <td style = 'text-align:center'>".$res['product_code']."</td>";
		            	  echo "  <td style = 'text-align:center'>".$res['product_name']."</td>";
		            	  echo "  <td style = 'text-align:center'>".$res['product_color']."</td>";
		            	  echo "  <td style = 'text-align:center'>".$res['product_size']."</td>";
		            	  echo "  <td style = 'text-align:center'>".$res['product_brand']."</td>";
		            	  echo "  <td style = 'text-align:center'>".$res['product_category']."</td>";
		            	  echo "  <td>".$res['procost']."</td>";
		            	  echo "  <td style = 'text-align:center'>".$res['product_quantity']."</td>";
		            	
		            	  echo "  <td>".$res['product_price']."</td>";
		            	  echo "  <td>".$res['total']."</td>";
		            	
		            	}

          			} 

          				echo "</tr><tr style = 'border-top-style:solid'>";
              			echo "<td style='border:0;background-color: #ffffff;text-align:left'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td  style = 'font-weight:bold;background-color:white'>Total:".$row['prodcost']."</td>";
              			
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style = 'font-weight:bold;background-color:white'>TOTAL:".$row['totals']."</td>";
              			echo "</tr>";
         				
	} 
    					echo "</table>";
              			
?>
</div>
</body>
</html>