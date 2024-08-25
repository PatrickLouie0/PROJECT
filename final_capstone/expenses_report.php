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
		text-align: center;
	}
	
	th,table
	{
		border-style: solid;
		border-collapse: collapse;
		margin-top: 0px;
	}
	fieldset
	{
		width: 1196px;
	}
</style>
	<title>EXPENSES REPORT</title>
</head>
<body>
	<h1>Expenses Report</h1>
	<div style='background-color: #f0f0f0; margin:20px;padding-left: 10px;padding-bottom: 10px;'>
  <?php
$con = mysqli_connect("localhost","root","","storenewdb");
$d = date("Y-m-d");


		
$query = "SELECT reason,SUM(cost) AS cost,date(date_time) as date_time
FROM
expenses
   GROUP BY date(date_time) 
   ORDER BY date(date_time) DESC;";		
	$result =$con->query($query);
	$result->fetch_All(MYSQLI_ASSOC);

	foreach ($result as $row) 
	{
			
			echo "<table>";
			echo "<tr>";
			echo "<th>Time </th>";
			echo "<th> Description of Expenses</th>";
			echo "<th>Cost</th>";
			echo "</tr>";
			echo "<fieldset>";
						echo "<legend>Date:".$row['date_time']."</legend>";

				$sql = "SELECT reason,cost,date(date_time) as date_time,time(date_time) as time FROM expenses GROUP BY time(date_time) ORDER BY date_time DESC ";
 		  		$results = mysqli_query($con,$sql);
				
					while ($res=mysqli_fetch_assoc($results)) 
					{

					 $t = $res['time'];
			 		$ntime = date('h:i:A',strtotime($t));
			 			if ($res['date_time']==$row['date_time']) 
			 			{
			 	# code...
			 
						  echo "  <tr>";
		            	  echo "  <td>".$ntime."</td>";
		            	  echo "  <td>".$res['reason']."</td>";
		            	  echo "  <td>".$res['cost']."</td>";
		            	}

          			} 

          				echo "</tr><tr style = 'border-top-style:solid'>";
              			echo "<td style='border:0;background-color: #ffffff;'> TOTAL:</td>";
              			echo "<td style='border:0;background-color: #ffffff;'></td>";
              			echo "<td style='background-color:white;color:;font-weight:bold'>".$row['cost']."</td>";
              			echo "</tr> <br>";
            
         				
	} 
    					echo "</table>";

			echo "</fieldset>";
              			
?>
</div>
</body>
</html>