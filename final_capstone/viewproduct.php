<?php

  session_start();
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}
    $db = mysqli_connect("localhost","root","","storenewdb");
    

$query = "SELECT transaction_id FROM transaction_total ORDER BY transaction_id DESC";
$result = mysqli_query($db,$query);
if (mysqli_num_rows($result)) {
  # code...

$row = mysqli_fetch_array($result);
  $lastid = $row['transaction_id'];
if(empty($lastid))
{
    $number = "Transaction-000000001";
}
else
{
      $idd = str_replace("Transaction-", "", $lastid);
      $id = str_pad($idd + 1, 9, 0, STR_PAD_LEFT);
      $number = 'Transaction-'.$id;
}
}
else
{
  $number = 'Transaction-000000001';
}

if (isset($_POST['add'])) 
{
  $msg = "";
  $failed = "";
    $id = $_POST['add'];
    $Quantity = $_POST['quantity'];

         $sqli = "INSERT INTO transaction(`product_id`,`transaction_id`,`product_code`, `product_name`, `product_color`, `product_size`, `product_price`, `product_quantity`,`sub_total`, `total`, `product_brand`, `product_category`)
          SELECT  `id`,'$number',`product_code`, `product_name`, `product_color`, `product_size`,`product_new_price`,$Quantity,(`product_new_price`* $Quantity), (`product_new_price`* $Quantity), `product_brand`, `product_category` FROM available_product where id= $id
         ";
         $sqli = mysqli_query($db,$sqli);
        if ($sqli) {
          $_SESSION['alertos'] = "item was successfully added";
        }
        else
        {
        $failed = "not successfully added to transaction";
        
}
}
 ?>

 <!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/7a6b82ce11.js" crossorigin="anonymous"></script> 
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
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
  position: absolute;
  top: 1px;
  left: 2px;
  height: 45px;
  width: 45px;
  font-size: 30px;
  text-align: left;
  border-radius: 3px;
  cursor: pointer;
  transition: left 0.4s ease;
}
.btn span{
  color:black;
  font-size: 28px;
  line-height: 23px;
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
nav ul .view-show.show3{
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

header
{
  height: 50px;
  width: 100%;
  background-color: #034f84;
}


}
.dropbtn i
{
  cursor: pointer;
  margin-top: 10px;
  font-size: 30px;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: blue;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.btn:hover {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropbtn:hover {
  background-color: blue;
}




 .container
{
  padding-top: 20px;
  background-color: #e8e8e8;
  height: 100%;
  width: 100%;
}
img{
  
  
}
        /* Dropdown Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
.search_input
{
  margin-top: -59px;
  margin-right: 75px;
  float: right;
  height: 40px;
  width: 250px;
}
#dropdown01{
  font-size: 13px;
  position: absolute;
  left: 900px;
  color: white;
  letter-spacing: 1px;
  
}
.card {
  
  width: 900px;
position:static ;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-ms-flex-direction: column;
flex-direction: column;
min-width: 0;
word-wrap: break-word;
background-color: #fff;
background-clip: border-box;
border: 1px solid rgba(0,0,0,.125);
border-radius: .25rem;
text-align: center;
}

h3{
  text-align: initial;
  margin-left: 30px;
  font-size: 13px;
}
button{
  border-radius: 5px;
  width: 80px;
  background-color: #4CAF50;
  color: white;
}
@media (min-width: 1200px) {
.container {
max-width: 100%;
}
}
@media (min-width: 992px) {
.container {
max-width: 100%;
}
}
@media (min-width: 576px) {
.container {
max-width: 100%;
}
}
@media (min-width: 768px) {
.container {
max-width: 100%;
}
}
      </style>
  </head>
  <body>
            <div class="con">
      <div class="btn" id="btn" style="color: white;">
        <i class="fa fa-bars" aria-hidden="true" ></i>
      </div>
      <nav class="sidebar">
         <div class="text">
      <div class="btn" id="btn">
        <i class="fa fa-times" aria-hidden="true" ></i>
      </div>
      <br>
      <p style="font-weight: bold;">Sales&Inventory</p> 
         </div>
         <ul>
            <li class="active"><a href="dashboard.php">Dashboard</a></li>
            <li>
               <a href="#" class="feat-btn">PRODUCT
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="productpage.php">ADD PRODUCT</a></li>
                  <li><a href="viewproduct.php">VIEW PRODUCT</a></li>
                  <li><a href="print_barcode.php" style="font-size: 16px;">BARCODE PRODUCT</a></li>
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
            <li><a href="history.php">HISTORY</a></li>
            
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

      <p style="color: white;font-size: 25px; font-weight: bold;padding: 8px; margin-left: 50px;" ><?php include("php/store_name.php")?></P>
             <center><input class="search_input" type="text" id = "search_text" name="search_text" placeholder="Search Code or Name"  >  
  </header>
     <?php if (isset($_SESSION['alertos'])): ?>
      <script type="text/javascript">
        swal({
        title: "Product added successfully!",
        text: "click the button to exit!",
        icon: "success",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['alertos']);
          ?>
      <?php endif;?>
     
  

    <body>
      <!--end of php search box-->
        
   <div class="container" >
   
   <div id="result" class="box" 
   style=" 
   display: grid;
    grid-template-columns: auto auto auto ;
    
    width: 100%;
    padding-left: 80px;
   ">
  
       <!--eto yung white-->
     <div  class="card" 
     style="

      margin-bottom: 80px;
      height: 310px;
      width: 900px;
      background-color: white;
     " >

  
      </div>    
  
     </div>
   </div>
    </body>
  
<script type="text/javascript"></script>
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
           $('.view-btn').click(function(){
             $('nav ul .view-show').toggleClass("show3");
             $('nav ul .forth').toggleClass("rotate");
           });
            $('.sale-btn').click(function(){
             $('nav ul .sale-show').toggleClass("show2");
             $('nav ul .third').toggleClass("rotate");
           });
          
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
      </script>
      <script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="javascript/prevent_resub.js"></script>
  </body>
 </html>

