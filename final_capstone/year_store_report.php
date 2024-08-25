<?php

?>

<!DOCTYPE html>
<html>
<head>
	     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  user-select: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.btn{
  height: 45px;
  width: 45px;
  font-size: 15px;
  text-align: left;
  border-radius: 3px;
  cursor: pointer;
  transition: left 0.4s ease;
  margin-top: 10px;
  margin-left: 5px;
}
.btn i{
  color: white;
  font-size: 28px;
  line-height: 30px;
}
.btn.click span:before{
  content: '\f00d';
}
.sidebar{
  -ms-overflow-style:none;
  scroll-width:none;
  overflow-y: scroll;
  position: fixed;
  width: 250px;
  height: 100%;
  left: -250px;
  background: #1b1b1b;
  transition: left 0.4s ease;
}
.sidebar.show{
  left: 0px;
}
.sidebar .text{
  color: white;
  font-size: 25px;
  font-weight: 600;
  line-height: 65px;
  text-align: center;
  background: #1e1e1e;
  letter-spacing: 1px;
}
nav ul{
  background: #1b1b1b;
  height: 100%;
  width: 100%;
  list-style: none;
}
nav ul li{
  line-height: 60px;
  border-top: 1px solid rgba(255,255,255,0.1);
}
nav ul li:last-child{
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
nav ul li a{
  position: relative;
  color: white;
  text-decoration: none;
  font-size: 18px;
  padding-left: 40px;
  font-weight: 500;
  display: block;
  width: 100%;
  border-left: 3px solid transparent;
}
nav ul li.active a{
  color: cyan;
  background: #1e1e1e;
  border-left-color: cyan;
}
nav ul li a:hover{
  background: #1e1e1e;
}
nav ul ul{
  position: static;
  display: none;
}
nav ul .feat-show.show{
  display: block;
}
nav ul .serv-show.show1{
  display: block;
}
nav ul .sale-show.show2{
  display: block;
}
nav ul ul li{
  line-height: 42px;
  border-top: none;
}
nav ul ul li a{
  font-size: 17px;
  color: #e6e6e6;
  padding-left: 80px;
}
nav ul li.active ul li a{
  color: #e6e6e6;
  background: #1b1b1b;
  border-left-color: transparent;
}
nav ul ul li a:hover{
  color: cyan!important;
  background: #1e1e1e!important;
}
nav ul li a span{
  position: absolute;
  top: 50%;
  right: 20px;
  transform: translateY(-50%);
  font-size: 22px;
  transition: transform 0.4s;
}
nav ul li a span.rotate{
  transform: translateY(-50%) rotate(-180deg);
}
/*sidebar css*/
header
{
   display: flex;
   align-content: center;
   background-color: #034f84;
   height: 50px;
   width: 100%;
}

		table
{
  text-align: center;
  background-color: #f0f0f0;
}
table, td, th, tr 
{  
	border-collapse: collapse;
  border-style: solid;
  padding-left: 15px;
  padding-right: 15px;
  margin-left: 14px;
}
td
{
	text-align: right;
}
	</style>
	<title></title>
</head>
<body>
	    <nav class="sidebar">
         <div class="text">

      <div class="btn" id="btn">
         <i class="fa fa-times" aria-hidden="true"></i>
      </div>
      <p style="color: white">Sales&Inventory</p>
         </div>
         <ul>
            <li class="active"><a href="dashboard.php">DASHBOARD</a></li>
            <li>
               <a href="#" class="feat-btn">PRODUCT
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="productpage.php">ADD PRODUCT</a></li>
                  <li><a href="viewproduct.php">VIEW PRODUCT</a></li>
                  <li><a href="print_barcode.php">BARCODE PRODUCT</a></li>
                  <li><a href="request_inventory_check.php">CHECK INVENTORY</a></li> 
                  
               </ul>
            </li>
            <li>
               <a href="#" class="serv-btn">TRANSACTION
               <span class="fas fa-caret-down second"></span>
               </a>
               <ul class="serv-show">
                  <li><a href="transaction.php">TRANSACTION</a></li>
                  <li><a href="expenses.php">EXPENSES</a></li>
                  <li><a href="returnproduct.php">RETURN PRODUCT</a></li>
               </ul>
            </li>

    <li>
               <a href="history.php" class="sale-btn">HISTORY
               </a>
            </li>
            
            <li>
                <a href="report.php" class="sale-btn">REPORT
               </a>
            </li>
            <li><a href="manager.php">ADD MANAGER</a></li>
            <li><a href="employee.php">ADD EMPLOYEE</a></li>
            
            <li><a href="user_profile.php">ACCOUNT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
         </ul>
      </nav>
<!--sidebar-->
   <header>
    <div class="btn" id="btns">
         <i class="fa fa-bars"  ></i>

      </div>
      <p style="color: white;font-size: 25px; font-weight: bold;padding: 8px;" >MYMY'S DRY GOOD</P>
   </header>

<center><h1>Yearly Summary Report</h1></center>

<?php
$con = mysqli_connect("localhost","root","","storenewdb");

$get_date = "SELECT date(date_time) as date_time,year(date_time) as dates from success_transaction group by year(date_time) desc";
$run_get_date = mysqli_query($con,$get_date);
if (mysqli_num_rows($run_get_date)) {
	foreach ($run_get_date as $run_date) 
	{
				$ntime = date('y',strtotime($run_date['date_time']));
			
		echo "<h2>".$run_date['dates']."</h2>";

		//Get total sales
				$total_sale = "SELECT SUM(total) as total,date(date_time) as date_Time FROM  transaction_total group by year(date_time)";
							$run_total_sale = mysqli_query($con,$total_sale);
		
								if (mysqli_num_rows($run_total_sale)) {
						
									while ($saless = mysqli_fetch_assoc($run_total_sale)) {
									$stime = date('y',strtotime($saless['date_Time']));
										if ($ntime == $stime) {	
											echo "<p>Total Sales:  ".$saless['total']."</p>";
										}
									}
								}
		//Get total cost
				$total_cost = "SELECT SUM(available_product.product_cost * success_transaction.product_quantity) as cost,date(success_transaction.date_time) as date_time 
							FROM available_product INNER JOIN success_transaction ON success_transaction.product_id = available_product.id GROUP BY year(success_transaction.date_time)";
							$run_total_cost = mysqli_query($con,$total_cost);
		
								if (mysqli_num_rows($run_total_cost)) {
						
									while ($costt = mysqli_fetch_assoc($run_total_cost)) {

									$cost_t = date('y',strtotime($costt['date_time']));
										if ($ntime == $cost_t) {	
											echo "<p> Total Product Cost: ".$costt['cost']."</p>";
										}
									}
								}
		//Get total loss
				$total_loss = "SELECT return_product.total,SUM(available_product.product_cost) as total,date(return_product.date_time) as date_time FROM return_product 
								INNER JOIN available_product ON return_product.product_code = available_product.product_code 
		  						GROUP BY year(return_product.date_time); ";
							$run_total_loss = mysqli_query($con,$total_loss);
		
								if (mysqli_num_rows($run_total_loss)) {
						
									while ($losses = mysqli_fetch_assoc($run_total_loss)) {

									$losses_t = date('y',strtotime($losses['date_time']));
										if ($ntime == $losses_t) {	
											echo "<p>Total Loss: ".$losses['total']."</p>";
										}
									}
								}
		//Get total expenses
				$total_expenses = "SELECT SUM(cost) AS total,date(date_time) as date_time FROM `expenses` GROUP BY year(date_time);";
							$run_total_expenses = mysqli_query($con,$total_expenses);
		
								if (mysqli_num_rows($run_total_expenses)) {
						
									while ($expensess = mysqli_fetch_assoc($run_total_expenses)) {

									$expenses_t = date('y',strtotime($expensess['date_time']));
										if ($ntime == $expenses_t) {	
											echo "<p> Total Expenses: ".$expensess['total']."</p>";
										}
									}
								}
			
		//Get total Profit
				$total_profit = "SELECT t1.total,t2.cost,t3.totals as bad_product,sum(expenses.cost),
t1.total-t2.cost-t3.totals-sum(expenses.cost) as total,t1.date_time as time_date
FROM expenses,
(SELECT date_time,sum(total) as total from transaction_total group by year(date_time)) t1,
(SELECT SUM(available_product.product_cost * success_transaction.product_quantity) as cost,
 success_transaction.date_time
FROM available_product INNER JOIN success_transaction ON success_transaction.product_id = 	available_product.id GROUP BY year(success_transaction.date_time)) t2,
(SELECT return_product.total,SUM(available_product.product_cost) as totals,return_product.date_time FROM return_product 
								INNER JOIN available_product ON return_product.product_code = available_product.product_code 
		  						GROUP BY year(return_product.date_time)) t3
WHERE year(t1.date_time) = year(expenses.date_time) AND year(t2.date_time) = year(expenses.date_time) AND year(t3.date_time) = year(expenses.date_time)
GROUP BY year(expenses.date_time);";
							$run_total_profit = mysqli_query($con,$total_profit);
		
								if (mysqli_num_rows($run_total_profit)) {
						
									while ($profits = mysqli_fetch_assoc($run_total_profit)) {

									$profit_t = date('y',strtotime($profits['time_date']));
										if ($ntime == $profit_t) {	
											echo "<p>Total profit: ".$profits['total']."</p>";
										}
									}
								}
			
					?>


			<div class="table">
		<table>
			<thead>
		<tr>
		<th style="border-left-style: none;border-top-style: none;"></th>
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
	<?php
					echo "<tbody >";	
					echo "<tr>";
						echo "<td style='text-align: left;'>Sales</td>";
							$get_second_date = "SELECT date(date_time) as date_time,sum(total) as total from transaction_total group by year(date_time),month(date_time)";
							$run_second_date = mysqli_query($con,$get_second_date);
		
								if (mysqli_num_rows($run_second_date)) {
						
									while ($second_date = mysqli_fetch_assoc($run_second_date)) {
									$stime = date('y',strtotime($second_date['date_time']));
										if ($ntime == $stime) {	
											echo "<td>".$second_date['total']."</td>";
										}
									}
								}
					echo "</tr>";
						echo "<td style='text-align: left;'>Cost</td>";
							$get_cost = "SELECT SUM(available_product.product_cost * success_transaction.product_quantity) as cost,date(success_transaction.date_time) as date_time 
							FROM available_product INNER JOIN success_transaction ON success_transaction.product_id = available_product.id GROUP BY year(success_transaction.date_time), month(success_transaction.date_time);";
							
								$run_cost = mysqli_query($con,$get_cost);
								if (mysqli_num_rows($run_cost)) {
									while ($cost = mysqli_fetch_assoc($run_cost)) {
										$cost_t = date('y',strtotime($cost['date_time']));
											if ($ntime == $cost_t) {
												echo "<td>".$cost['cost']."</td>";
											}
									}
								}
	
					echo "</tr>";
						echo "<td style='text-align: left;'>Loss</td>";
							$get_loss = "SELECT return_product.total,SUM(available_product.product_cost) as total,date(return_product.date_time) as date_time FROM return_product 
								INNER JOIN available_product ON return_product.product_code = available_product.product_code 
		  						GROUP BY year(return_product.date_time),month(return_product.date_time);";
							$run_loss = mysqli_query($con,$get_loss);
							if (mysqli_num_rows($run_loss)) {
								while ($loss = mysqli_fetch_assoc($run_loss)) {
								$loss_t = date('y',strtotime($loss['date_time']));
									if ($ntime == $loss_t) {
										echo "<td>".$loss['total']."</td>";
									}
								}
							}

					echo "</tr>";
						echo "<td style='text-align: left;'>Expenses</td>";
									$get_expenses = "SELECT SUM(cost) AS cost,date(date_time) as date_time FROM `expenses` GROUP BY year(date_time),month(date_time);";
									$run_expenses = mysqli_query($con,$get_expenses);
									if (mysqli_num_rows($run_expenses)) {
										while ($expenses = mysqli_fetch_assoc($run_expenses)) {
										$expenses_t = date('y',strtotime($expenses['date_time']));
											if ($ntime == $expenses_t) {
												echo "<td>".$expenses['cost']."</td>";
											}
										}
									}

					echo "</tr>";
				


		echo "		<tr>
			<td style='text-align: left;''>Profit</td>
			";


									$get_profit = "SELECT T1.sale_total,T2.cost,T3.ret,T4.expenses,(((T1.sale_total-T2.cost)-T3.ret)-T4.expenses) as total,date(T1.date_time) as date_time
FROM
(SELECT sum( total) as sale_total,date_time FROM transaction_total  GROUP BY  year(date_time),month(date_time)) T1,
(SELECT SUM(available_product.product_cost * success_transaction.product_quantity) as cost,success_transaction.date_time
FROM available_product INNER JOIN success_transaction ON success_transaction.product_id = available_product.id GROUP BY  year(success_transaction.date_time),month(success_transaction.date_time))T2,
(SELECT return_product.total,sum(available_product.product_cost) as ret,return_product.date_time FROM return_product 
			INNER JOIN available_product ON return_product.product_code = available_product.product_code 
			GROUP BY  year(return_product.date_time),month(return_product.date_time)) T3,
(SELECT SUM(cost) AS expenses,date_time FROM `expenses` GROUP BY  year(date_time),month(date_time)) T4
WHERE month(T1.date_time)=month(T2.date_time) AND year(T1.date_time)=year(T2.date_time) AND month(T1.date_time)=month(T3.date_time) AND year(T1.date_time)=year(T3.date_time) AND month(T1.date_time) = month(T4.date_time) AND  year(T1.date_time) = year(T4.date_time)
GROUP BY month(t1.date_time),year(t1.date_time);";
									$run_profit = mysqli_query($con,$get_profit);
									if (mysqli_num_rows($run_profit)) {
										while ($profit = mysqli_fetch_assoc($run_profit)) {
										$profit_t = date('y',strtotime($profit['date_time']));
											if ($ntime == $profit_t) {
												echo "<td>".$profit['total']."</td>";
											}
										}
									}

		echo "</tr>";	
		

	?>
				<tbody>

		</table>
	</br>
		<?php
	}
}

?>

</div>

 <script>
         $('.btn').click(function(){
           $(this).toggleClass("click");
           $('.sidebar').toggleClass("show");
         });
           $('.feat-btn').click(function(){
             $('nav ul .feat-show').toggleClass("show");
             $('nav ul .first').toggleClass("rotate");
           });
           $('.serv-btn').click(function(){
             $('nav ul .serv-show').toggleClass("show1");
             $('nav ul .second').toggleClass("rotate");
           });
            $('.sale-btn').click(function(){
             $('nav ul .sale-show').toggleClass("show2");
             $('nav ul .third').toggleClass("rotate");
           });
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
</script>

</body>
</html>