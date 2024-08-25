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
	}
	table,th,td
	{
		
	}
</style>
	<title>SALES REPORT</title>
</head>
<body>
	<h1>Sales Report weekly</h1>
	<div style='background-color: #f0f0f0; margin:20px;padding-left: 10px;'>
  <?php
$con = mysqli_connect("localhost","root","","storenewdb");
$d = date("Y-m-d");
		
$query = "SELECT 
SUM(success_transaction.total-(available_product.product_cost*success_transaction.product_quantity)) AS profit,
SUM(transaction_total.total) as sumtotal,
SUM(transaction_total.discount),
SUM(success_transaction.discount),
SUM(available_product.product_cost*success_transaction.product_quantity),
COUNT(transaction_total.transaction_id) as count_id,
SUM(success_transaction.product_quantity) AS produ_quan,
date(success_transaction.date_time) as success_tran_date,
date(transaction_total.date_time) as date_time 
FROM success_transaction,transaction_total,available_product 
WHERE success_transaction.transaction_id = transaction_total.transaction_id AND 
available_product.product_code = success_transaction.product_code  
GROUP BY WEEK(success_transaction.date_time) ORDER BY WEEK(success_transaction.date_time) DESC;";		
	$result =$con->query($query);
	$result->fetch_All(MYSQLI_ASSOC);

	foreach ($result as $row) 
	{
			
			echo "<table>";
			echo "<tr>";
			echo "<th>Time </th>";
			echo "<th> transaction_id</th>";
			echo "<th>total</th>";
			echo "<th>cash</th>";
			echo "<th>change</th>";
			echo "</tr>";
						echo "<h2>Date:".$row['date_time']."</h2>";
						echo "<h3>Count Of Product Sold:".$row['produ_quan']."";
						echo "<h3>Count Of Transaction Maid:".$row['count_id']."";
				$sql = "SELECT `transaction_id`, `casher`, `customer_name`, `sub_total`, SUM(total) AS total, `payment`, `changes`, date(date_time) as date_time,time(date_time) as time FROM transaction_total GROUP BY date(date_time) ORDER BY date_time DESC ";
 		  		$results = mysqli_query($con,$sql);
				
					while ($res=mysqli_fetch_assoc($results)) 
					{

					 $t = $res['date_time'];
			 		$ntime = date('h:i:A',strtotime($t));
			 	# code...
			 
						  echo "  <tr>";
		            	  echo "  <td>".$res['date_time']."</td>";
		            	  echo "  <td>".$res['transaction_id']."</td>";
		            	  echo "  <td>".$res['total']."</td>";
		            	  echo "  <td>".$res['payment']."</td>";
		            	  echo "  <td>".$res['changes']."</td>";
		       
          			} 

          				echo "</tr>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td>GRAND TOTAL:".$row['sumtotal']."</td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "</tr>";
         				echo "</tr>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td>Profit:".$row['profit']."</</td>";
              			echo "<tdstyle='border:0;background-color: #ffffff;'></td>";
              			echo "</tr>";
         
	} 
    					echo "</table>";
              			
?>
</div>
</body>
</html>