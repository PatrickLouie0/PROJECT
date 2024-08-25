<?php
$name = '';
$productcategory = '';
	$connect = mysqli_connect("localhost","root","","storenewdb");
	$con = mysqli_connect("localhost","root","","store_member");
 	
 	$query = "SELECT `product_category` FROM `available_product` group by product_category";
    $querys = "SELECT `lastname`,`firstname`,username FROM `employee` ";
    
    $result = mysqli_query($connect, $query);
    $results = mysqli_query($con, $querys);
    
    if(mysqli_num_rows($result) >0)
    {
      while ($row = mysqli_fetch_array($result))
      {   
          $productcategory = $productcategory."<option value = '".$row['product_category']."'>$row[product_category] </option>";
      }  
    }

    if(mysqli_num_rows($result) >0)
    {
      while ($rows = mysqli_fetch_array($results))
      {   
          $name = $name."<option value = '".$rows['username']."'>$rows[firstname] $rows[lastname] </option>";
      }  
    }
    
?>
<div style="filter: blur(5px);
">
<?php
include('request_inventory_check.php');
include('request_inventory_table.php');
?>
</div>
<div style="background-color: #f0f0f0; ">
<form method="POST" action="request_inventory_query.php"
style="
position: fixed;
height: 280px;
width: 500px;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
background-color: #f0f0f0;
" 
>
<div class="form1" style="text-align: center;">
	<h3>Request Inventory Check </h3>
<label style="display: block">Category to Check</label> 
      <SELECT id="productcolor" name="category" style="height: 35px; width: 150px; margin-bottom: 18px; background-color: white" >
      	<option value="all">Check All</option>
      	<?php echo $productcategory; ?>
      	</SELECT>
      <label style="display: block;">Employee</label>
      <SELECT id="productclass" name = "employee" style="height: 35px; width: 150px;margin-bottom: 10px; background-color: white">
      	<?php echo $name; ?>
      	</SELECT>
      	<br>
     <input type="submit" name="submit" value="Request" style="width: 150px;height:40px; background-color: green;color:white;">
     </div>
</form>
</div> 
<script src="../javascript/prevent_resub.js"></script>