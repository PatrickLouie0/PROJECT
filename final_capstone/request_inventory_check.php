<?php 
session_start();
include('request_inventory_query.php');
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}
include('request_inventory_query.php');
?>
 
<!DOCTYPE html>
<html>
<head>
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
   
	       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
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
.table-request
{
	background-color: #f0f0f0;
	padding-bottom: 10px;
	margin-bottom: 80px;
}
table
{
	margin-left: 20px;
	border-collapse: collapse;
	margin-right: 30px;
}
.mytable
{
	margin-bottom: 100px;
}
th,td
{
	padding-left: 50px;
}
th
{
	border-bottom-style: double;
}
td
{
	border-bottom-style: solid;
}
thead
{
	font-size: 15px;
}
tbody
{
	font-size:12px;
}
.box1
{
	display: none;
}
.view_older
{
  margin-bottom: 100px;
}
/*end of sidebar css*/

	</style>
	<title>Request</title>
</head>
<body>




	    <?php if (isset($_SESSION['check'])): ?>
      <script type="text/javascript">
        swal({
        title: "The request to check the product stock has been send....",
        text: "click the button to exit!",
        icon: "success",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['check']);
          ?>
      <?php endif;?>







	 <nav class="sidebar">
         <div class="text">

      <div class="btn" id="btn">
         <i class="fa fa-times" aria-hidden="true"></i>
      </div>
      <p>Sales&Inventory</p>
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
                  <li><a href="transaction.php">Transaction</a></li>
                  <li><a href="expenses.php">EXPENSES</a></li>
                  <li><a href="returnproduct.php">Return Product</a></li>
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

		<a href="request_inventory_form.php"><button style="background-color: green; font-weight: bold;margin-bottom: 5px;height: 50px;color: white;padding-bottom: 5px;">Request Stock Check</button></a>
	<?php
	include('request_inventory_table.php');
	
	?>
	

<script type="text/javascript">
 function open() {
  document.getElementById("box1").style.display = "block";
  }
 function close(){
 	document.getElementById("box1").style.display = "none";
 	
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
<script type="text/javascript">
	
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>