<?php
 
session_start();
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}?>
<!DOCTYPE html>
<html>
<head>
        <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">

	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     
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
.button
{
	    background: #f0f0f0;
    height: 40px;
    text-align: center;
}
button
{
	margin-top: 5px;
	height: 30px;
    width: 250px;
} 
.button1
{
	background-color:green
} 
#activate-div:checked ~ label 
.button1
{
	background-color:green;
}

.button2
{
	background-color:green;
} 
#activate-div:checked ~ label 
.button2
{
	background-color:green;
}

.button3
{
	background-color:green;
} 
#activate-div:checked ~ label 
.button3
{
	background-color:green;
}

.button14
{
  background-color:green;
}
table
{
  margin-top: 10px;
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


<div id="box">
	<div class="button">
	<button class= "button1" onclick="button1()" >Sales Report</button>
	<button onclick="button2()">Bad Product Report</button>
	<button onclick="button3()">Expenses Report</button>
  <button onclick="button14()">Report</button>
	</div>
  
	<?php
		include('sales_report.php');
  ?>
  
</div>

<div id="box1">
	<div class="button">
	<button onclick="button1()">Sales Report</button>
	<button class= "button2" onclick="button2()">Bad Product Report</button>
	<button onclick="button3()">Expenses Report</button>
  <button onclick="button14()">Report</button>
	</div>
	<?php
		include('losses_report.php');
	?>
</div>
<div id="box2">
	<div class="button">
	<button onclick="button1()">Sales Report</button>
	<button onclick="button2()">Bad Product Report</button>
	<button class= "button3" onclick="button3()">Expenses Report</button>
  <button onclick="button14()">Report</button>
	</div>
	<?php
		include('expenses_report.php');
	?>
</div>

<div id="box3">
  <div class="button">
  <button onclick="button1()">Sales Report</button>
  <button onclick="button2()">Bad Product Report</button>
  <button  onclick="button3()">Expenses Report</button>
  <button class= "button3"onclick="button14()">Report</button>
  </div>
  <?php
    include('all-report.php');
  ?>
</div>



<script type="text/javascript">
 	document.getElementById("box").style.display = "block";
  document.getElementById("box1").style.display = "none";
  document.getElementById("box2").style.display = "none";
  document.getElementById("box3").style.display = "none";

  function button1() {
  document.getElementById("box").style.display = "block";
  document.getElementById("box1").style.display = "none";
  document.getElementById("box2").style.display = "none";
  document.getElementById("box3").style.display = "none";

  }
 function button2(){
 	document.getElementById("box").style.display = "none";
 	document.getElementById("box1").style.display = "block";
 	document.getElementById("box2").style.display = "none";
  document.getElementById("box3").style.display = "none";
}
 function button3(){
 	document.getElementById("box").style.display = "none";
 	document.getElementById("box1").style.display = "none";
 	document.getElementById("box2").style.display = "block";
  document.getElementById("box3").style.display = "none";
 	
 }
 function button14(){
  document.getElementById("box").style.display = "none";
  document.getElementById("box1").style.display = "none";
  document.getElementById("box2").style.display = "none";
  document.getElementById("box3").style.display = "block";
  
 }

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

</body>
</html>