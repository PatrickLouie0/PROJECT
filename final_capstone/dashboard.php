<?php
//piechart 

 session_start();
$eid=$_SESSION['user-manager'];
if($eid=='')
{
header('location:Login.php');
}
$con  = mysqli_connect("localhost","root","","storenewdb");
 if (!$con) {
     # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         $sql ="SELECT SUM(cost) AS cost
         FROM expenses";
         $result = mysqli_query($con,$sql);
          while ($row = mysqli_fetch_array($result)) { 
      
            $Product = "Expenses";
            $productname[]  = $Product;
            
            $sales[] = $row['cost'];
           }

         $sqls = "SELECT SUM(success_transaction.total-(available_product.product_cost*success_transaction.product_quantity)) AS TotalSales FROM success_transaction INNER JOIN available_product ON success_transaction.product_name = available_product.product_name where year(success_transaction.date_time) = year(curdate());";
          $res = mysqli_query($con,$sqls);
         while ($row = mysqli_fetch_array($res)) {
          $Productes = "profit";
          $productname[]  = $Productes;
        $sales[] = $row['TotalSales'];
        }
       
         $damage = "SELECT SUM(total) as damage from return_product where year(date_time) = year(curdate())";
          $resu = mysqli_query($con, $damage);
         while ($row = mysqli_fetch_array($resu)) {
          $Products = "loss";
          $productname[]  = $Products;
        $sales[] = $row['damage'];
                  
            
        }
       
        $totalsal = "SELECT SUM(total) as TotalSaless from success_transaction where year(date_time) = year(curdate())";
         $resuta = mysqli_query($con, $totalsal);
         
         $chart_data="";
        
        while ($row = mysqli_fetch_array($resuta)) {
          $Prod = "Sales";
          $productname[]  = $Prod;
        $sales[] = $row['TotalSaless'];
                      
        }

 
 
 }
 
?>
<?php 
//barchart
$connection  = mysqli_connect("localhost","root","","storenewdb");
$query = "SELECT SUM(product_quantity) as total,date_time,product_name from success_transaction where MONTH(date_time) = MONTH(curdate()) and year(date_time) = year(curdate())  GROUP BY product_name ORDER BY total DESC limit 10";
$result = mysqli_query($connection, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ time:'".$row["product_name"]."', TotalSales:".$row["total"]."}, ";
}
$chart_data = substr($chart_data, -0, -1);
?>

<?php 
//daily chart
$connection  = mysqli_connect("localhost","root","","storenewdb");
$querys = "SELECT SUM(total) as total,time(date_time) as date_time from transaction_total  where cast(DATE(date_time) as date) = cast(curdate() as date) GROUP BY second(date_time) ORDER BY date_time ASC; ";
$results = mysqli_query($connection, $querys);
$chart_daily = '';
while($row = mysqli_fetch_array($results))
{
      $t = $row['date_time'];
      $ntime = date('h:i:A',strtotime($t));
       
 $chart_daily .= "{ time:'".$ntime."', TotalSales:".$row["total"]."}, ";
}
$chart_daily = substr($chart_daily, -0, -1);
?>
<?php 
//weekly chart
$connection  = mysqli_connect("localhost","root","","storenewdb");
$querys = "SELECT SUM(total) as total,date(date_time) as date_time from transaction_total where year(date_time) = year(curdate()) GROUP BY week(date_time) ORDER BY date_time ASC; ";
$results = mysqli_query($connection, $querys);
$chart_weekly = '';
while($row = mysqli_fetch_array($results))
{
 $chart_weekly .= "{ time:'".$row["date_time"]."', TotalSales:".$row["total"]."}, ";
}
$chart_weekly = substr($chart_weekly, -0, -1);
?>
<?php 
//monthly chart
$connection  = mysqli_connect("localhost","root","","storenewdb");
$querys = "SELECT SUM(total) as total,date(date_time) as date_time from transaction_total where year(date_time) = year(curdate()) GROUP BY Month(date_time) ORDER BY date_time ASC; ";
$results = mysqli_query($connection, $querys);
$chart_monthly = '';
while($row = mysqli_fetch_array($results))
{
 $chart_monthly .= "{ time:'".$row["date_time"]."', TotalSales:".$row["total"]."}, ";
}
$chart_monthly = substr($chart_monthly, -0, -1);
?>
<?php 
//yearly chart
$connection  = mysqli_connect("localhost","root","","storenewdb");
$querys = "SELECT SUM(total) as total,year(date_time) as date_time from transaction_total  GROUP BY year(date_time) ORDER BY date_time ASC; ";
$results = mysqli_query($connection, $querys);
$chart_yearly = '';
while($row = mysqli_fetch_array($results))
{
 $chart_yearly .= "{ time:'".$row["date_time"]."', TotalSales:".$row["total"]."}, ";
}
$chart_yearly = substr($chart_yearly, -0, -1);
?>

<?php 
//SELECT p.productprice,d.total,d.quantity,(p.productprice * d.quantity) AS prices,((p.productprice * d.quantity)-d.total) AS REVENUE 
//query of computation for cards
    //FROM product p
    //INNER JOIN success_transaction d ON d.productcode=p.productcode;
$connect = mysqli_connect("localhost", "root", "","storenewdb");
    $query = "SELECT SUM(cost) as cost FROM expenses  where cast(DATE(date_time) as date) = cast(curdate() as date);";
    $result = mysqli_query($connect, $query);
    
    while ($row = mysqli_fetch_array($result))
      {   
          $cost = $row['cost'];
      }  
    
    $damage = "SELECT SUM(total) as damage from return_product where cast(DATE(date_time) as date) = cast(curdate() as date);";
    $resu = mysqli_query($connect, $damage);
    
     while ($row = mysqli_fetch_array($resu)) 
      {
          $losses = $row['damage'];
      }
    
    $totalsale = "SELECT SUM(total) as TotalSales from success_transaction where cast(DATE(success_transaction.date_time) as date) = cast(curdate() as date);";
    $resuls = mysqli_query($connect, $totalsale);
    
     while ($row = mysqli_fetch_array($resuls)) 
      {
          $total_sales = $row['TotalSales'];
      }
    
    $sqls = "SELECT SUM(success_transaction.total-(available_product.product_cost*success_transaction.product_quantity)) AS Totalsales FROM success_transaction INNER JOIN available_product ON success_transaction.product_code = available_product.product_code where cast(DATE(success_transaction.date_time) as date) = cast(curdate() as date);";
    $res = mysqli_query($connect,$sqls);

      while ($row = mysqli_fetch_array($res)) 
      {
        $profit = $row['Totalsales'];
      }
    
    $prod_count = "SELECT SUM(product_quantity) as count,cast(DATE(date_time) as date),cast(curdate() as date) from success_transaction where cast(DATE(date_time) as date) = cast(curdate() as date); ";
    $product_count =mysqli_query($connect,$prod_count);
    
    while ($row = mysqli_fetch_array($product_count)) 
      {
        $poduct_sold = $row['count'];
      }
         
     
      
    mysqli_free_result($result);
    mysqli_close($connect);
?>
<?php
//query for table of sales
$connect = mysqli_connect("localhost", "root", "","storenewdb");
    $query = "SELECT   `product_name`, `product_code`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `product_price`, `discount`, `total` FROM `success_transaction`";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) >0) {
    while ($row = mysqli_fetch_array($result))
      {   

          $name = $row['product_name'];
          $productcode = $row['product_code'];
          $color = $row['product_color'];
          $size = $row['product_size'];
          $class = $row['product_brand'];
          $category = $row['product_category'];
          $quantity = $row['product_quantity'];
          $price = $row['product_price'];
          $discount = $row['discount'];
          $total = $row['total'];
          



      }
    }
    else
    {
      $notif = "no availble";
    }  
    
    mysqli_free_result($result);
    mysqli_close($connect);
?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
    <meta charset="utf-8">
      <title>dashboard</title>
      <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>


      <meta name="viewport" content="width=device-width, initial-scale=1.0">


     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


     <link rel="stylesheet" type="text/css" href="css/morris_chart.css">


     <script src="javascript/raphael-morris.js"></script>



     <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


      <link rel="stylesheet" type="text/css" href="css/data_table.css">


      <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>


      <script src="javascript/table2excel.js"></script>

      
      <script src="javascript/pdf-kendo.js"></script>
      <style type="text/css">
 /*css sidebar */
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
/*end of sidebar css*/

      body
      {
         padding: 0px;
         margin:0px;
      }
      .card-form
      {  

         margin: 20px 13px;
         padding: 10px;
         background-color: #f5f5f5;
         height:170px;
         width: 1240px;
         column-count: 4;
         
      }   
      .chart-form
      {
         padding-top: 20px;
         margin-left: 50px;
         height: 390px;
         width: 1220px;
         background-color: #f5f5f5;
      }
      .card
      {
         padding:20px;
         height: 150px;
         width: 290px;
         background-color: white;
         margin-top: 20px;
         margin-left:2PX;


      }
      .card:first-child
      {
         background-color: blue;
         margin-top: -1px;
      }
      .card:nth-of-type(2)
      {
         background-color: red;

      }
      .card:nth-of-type(3)
      {
         background-color: lightblue;
         
      }
      .card:nth-of-type(4)
      {
         background-color: yellow;
      }

      .card:nth-of-type(5)
      {
         background-color: orange;
      }
      .card:nth-of-type(6)
      {
         background-color: violet;      }

      .card:nth-of-type(7)
      {
         background-color: #FFA07A;      }
      .card:last-child
      {

      }
      .card h4
      {
         font-size: 30px;
         margin-bottom: -20px;
      }
      .card h2
      {
         margin-top: 50px;
         margin-right: 180px;
      }
      th{
      }
      input{
        margin-right: 10px;
        border-radius: 5px;
        height: 30px;
        width: 200px;
        color: black;
        border-style: solid;
        border-width: 1px;
        border-color: black;     
      }
      button {
      text-decoration: none;
      padding: 1px;
      background-color: white;
      opacity: 0.7;
      font-family: arial;
      font-size: 15pt;
     text-transform: uppercase;
     font-weight: bolder;
     color: #202530;
     border-radius: 1px;
     transition: opacity .2s ease-out;
     letter-spacing: 4px;


    }
      button:hover{
     opacity: 1;
     transition: opacity .2s ease-in;
    }
    center i{
      font-size: 30px;
      padding: 10px;
    }
    label{
     margin-left: 10px;
    } 
    .card-form a
{
  display:block;
  color:black;
  text-decoration:none;
}
.tabular
{
  background-color: #f0f0f0;
  margin-right: 20px;
  margin-left: 20px;
  margin-bottom: 10px;
  padding-bottom: 50px;
  padding-top: 30px;
}
.tabular table
{
  margin-left:30px;
margin-right: 30px;
margin-bottom: 20px;padding
}

      </style>

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
                  <li><a href="returnproduct.php">BAD PRODUCT</a></li>
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
      <p style="color: white;font-size: 25px; font-weight: bold;padding: 8px;" ><?php include("php/store_name.php")?></P>
   </header>



  <div class="card-form">

          <a href="sales_report.php" >
         <div class="card">
            <h4>Sales</h4>

            <h2><?php echo $total_sales;?>             
            <h6 style="margin-bottom: 10px;">number of product sold:<?php echo $poduct_sold; ?></h6>
</h2>

         
         </div>
          </a>
         <a href="losses_report.php" style="background-color: red;">
         <div class="card" style="background-color: red;">
            <h4>Loss</h4>

            <h2><?php echo $losses;?></h2>

         </div>
         </a>

         <div class="card" style="background-color: lightblue">
            <h4>Profit</h4>

            <h2><?php echo $profit?></h2>
         </div>
        <a href="expenses_report.php" >
         <div class="card" style="background-color: yellow">

            <h4>Store Expenses</h4>

            <h2><?php echo $cost;?></h2>
         </div>
         </a>
        
      </div>
   <div class=" tabular">
   <h2 style=" margin-left: 20px;">Monthly Summary Report</h2>
   <?php

    include("sales_tabular.php");
   ?>
 </div>

      <!-- chart -->
       <!--pie chart-->
       <div class="pies" style="
       margin-left: 20px;
       padding-left: 20px;
       background-color: #f5f5f5;
       display: flex;
  flex-wrap: wrap;
  height: 500px;
  width: 97%;
  align-content: space-between;
">
<!--pie chart
     <div style="width:30%;hieght:20%;">
            <h2 class="page-header" style="text-align: center;" >YEARLY Chart Report</h2>
            
            <canvas  id="chartjs_pie"></canvas> 
         </div>    
 -->   
 <!--barchart-->
 <div class="container" style="width:12500px;  ">
   <h2 class="text-center">BEST SELLING PRODUCT OF THE MONTH</h2>
   <br /><br />
   <div id="chart">
   </div>
 </div>
</div>

    <div id="form" class="table" style="background-color: #f5f5f5;margin-top: 10px;margin-left: 20px;margin-right: 20px;">
 
  <h2>Day</h2>  
 
      <div id="charts" style="position: none;">
     
   </div>
     <input type="submit" class="active" name="days" value="Day" onclick="button1()">
   <input type="submit" name="weeks" value="Week" onclick="button2()">
   <input type="submit" name="month" value="Month" onclick="button3()">
  <input type="submit" class="active" name="Year" value="Year" onclick="button4()">
 
  </div>
  <div id="form1" class="table" style="background-color: #f5f5f5;margin-top: 10px;margin-left: 20px;margin-right: 20px;" >
  <h2>Week </h2>
    <div id="chart-weekly"style="position: none;">
      
    </div>
      <input type="submit" name="days" value="Day" onclick="button1()">
   <input type="submit" class="active" name="weeks" value="Week" onclick="button2()">
   <input type="submit" name="month" value="Month" onclick="button3()">
  <input type="submit" class="active" name="Year" value="Year" onclick="button4()">
 
  </div>

  <div id="form2" class="table" style="background-color: #f5f5f5;margin-top: 10px;margin-left: 20px;margin-right: 20px;">
  <h2>Month</h2>
    <div id="chart-monthly" style="position: none;">
    
    </div>
      <input type="submit" name="days" value="Day" onclick="button1()">
   <input type="submit" name="weeks" value="Week" onclick="button2()">
   <input type="submit" class="active" name="Month" value="month" onclick="button3()">
  <input type="submit" class="active" name="Year" value="Year" onclick="button4()">
  </div> 
  <div id="form3" class="table" style="background-color: #f5f5f5;margin-top: 10px;margin-left: 20px;margin-right: 20px;">
  <h2>Year</h2>
    <div id="chart-yearly" style="position: none;">
    
    </div>
      <input type="submit" name="days" value="Day" onclick="button1()">
   <input type="submit" name="weeks" value="Week" onclick="button2()">
   <input type="submit"  name="month" value="Month" onclick="button3()">
  <input type="submit" class="active" name="Year" value="Year" onclick="button4()">
 
  </div> 
   <!--table of sales-->
  
  <div class="con" style=" background-color: #f5f5f5; margin-top: 10px; margin-left: 20px;margin-right: 20px;">
    <h1 style="text-align: center;">Store Product</h1>
    <br><br>
    <CENTER><i class="fa fa-download"></i><button id="download-excel">Excel</button>
    <button onclick="PdfDownload('Product Info')">PDF</button></CENTER>
  <table id="mytable" style="text-align: center;">
    <thead>
      <tr>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>product Color</th>
        <th>product Size</th>
        <th>product Brand</th>
        <th>Product Category</th>
        <th>Product Cost</th>
        <th>Product Quantity</th>
        <th>Product Price</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $db = mysqli_connect("localhost","root","","storenewdb");
        $sqli = "SELECT * FROM available_product ORDER BY product_category";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            while ($res=mysqli_fetch_assoc($result)) {
              echo "
                <tr>
                <td style = 'text-align:left'>".$res['product_code']."</td>
                <td style = 'text-align:left'>".$res['product_name']."</td>
                <td style = 'text-align:left'>".$res['product_color']."</td>
                <td style = 'text-align:left'>".$res['product_size']."</td>
                <td style = 'text-align:left'>".$res['product_brand']."</td>
                <td style = 'text-align:left'>".$res['product_category']."</td>
                <td>".$res['product_cost']."</td>
                <td>".$res['product_quantity']."</td>
                <td>".$res['product_new_price']."</td>    
                
                
              "; 
            }
          }?>
               </tr>
      
    </tbody>
  </table>
</div>

<!--LOW stock-->
<div class="con" style=" background-color: #f5f5f5; margin-top: 10px; margin-left: 20px;margin-right: 20px;">
    <h1 style="text-align: center;">Low Stock Product</h1>
    <br><br>
    <CENTER><i class="fa fa-download"></i><button id="low-download-excels">Excel</button>
    <button onclick="lowPdfDownloads('low stock Product ')">PDF</button></CENTER>
  <table id="low-mytables" style="text-align: center;">
    <thead>
      <tr>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>product Color</th>
        <th>product Size</th>
        <th>product Brand</th>
        <th>Product Category</th>
        <th>Product Quantity</th>
        <th>Product Price</th>
        
      </tr>
    </thead>
    <tbody>
      <?php
      $db = mysqli_connect("localhost","root","","storenewdb");
        $sqli = "SELECT * FROM available_product WHERE product_quantity >= '1' and product_quantity <= '10'  ORDER BY date_time desc";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            while ($res=mysqli_fetch_assoc($result)) {
              echo "
                <tr >
                <td style = 'text-align:left'>".$res['product_code']."</td>
                <td style = 'text-align:left'>".$res['product_name']."</td>
                <td style = 'text-align:left'>".$res['product_color']."</td>
                <td style = 'text-align:left'>".$res['product_size']."</td>
                <td style = 'text-align:left'>".$res['product_brand']."</td>
                <td style = 'text-align:left'>".$res['product_category']."</td>
                <td>".$res['product_quantity']."</td>
                <td>".$res['product_new_price']."</td>    
                
                
              "; 
            }
          }?>
               </tr>
      
    </tbody>
  </table>
</div>
<!--out of stock-->
<div class="con" style=" background-color: #f5f5f5; margin-top: 10px; margin-left: 20px;margin-right: 20px;">
    <h1 style="text-align: center;">Out of Stock Product</h1>
    <br><br>
    <CENTER><i class="fa fa-download"></i><button id="download-excels">Excel</button>
    <button onclick="PdfDownloads('Product Info')">PDF</button></CENTER>
  <table id="mytables" style="text-align: center;">
    <thead>
      <tr>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>product Color</th>
        <th>product Size</th>
        <th>product Brand</th>
        <th>Product Category</th>
        <th>Product Cost</th>
        <th>Product Quantity</th>
        <th>Product Price</th>
        
      </tr>
    </thead>
    <tbody>
      <?php
      $db = mysqli_connect("localhost","root","","storenewdb");
        $sqli = "SELECT * FROM available_product WHERE product_quantity = '0'  ORDER BY date_time desc ";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            while ($res=mysqli_fetch_assoc($result)) {
              echo "
                <tr >
                <td style = 'text-align:left'>".$res['product_code']."</td>
                <td style = 'text-align:left'>".$res['product_name']."</td>
                <td style = 'text-align:left'>".$res['product_color']."</td>
                <td style = 'text-align:left'>".$res['product_size']."</td>
                <td style = 'text-align:left'>".$res['product_brand']."</td>
                <td style = 'text-align:left'>".$res['product_category']."</td>
                <td>".$res['product_cost']."</td>
                <td>".$res['product_quantity']."</td>
                <td>".$res['product_new_price']."</td>    
                
                
              "; 
            }
          }?>
               </tr>
      
    </tbody>
  </table>
</div>
  
  </div><br><br><br>
 <!--table js-->   
<script>
    $(document).ready( function () 
    {
    $('#mytable').DataTable();
    } 
    );
    </script>
<script>
    $(document).ready( function () 
    {
    $('#mytables').DataTable();
    } 
    );
    </script>
<script>
    $(document).ready( function () 
    {
    $('#low-mytables').DataTable();
    } 
    );
    </script>
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

<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>  

<script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
   <!-- <script type="text/javascript">
      var ctx = document.getElementById("chartjs_pie").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                                "#ffef00",
                                "lightblue",
                               "#ff0000",
                                "blue",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
  -->
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'time',
 ykeys:['TotalSales'],
 labels:['Quantity'],
 hideHover:'auto',
 stacked:true
}
);
</script>
    <script>
Morris.Bar({
 element : 'charts',
 data:[<?php echo $chart_daily; ?>],
 xkey:'time',
 ykeys:['TotalSales'],
 labels:['total'],
 hideHover:'auto',
 stacked:true
}
);
</script>
   <script>
Morris.Bar({
 element : 'chart-weekly',
 data:[<?php echo $chart_weekly; ?>],
 xkey:'time',
 ykeys:['TotalSales'],
 labels:['total'],
 hideHover:'auto',
 stacked:true
}
);
</script>
   <script>
Morris.Bar({
 element : 'chart-monthly',
 data:[<?php echo $chart_monthly; ?>],
 xkey:'time',
 ykeys:['TotalSales'],
 labels:['total'],
 hideHover:'auto',
 stacked:true
}
);
</script>

   <script>
Morris.Bar({
 element : 'chart-yearly',
 data:[<?php echo $chart_yearly; ?>],
 xkey:'time',
 ykeys:['TotalSales'],
 labels:['total'],
 hideHover:'auto',
 stacked:true
}
);
</script>
<script>
  document.getElementById('download-excel').addEventListener('click',function() {
       var table2excel = new Table2Excel();
       table2excel.export(document.querySelectorAll("#mytable"));
  });
</script>
<!--out of-->
<script>
  document.getElementById('download-excels').addEventListener('click',function() {
       var table2excel = new Table2Excel();
       table2excel.export(document.querySelectorAll("#mytables"));
  });
</script>
<!--low stocl-->
<script>
  document.getElementById('low-download-excels').addEventListener('click',function() {
       var table2excel = new Table2Excel();
       table2excel.export(document.querySelectorAll("#low-mytables"));
  });
</script>
<script type="text/javascript">
function PdfDownload(filename)
{
  kendo.drawing.drawDOM($("#mytable")).then(function(group){
    return kendo.drawing.exportPDF(
      group,{
        paperSize:"auto",
        margin:{
          left:"1cm",
          right:"1cm",
          top:"1cm",
          botton:"1cm",

        }
      })
  })
  .done(function(data){
    kendo.saveAs({
      dataURI:data,
      fileName:filename
    })
  });
}
</script>
<!--out of-->
<script type="text/javascript">
function PdfDownloads(filename)
{
  kendo.drawing.drawDOM($("#low-mytables")).then(function(group){
    return kendo.drawing.exportPDF(
      group,{
        paperSize:"auto",
        margin:{
          left:"1cm",
          right:"1cm",
          top:"1cm",
          botton:"1cm",

        }
      })
  })
  .done(function(data){
    kendo.saveAs({
      dataURI:data,
      fileName:filename
    })
  });
}
</script>
<!--low stock-->
<script type="text/javascript">
function lowPdfDownloads(filename)
{
  kendo.drawing.drawDOM($("#low-mytables")).then(function(group){
    return kendo.drawing.exportPDF(
      group,{
        paperSize:"auto",
        margin:{
          left:"1cm",
          right:"1cm",
          top:"1cm",
          botton:"1cm",

        }
      })
  })
  .done(function(data){
    kendo.saveAs({
      dataURI:data,
      fileName:filename
    })
  });
}
</script>
<script>
  document.getElementById("form1").style.display = "none";
  document.getElementById("form2").style.display = "none";
  document.getElementById("form3").style.display = "none";

 function button1() {
  document.getElementById("form").style.display = "block";
  document.getElementById("form1").style.display = "none";
  document.getElementById("form2").style.display = "none";
  document.getElementById("form3").style.display = "none";
}
function button2() {
  document.getElementById("form").style.display = "none";
  document.getElementById("form1").style.display = "block";
  document.getElementById("form2").style.display = "none";
  document.getElementById("form3").style.display = "none";
}
function button3() {
  document.getElementById("form").style.display = "none";
  document.getElementById("form1").style.display = "none";
  document.getElementById("form2").style.display = "block";
  document.getElementById("form3").style.display = "none";
}
function button4() {
  document.getElementById("form").style.display = "none";
  document.getElementById("form1").style.display = "none";
  document.getElementById("form2").style.display = "none";
  document.getElementById("form3").style.display = "block";
}
</script>

   </body>
</html>
