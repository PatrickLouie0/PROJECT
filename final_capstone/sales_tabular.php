<?php
$total_sales = '';
$db = mysqli_connect("localhost","root","","storenewdb");


/*Get total sales
$total_saless = "SELECT SUM(total) as total FROM  transaction_total where year(date_time) = year(curdate()) ";
$run_total_sale = mysqli_query($db,$total_saless);
if (mysqli_num_rows($run_total_sale)) {
	while ($get_sales = mysqli_fetch_assoc($run_total_sale)) {
	
	$total_sales = $get_sales['total'];	# code...
	}
}

*/
/*
get total cost


//get total expenses
$total_expensess = "";
$total_expenses = "SELECT SUM(cost) as total FROM expenses where year(date_time) = year(curdate()) ";
$run_total_expenses = mysqli_query($db,$total_expenses);
if (mysqli_num_rows($run_total_expenses)) {
	while ($get_expenses = mysqli_fetch_assoc($run_total_expenses)) {
	
	$total_expensess = $get_expenses['total'];	# code...
	}
}

*//* get total loss
$total_losss = "";
$total_loss = "SELECT SUM(total) as total FROM return_product where year(date_time) = year(curdate()) ";
$run_total_loss = mysqli_query($db,$total_loss);
if (mysqli_num_rows($run_total_loss)) {
	while ($get_loss = mysqli_fetch_assoc($run_total_loss)) {
	
	$total_losss = $get_loss['total'];	# code...
	}
}
*/
?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		*
		{
			margin:0px;
			padding:0px;
			color:black;
			text-decoration: none;
		}
		table,th,td,tr
		{
			
		}
		th,td
		{
			width: 100px;
		}
		th
		{
			border-style: solid;
			margin-right: 1px;
			border-width: 0.1px;
		}
		td
		{

			border-width: 0.1px;
			border-bottom-style: solid;
		}
		td
		{
			text-align: right;
		}
		thead
		{
		}
	</style>
	<title></title>
</head>
<body>
<a href="year_store_report.php">
<table>
	<thead style="">
		<tr>
			<th style=";border-top-style: none;border-left-style: none;border-right-style: none;"></th>
			<th>January</th>
			<th>February</th>
			<th>March</th>
			<th>April</th>
			<th>May</th>
			<th>June</th>
			<th>July</th>
			<th>August</th>
			<th>September</th>
			<th>October</th>
			<th>November</th>
			<th>December</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="text-align: left;">Sales</td>



			<?php
			$get_sale = array();
				$sale = "SELECT sum( total) as sale_total FROM transaction_total where year(date_time) = year(curdate()) GROUP BY month(date_time)";
				$run_sale = mysqli_query($db,$sale);

					if (mysqli_num_rows($run_sale)) {
						while ($res_sale = mysqli_fetch_assoc($run_sale)) {
							$get_sale[] = $res_sale['sale_total'];
							echo "<td>".$res_sale['sale_total']."</td>";
		# code...
						}
					}
			?>
		</tr>
		<tr>
			<td style="text-align: left;">Cost</td>
			<?php
			$get_cost = array();
				$cost = "SELECT SUM(available_product.product_cost * success_transaction.product_quantity) as cost 
				FROM available_product INNER JOIN success_transaction ON success_transaction.product_id = available_product.id where year(success_transaction.date_time) = year(curdate()) GROUP BY month(success_transaction.date_time);";
				$run_cost = mysqli_query($db,$cost);

				if (mysqli_num_rows($run_cost)) {
					while ($res_cost = mysqli_fetch_assoc($run_cost)) {
						$get_cost[] = $res_cost['cost'];
						echo "<td>".$res_cost['cost']."</td>";
		# code...
					}
				}
?>

		</tr>
		<tr>
			<td style="text-align: left;">Loss</td>


			<?php
	
			$loss= "
			SELECT return_product.total,sum(available_product.product_cost) as total FROM return_product 
			INNER JOIN available_product ON return_product.product_id = available_product.id 
			where year(return_product.date_time) = year(curdate())
		  GROUP BY month(return_product.date_time);


	";
			$run_loss = mysqli_query($db,$loss);

			if (mysqli_num_rows($run_cost)) {
				while ($res_loss = mysqli_fetch_assoc($run_loss)) {
					echo "<td>".$res_loss['total']."</td>";
		# code...
				}
			}
		?>
		</tr>
		<tr>
			<td style="text-align: left;">Expenses</td>

		<?php

		/*		SELECT t2.sale,t2.cost, 
SUM(return_product.total),t1.cost,((((t2.sale-t2.cost)-t2.discount)-t3.return_product_cost)-t1.cost) as total FROM return_product,

				(SELECT sum(cost) as cost,date_time FROM expenses GROUP BY month(date_time)) t1,
				(SELECT SUM(available_product.product_cost * success_transaction.product_quantity) as cost,SUM(success_transaction.total) as sale,(transaction_total.discount) as discount ,success_transaction.date_time
			 	FROM available_product INNER JOIN success_transaction ON success_transaction.product_code = 	available_product.product_code 
   				INNER JOIN transaction_total ON success_transaction.transaction_id = transaction_total.transaction_id
               where year(success_transaction.date_time) = year(curdate()) GROUP BY month(success_transaction.date_time)) t2,
              
              (SELECT (available_product.product_cost) as return_product_cost,return_product.date_time FROM return_product 
INNER JOIN available_product ON return_product.product_code = available_product.product_code GROUP BY month(return_product.date_time)) t3
				
                WHERE month(return_product.date_time) = month(t1.date_time) AND month(return_product.date_time) = month(t2.date_time) AND month(return_product.date_time) = month(t3.date_time) GROUP BY month(return_product.date_time);*/
			$expenses= "SELECT SUM(cost) AS cost,month(date_time) FROM `expenses` where year(date_time) = year(curdate()) group BY month(date_time);";
			$run_expenses = mysqli_query($db,$expenses);

			if (mysqli_num_rows($run_cost)) {
				while ($res_expenses = mysqli_fetch_assoc($run_expenses)) {
					echo "<td>".$res_expenses['cost']."</td>";
		# code...
				}
			}
		?>	
	
		</tr>

		<tr>
			<td style="text-align: left;">Profit</td>

			<?php
				$get_total = "SELECT T1.sale_total,T2.cost,T3.ret,T4.expenses,(((T1.sale_total-T2.cost)-T3.ret)-T4.expenses) as total
FROM
(SELECT sum( total) as sale_total,date_time FROM transaction_total where year(date_time) = year(curdate()) GROUP BY month(date_time)) T1,
(SELECT SUM(available_product.product_cost * success_transaction.product_quantity) as cost,success_transaction.date_time
FROM available_product INNER JOIN success_transaction ON success_transaction.product_id = available_product.id where year(success_transaction.date_time) = year(curdate()) GROUP BY month(success_transaction.date_time)) T2,
(SELECT return_product.total,sum(available_product.product_cost) as ret,return_product.date_time FROM return_product 
			INNER JOIN available_product ON return_product.product_id = available_product.id 
			where year(return_product.date_time) = year(curdate())
		  GROUP BY month(return_product.date_time)) T3,
(SELECT SUM(cost) AS expenses,date_time FROM `expenses` where year(date_time) = year(curdate()) group BY month(date_time)) T4
WHERE month(T1.date_Time)=month(T2.date_time) AND month(T1.date_Time)=month(T3.date_time) AND month(T4.date_time)
GROUP BY month(t1.date_time);





";

				$run_get_total = mysqli_query($db,$get_total);
				if (mysqli_num_rows($run_get_total)) {
					while ($totals = mysqli_fetch_assoc($run_get_total)) {
						echo "<td>".$totals['total']."</td>";
					}
				}
			?>
		</tr>
	</tbody>
</table>
</a>
</body>
</html>