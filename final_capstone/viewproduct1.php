<?php
$db = mysqli_connect("localhost","root","","storedb"); 
if (isset($_POST['request'])) 
{
    $id = $_POST['request'];
    $storename = "PLP_DRYGOODS";
         $sqli = "INSERT INTO request_of_other_store(`product_code`, `product_name`, `product_color`, `product_size`, `product_quantity`, `product_price`,`store_name`)
          SELECT  `product_code`, `product_name`, `product_color`, `product_size`,`product_quantity`, `product_new_price`,'PLP DRYGOODS' FROM available_product where id= $id
         ";
         $sqli = mysqli_query($db,$sqli);
        
}
?>
 <!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" type="text/css" href="css/viewproduct.css">
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
.con
{
  width: 100%;
  height: 100%;
  position: absolute;
  background-color: white;
}
header
{
  height: 50px;
  width: 1280px;
  background-color: blue;
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
  padding-top: 10px;
  background-color: #e8e8e8;
  height: 500px;
  width: 1280px;
  /* display: flex; */
  justify-content: center;
  /* grid-column-gap: 50px; */
  /* grid-row-gap: 50px; */
  overflow: scroll;
}
img
{
  height: 100px;
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
  position: absolute;
  top: 5px;
  left: 50px;
  height: 40px;
  width: 250px;
}
      </style>
  </head>
  <body>
            <div class="con">
      <div class="btn" id="btn">
        <i class="fa fa-bars" aria-hidden="true" ></i>
      </div>
      <nav class="sidebar">
         <div class="text">
      <div class="btn" id="btn">
        <i class="fa fa-times" aria-hidden="true" ></i>
      </div>
      <p style="font-weight: bold;">EMPLOYEE</p> 
         </div>
         <ul>
            <li class="active"><a href="dashboard">Dashboard</a></li>
            <li>
               <a href="#" class="feat-btn">PRODUCT
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="product.php">ADD PRODUCT</a></li>
                  <li><a href="viewproduct.php">VIEW PRODUCT</a></li>
                  
               </ul>
            </li>
            <li>
               <a href="#" class="serv-btn">TRANSACTION
               <span class="fas fa-caret-down second"></span>
               </a>
               <ul class="serv-show">
                  <li><a href="transaction.php">Transaction</a></li>
                  <li><a href="expenses.php">EXPENSES</a></li>
                  <li><a href="return.php">Return Product</a></li>

               </ul>
            </li>
            <li>
               <a href="#" class="view-btn">VIEW OTHER STORE
               <span class="fas fa-caret-down forth"></span>
               </a>
               <ul class="view-show">
                  <li><a href="fetch1.php">Dyna's DRYGOODS</a></li>
                  
               </ul>
            </li>
            <li>
               <a href="#" class="sale-btn">HISTORY
               <span class="fas fa-caret-down third"></span>
               </a>
               <ul class="sale-show">
                  <li><a href="transactionhistory.php">TRANSACTION HISTORY</a></li>
                  <li><a href="expenseshistory.php">EXPENSES HISTORY</a></li>
                  <li><a href="historyhistory.php">NEW PRODUCT HISTORY</a></li>
               </ul>
            </li>
            <li><a href="employee.php">ADD EMPLOYEE</a></li>
            <li><a href="account.php">ACCOUNT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
         </ul>
      </nav>
<!--sidebar-->


    <body>
          <header>
             <input class="search_input" type="text" id = "search_text" name="search_text" placeholder="Search Code or Name"  >
 
          </header>

  
 <!--end of php search box-->
        
   <div class="container" 
  style="
  margin-top:10px; 
  padding-left: 10px;
    grid-column-gap: 50px;
    grid-row-gap: 50px;
    overflow: scroll;
 ">
   
   <div id="result" class="box" 
   style=" 
   display: grid;
    grid-template-columns: auto auto auto auto;
    
    width: 1280px;
    padding-left: 70px;
   ">
  
       <!--eto yung white-->
     <div  class="card" 
     style="

      margin-bottom: 80px;
      height: 310px;
      width: 230px;
      background-color: white;
     " >

  
      </div>    
  
     </div>
   </div>
    </body>


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
   url:"fetch1.php",
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
<script type="text/javascript">
  /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
  </body>
 </html>

