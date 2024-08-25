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
		margin-top: 10px;
		text-align: left;
	}
	th,tr,td,table
	{
		border-style:solid;
		border-collapse: collapse;

		}
	fieldset
	{
		margin-left: 14px;
		margin-top: 5px;
		margin-bottom: 20px;
		width: 1215px;
font-size: 15px;
	}
</style>
	<title>SALES REPORT</title>
</head>
<body>
	<h1>Sales Report</h1>
	<div style='background-color: #f0f0f0; margin:20px;padding-left: 10px;padding-bottom: 20px;'>
  <?php
$con = mysqli_connect("localhost","root","","storenewdb");
$d = date("Y-m-d");



$query = "SELECT 
t.total as sumtotal,(t.total - t1.cost) profit,t1.total,t1.cost as tot,t1.cost,t1.quantity,date(t1.date_time) as date_time,t1.quantity as produ_quan,t.count_id as count_id
FROM 
(
SELECT transaction_total.transaction_id,sum(transaction_total.total) as total,
sum(transaction_total.discount) as discount,
count(DISTINCT transaction_total.transaction_id) as count_id,
    transaction_total.date_time  FROM transaction_total GROUP BY date(transaction_total.date_time) ORDER BY transaction_total.date_time desc) t,
(
    SELECT SUM(success_transaction.total)-SUM(available_product.product_cost) as total,
    SUM(available_product.product_cost * success_transaction.product_quantity)as cost,
    SUM(success_transaction.product_quantity) as quantity,
    success_transaction.transaction_id,
    success_transaction.date_time 
    FROM success_transaction 
    INNER JOIN available_product ON success_transaction.product_id = available_product.id
    GROUP BY date(success_transaction.date_time) ORDER BY success_transaction.date_time desc
    ) t1
    
WHERE date(t1.date_time) = date(t.date_time)
group by date(t.date_time),date(t1.date_time) ORDER BY t.date_time desc;";		
	$result =$con->query($query);
	$result->fetch_All(MYSQLI_ASSOC);

	foreach ($result as $row) 
	{
		
			echo "<table>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Time </th>";
			echo "<th> transaction_id</th>";
            echo "<th>Number of Product Sold</th>";
			echo "<th>total</th>";
			echo "<th>cash</th>";
			echo "<th>change</th>";
			echo "</tr>";
			echo "</thead>";
					echo "<form>";	
			echo "<fieldset>";
	
						echo "<legend>Date:".$row['date_time']."</legend>";
						echo "<h3>Count Of Product Sold:".$row['produ_quan']."";
						echo "<h3>Count Of Transaction Made:".$row['count_id']."";

				$sql = "SELECT transaction_total.transaction_id,
				 transaction_total.casher, 
				 transaction_total.customer_name, 
				 transaction_total.sub_total, 
				 sum(success_transaction.total)-transaction_total.discount as total, 
				 transaction_total.payment, 
				 transaction_total.changes, 
				 date(transaction_total.date_time) as date_time,time(transaction_total.date_time) as time,
				 SUM(success_transaction.product_quantity) as productquanti 
				 FROM transaction_total INNER JOIN success_transaction ON success_transaction.transaction_id = transaction_total.transaction_id GROUP BY transaction_total.transaction_id ORDER BY transaction_total.date_time DESC; ";
 		  		$results = mysqli_query($con,$sql);
				
					while ($res=mysqli_fetch_assoc($results)) 
					{

					 $t = $res['time'];
			 		$ntime = date('h:i:A',strtotime($t));
			 			if ($res['date_time']==$row['date_time']) 
			 			{
			 	# code...
			 			  echo "<tbody>";
						  echo "  <tr>";
		            	  echo "  <td>".$ntime."</td>";
		            	  echo "  <td>".$res['transaction_id']."</td>";
                          echo " <td>".$res['productquanti']."</td>";
		            	  echo "  <td>".$res['total']."</td>";
		            	  echo "  <td>".$res['payment']."</td>";
		            	  echo "  <td>".$res['changes']."</td>";
		            	}

          			} 

          				echo "</tr><tr style='border-top-style:solid'>";
              			echo "<td></td>";
              			echo "<td></td>";
              			echo "<td></td>";
              			echo "<td style = 'font-weight:bold;'><p style='color :green'>Grand Total:".$row['sumtotal']."</p></td>";
              			echo "<td></td>";
              			echo "<td></td>";
              			echo "</tr>";
         				echo "<tr style='border-top-style:solid'>";
              			echo "<td></td>";
              			echo "<td></td>";
              			echo "<td></td>";
              			echo "<td style = ' font-weight:bold;'><p style='color:blue'>Profit:".$row['profit']."</p></td>";
              			echo "<td></td>";
                        echo "<td></td>";
              			echo "</tr>";
         				echo "<tbody>";

	} 		
						echo "</table>";
    					echo "</fieldset>";
    				
    					echo "</form>";
            
?>
</div>
</body>
</html>