<?php  
session_start();
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}                $con = mysqli_connect("localhost","root","","storenewdb") or die("not connect");
              if (isset($_POST['delete'])) {
              $id = $_POST['delete'];
               $stmt = $con->prepare("DELETE FROM `expenses` WHERE id = $id");
               $run = $stmt->execute();
                  if ($run) {
                    $_SESSION['delete'] = "transaction complete";
         
                  }
                  else
                  {
                    echo "failed ";
                  }
      
          }

?>
 <!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
   
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
   <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
   text-decoration: none;
  
  margin: 0;
  padding: 0;
  user-select: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.btn{
  position: absolute;
  top: 1px;
  left: 0px;
  height: 45px;
  width: 45px;
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
  height: 600px;
  position: absolute;
  background-color: red;
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


button
{
  padding: 1px 25px;
  font-size: 20px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: white;
  background-color: green;
  border: none;
  
}
table button
{
}
button:hover {background-color: #3e8e30}
/*header*/
/*box*/
.form
{
   display: flex;
   align-content: space-between;
}
{
   display: none;
}
.p
{
   color: red;
}
.box
{  
   margin-left: 10px;
   border-color: gray;
   border-style: solid;
   border-width: 2px;
   padding: 10px 40px;
   margin-top: 10px;
   background-color:#F0F0F0;
   width: 500px;
   height: 540px;
}


h3
{
   font-weight: bold;
}
.content
{  
   border-style: solid;
   border-width: 2px;
   border-color: gray;
   width: 380px;
   height: 350px;
   background-color: #f0f0f0;

    box-shadow: 5px 5px 5px black, 10px 10px 10px grey;
}
/*form label input*/

select
{
   font-weight: bold;
   margin-left: 10px;
   width: 335px;
   height: 28px;
   transition:1s;
}
select:focus
{

   border-color: blue;
   width: 338px;
   height: 30px;
   box-shadow: 10px 5px 10px #6b6b6b;
}
input
{
   width: 330px;
   height: 28px;
   
}
input:focus
{
   border-color: blue;
   width: 333px;
   height: 30px;
   box-shadow: 10px 5px 10px #6b6b6b;
}
label
{
   font-size: 20px;
   font-weight: bold;
   margin: 10px;
}
label,input
{

   margin-left: 10px;
}
/*end form label input*/
/*end box*/
/*table*/
.table
{
   border-style: solid;
   border-width: 2px;
   border-color: gray;
   background-color:#F0F0F0;
   margin: 10px;
   height: 539px;
   width: 100%; 
   overflow-y: auto;

}
table
{
    font-size: 20px;
    background-color:#F0F0F0;
    width: 100%;
    max-height: 350px;
    padding-right: 1px;
   margin-right: 40px;
    overflow: scroll;
}
th,td
{
   text-decoration: none;
   text-align: center;
}
/*end table*/
@media screen and (max-width: 800px) 
{
   button
   {
   font-size: 8px;
   height: 23px;
   width: 50px;
   }
   button:focus
   {
   font-size: 7px;
   height: 21px;
   width: 48px;
}
.button
{
   margin-left: 1000px;
}
/*input*/
.form
{
   display:inline-block;
}
.box
{
   position: absolute;
   padding: 10px;
   margin-left: 10px;
   margin-top: 10px;
   background-color: blue;
   width: 370px;
   height: 550px;
}
h1
{
   font-weight: bold;
   font-size: 20px;
}
.content
{
   overflow-y: scroll;
   width: 338px;
   height: 380px;
   background-color: white;
}
/*end input form*/
select
{
   margin-top: 5px;
   font-weight: bold;
   margin-left: 10px;
   width: 165px;
   height: 28px;
   transition:1s;
}
select:focus
{

   border-color: blue;
   width: 338px;
   height: 30px;
   box-shadow: 10px 5px 10px #6b6b6b;
}
input
{
   width: 220px;
   height: 20px;
   
}
input:focus
{
   border-color: blue;
   width: 230px;
   height: 30px;
   box-shadow: 10px 5px 10px #6b6b6b;
}
label
{
   display: block;
   font-size: 15px;
   font-weight: bold;
   margin: 5px;
}
label,input
{

   margin-left: 10px;
}

table
{
   overflow-y: scroll;
   width: 320px;
   height: 380px;
}
td a{
   text-decoration: none;
}

 </style>


	<title>Store Expenses</title>
</head>
<body>
	       <div class="btn" id="btns">
         <span class="fas fa-bars" style="margin-left: 10px;margin-top: 12px; color: white;"></span>
      </div>

      <nav class="sidebar">
         <div class="text">

      <div class="btn" id="btn">
         <span class="fa fa-times" style="color: white"></span>

      </div>
      <br>
      
      <p>Sales&Inventory</p>
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
                  <li><a href="print_barcode.php" style="font-size: 16px">BARCODE PRODUCT</a></li>
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
           <li><a href="employee.php">ADD MANAGER</a></li>
            <li><a href="user_profile.php">ACCOUNT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
         </ul>
      </nav>
      <!--end of sidebar-->
	
	<header>
		<div class="button" style="color: white;">
         <p style="color: white;font-size: 25px; font-weight: bold;padding: 8px;margin-left: 60px;" ><?php include("php/store_name.php")?></P>
   
	</header>
     <?php if (isset($_SESSION['status'])): ?>
      <script type="text/javascript">
        swal({
        title: "Expenses Added Successfully!",
        text: "click the button to exit!",
        icon: "success",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['status']);
          ?>
        </div>
      <?php endif;?>
     <?php if (isset($_SESSION['delete'])): ?>
      <script type="text/javascript">
        swal({
        title: "Successfully Deleted Successfully!",
        text: "click the button to exit!",
        icon: "success",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['delete']);
          ?>
        </div>
      <?php endif;?>
     
	<!-- user input-->
<!--form 3-->
<div id="form2">
	<div class="form">
	<div id="box1"class="box">
		<i class="fa fa-times" onclick="button7()"></i>
		<h1>Store Expenses</h1>
		<div class="content">
		<!--expenses-->
		<form action="php/expenses.php" method="POST" style="background-color: #f0f0f0">
			<label>Reason</label>
      <input type="text" name="reason">
			<label>Cost</label>
			<input type="text" name="cost" placeholder="how much you spend">
         <br><br><br>
			<center><button type="submit" name="submit">SUBMIT</button>
		</form>
		</div>
	</div>
	<div class="table">
		<center><h1>Expenses Table &nbsp;&nbsp;&nbsp;<button class="open"  onclick="button8()">Add</button></h1>
	<table span= "">
    <thead>
			<tr >
     		<th >reason</th>
     		<th>Cost</th>
     		<th>Time</th>
     		    <th>Action</th>
     	</tr>
     </thead>
			<?php 

			$db = mysqli_connect("localhost","root","","storenewdb");
     		$sqli = "SELECT * FROM expenses where date(date_time) = date(curdate()) ORDER BY date_time  desc";
     		$result =mysqli_query($db,$sqli);
     			$num = mysqli_num_rows($result);
     			if($num>0){
     				while ($res=mysqli_fetch_assoc($result)) {
              $ts = $res['date_time'];
              $ntimes = date('h:i:A',strtotime($ts));
       
     					echo "
     						<tr>

     						<td>".$res['reason']."</td>
     						<td>".$res['cost']."</td>
     						<td>".$ntimes."</td>
                   

     					";
              ?>
              <form method="post">
               <td><button type="submit" name="delete" value="<?= $res['id'];?>">Delete</button>
               </td>
               </form>
                </tr>

              <?php
     				}
     			}
     	 ?>
     	</table>
	</div>
</div>
</div>
<!--form 3-->

<script src="javascript/box.js"></script>
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