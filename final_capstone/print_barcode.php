<?php 
session_start();
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}
$connect = mysqli_connect("localhost", "root", "","storenewdb");

$productname = '';
$productcolor = "";
$productsize = "";
$submit = '';
$productquantity = '';
$productbrand = '';
$productcode = '';
$total = '';
$productprice = '';
if(isset($_POST['search']))
{
    $productcode = $_POST['productcode'];
    $query = "SELECT * FROM `available_product`   WHERE `product_code` = '$productcode'";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) >0)
    {
      while ($row = mysqli_fetch_array($result))
      {   
          $productcode = $row['product_code'];
          $productname = $row['product_name'];
          $productcolor = $productcolor."<option value = '".$row['product_color']."'>$row[product_color] </option>";
          $productsize =$productsize."<option value = '".$row['product_size']."''>$row[product_size]</option>";
          $productquantity = $row['product_quantity'];
          $productprice = $row['product_new_price'];

      }  
    }
    
    // if the id not exist
    // show a message and clear inputs
    else {
        echo "Undifined ID";
          $productcode  = "";
          $productname = "";
          $productcolor = "";
          $productsize = "";
          $productclass = "";
          $productcategory = "";
          $productprice = "";
    }
    
    
    
}
?>

<!DOCTYPE html>
<html>
<head>
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
   
	<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      
	<style type="text/css">
		      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  user-select: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  text-decoration: none;
  color: black;
  font-weight: bold;
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

		.information
		{
			display: block;


		}
		label
		{
			display: block;
		}
		.box
		{
			padding-left: 5px;
			background-color: #f0f0f0;
			width: 350px;
			height: 565px;
			box-shadow: black 2px 2px 2px; 

		}
		.display
		{
			margin-top: 50px;
			background-color: #f0f0f0;
			position: absolute;
			left: 380px;
			top: 0px;
			margin-left:-20px;
			height: 565px;
			width: 910px;
		}
		.display h2,button
		{
			margin-left: 10px;
			margin-top: 10px;
		}
		.submit .save
		{
			margin-top: 10px;
			background-color: green;
			border-color: green;
			height: 35px;
			width: 200px;
			margin-left: 20%;
		}
		input[type="text"],select
		{
			height: 30px;
			width: 340px;
		}
		.barcode
		{
			column-count: 3;
		}
		@page
		{
			column-count: 3;
		}
	</style>
	<title>Print Barcode</title>
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
            <li ><a href="dashboard.php">DASHBOARD</a></li>
            <li>
               <a href="#" class="feat-btn">PRODUCT
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show" class="active">
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
        <p style="color: white;font-size: 25px; font-weight: bold;padding: 8px;" ><?php include("php/store_name.php")?></P>
    
  </header>
 <div class="box1">
 <div class="box">
 		<form method="POST">
 	
 		<h2>GET PRODUCT BARCODE</h2>
 	  <label style="display: block;">Code</label>
      <input style="width: 150px; height: 20px;" type="text" id="productcode" placeholder="search Product Code" id="productcode" name="productcode" value = "<?php echo $productcode;?>"style="display: inline-flex; width: 150px;">
      <button name="search" style="width: 50px; background-color: transparent; border-style: none; box-shadow: none;" ><i class="fa fa-search" aria-hidden="true"></i></button>
      <div class="information">
      	 <label>Color</label>
      
      <SELECT id="productcolor" name="productcolor"  ><?php echo $productcolor; ?></SELECT>
      <label>Size</label>
      <SELECT id="productclass" name = "productsize" ><?php echo $productsize; ?></SELECT>
     
         <label style="display: block;">Name</label>
     
      <input class= "information"  id="productname" type="text" readonly name="productname" value="<?php echo $productname;?>" readonly>

       <label>Product brand</label>    
      <input class= "information" readonly id="productcategory" type="text" name="productbrand"value="<?php echo $productbrand; ?>"readonly>

      <label>Quantity</label>
      <input  type="text" id="productquantity" name="productquantity" value="<?php echo $productquantity; ?>" >
       
       <label>Price</label>
      <input class= "information" readonly type="text" id="total" name="totals" value="<?php echo $productprice;?>"readonly>
      
      </div>
      <div class="submit">
      <input class="save" style="color: white"  type="submit" name="submit_product" value="Print Barcode">
      </div>
 	</form>
 	</div>
 <div class="display" style="">
 	<h2>BARCODE</h2>
 	<a style="margin-left: 10px; text-decoration: underline; " href="javascript:void(0);" id="printButton">Print</a> 
 	<div class="barcode" id="barcode">
 		<?php
$getbarcode = '';

	$connect = mysqli_connect("localhost", "root", "","storenewdb");
	if (isset($_POST['submit_product'])) {
		$quantity = $_POST['productquantity'];
		$productcode = $_POST['productcode'];
		$productname = $_POST['productname'];
		$productcolor = $_POST['productcolor'];
		$productsize = $_POST['productsize'];
		$sql = "SELECT * FROM available_product WHERE product_code = '$productcode' AND product_name = '$productname' AND product_color = '$productcolor' AND product_size = '$productsize' ";
		$run = mysqli_query($connect,$sql);
		if ($run) {
			# code...
		
		while ($res = mysqli_fetch_assoc($run)) {
			for($i= 1; $i<=$quantity; $i++)
				{
				echo "
				<figcaption style='font-size:10px;'>Code:".$res['product_code']."
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;
                     


                     Price:".$res['product_new_price']."</figcaption>
				<img class='img' src='barcode/".$res['barcode']."' style='height:50px;width:200px;'>
				<figcaption style='  letter-spacing: 11px;'>".$res['barcode_con']."</figcaption>
				";
				}
			}
		}
		else
		{
			echo "failed";
		}
	}
?>
 	</div>

 </div>
 </div>
 
 <script type="text/javascript">
	
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
$(document).ready(function(){
    $("#printButton").click(function(){
    	document.getElementById("barcode").style.cssText = "column-count:3;margin-left:30PX;";
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("div.barcode").printArea( options );

    });
});
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
</body>
</html>