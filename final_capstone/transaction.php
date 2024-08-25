<?php 
session_start();
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}
  $casher = $_SESSION['user-manager'];  


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "storenewdb";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>
<?php
$lastname = '';
$fullname = '';
$connect = mysqli_connect("localhost","root","","store_member");
$query = "SELECT lastname,firstname FROM manager WHERE username = '$casher'  ORDER BY date_time DESC LIMIT 1;";
$run = mysqli_query($connect,$query);
while ($rest = mysqli_fetch_array($run))
      {      
$lastname = $rest['lastname'];
$firstname = $rest['firstname'];
$fullname = $firstname.$lastname;

}
?>
<?php

$query = "SELECT transaction_id FROM transaction_total ORDER BY transaction_id DESC";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)> 0) {
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
  $number = "Transaction-000000001";
}
?>

<?php
$output = '';
if(isset($_POST['submitpayment']))
{  
  if ($_POST['total']> $_POST['payment']) {
  $_SESSION['payment-not-enough'] = "payment-not-enough";
         
  }
  else
  {

        $customer_name = strtoupper($_POST['customer_name']);
        $invoiceid = $_POST['invoiceid'];
        $subtotal = $_POST['stotal'];
        $discount = $_POST['discount'];
        $total = $_POST['total'];
        $payment = $_POST['payment'];
        $change = $_POST['change']; 


    if(!$conn)
    {
        die("connection failed " . mysqli_connect_error());
    }
    else
    {
        $sql = "INSERT INTO `transaction_total`(`transaction_id`,`casher`,`customer_name`, `sub_total`, `discount`, `total`, `payment`, `changes`) VALUES ('$invoiceid','$fullname','$customer_name','$subtotal','$discount','$total','$payment','$change') ";
        
        if(mysqli_query($conn,$sql))
        {

            $query = "SELECT transaction_id FROM transaction ORDER BY transaction_id DESC";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
            $lastid = $row['transaction_id'];
            if(mysqli_num_rows($result) > 0)
            {
              $db = mysqli_connect("localhost","root","","storenewdb");
              $sqli = "SELECT * FROM transaction";
              $result =mysqli_query($db,$sqli);
              $num = mysqli_num_rows($result);
              if($num>0){
              while ($res=mysqli_fetch_assoc($result)) {
                $product_codes = $res["product_code"];
                $product_names = $res["product_name"];
                $product_quantitys = $res["product_quantity"];
                $product_prices = $res["product_price"];
                $product_totals = $res["total"];  
                $product_colors = $res["product_color"];
                $product_sizes = $res["product_size"];
                $product_classes = $res["product_brand"];
                $product_categorys = $res["product_category"];
              }
              }
            }

            if(empty($lastid))
            {
                $number = "Transaction-00001";
            }
            else
            {
                $idd = str_replace("Transaction-", "", $lastid);
                $id = str_pad($idd + 1, 5, 0, STR_PAD_LEFT);
                $number = 'Transaction-'.$id;
            }

        }
        else
        {
            echo "Record Faileddd";
        }
      }
    }
}
    ?>

    <?php  
                $con = mysqli_connect("localhost","root","","storenewdb") or die("not connect");
              if (isset($_POST['delete'])) {
              $id = $_POST['delete'];
               $stmt = $con->prepare("DELETE FROM `transaction` WHERE id = $id");
               $run = $stmt->execute();
                  if ($run) {
                    $_SESSION['deletes'] = "Item was Deleted!";
                  }
                  else
                  {
                    echo "failed ";
                  }
      
          }
?>
<?php 

require_once('transaction_query.php');
  $store->add_product_transaction();
  $store->end_of_transaction();
  $store->update_product_transaction();
?>
 <!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"> </script>  

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <link rel="stylesheet" type="text/css" href="">
      <style type="text/css">
.con
{
  background-color: #ebebeb;
}
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  user-select: none;
  box-sizing: border-box;
  /* font-family: 'Poppins', sans-serif; */
}
.btn{
  position: absolute;
  top: 5px;
  left: 2px;
  height: 45px;
  width: 45px;
  font-size: 30px;
  text-align: left;
  border-radius: 3px;
  cursor: pointer;
  transition: left 0.4s ease;
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
  height: 500px;
  background-color: ;
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
  margin-left: 450px;
}
button
{
  background-color: #4CAF50;
  color: black;
  font-weight: bold;
  height: 30px;
  width: 100px;
  border-radius: 5px;
  
}
button:hover {
  background-color: #3e8e41;}
/*header*/
/*box*/
.box
{
    background-color:#ffffff ;
    width: 1000px;
    padding: 5px;
    height: 320px;
}
 .table
{

    background-color: #ffffff;
    width: 1000px;
    margin-top: 5px;
    padding: 5px;
    overflow: scroll;

}
.table .tbody
{
  font-size: 20px;
    height: 200px;
}
.payment
{
    background-color: #ffffff;
    width: 267px;
    height: 550px;
    position: absolute;
    left: 1005px;
    top: 50px;
    padding: 5px;
    padding-bottom: 20px;
}
.payment .form_total
{
    position: absolute;
    column-count: 1;
    text-align: center;
}
.payment .form_total .lal
{
  display: block;
  text-align: left;
margin-left: 16px;
}
.payment .form_total input[type=number]
{
  text-align: right;
  font-size: 30px;
  width: 240px;
  margin-left: 15px;
}
.payment .form_total input[type=submit]
{
    height: 50px;
    width: 274px;
    margin-top: 150px;
    margin-left: 10px;
}
.table table
{
      width: 950px;
    text-align: center;
}
.lal
{
  display: inline-block;
}
.product_information
{
    height: 150px;
    width: 950px;
    column-count: 5;
}
.product_information input[type=text]
{
  width: 100%;
  padding: 10px 10px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.receipt
{
  display: none;
}
.cs{

padding: 1px 60px;
margin: 10px 0px;
display: inline-block;
transform: translate();
}
@page
    {
     margin: 0px;
     padding: 0px;
    }

      </style>
  <title>Transaction</title>
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
      <br>
      <p style="font-weight: bold;">Sales&Inventory</p> 
         </div>
         <ul>
            <li ><a href="dashboard.php">DASHBOARD</a></li>
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
                  <li class="active" ><a href="transaction.php">TRANSACTION</a></li>
                  <li><a href="expenses.php">EXPENSES</a></li>
                  <li><a href="returnproduct.php">BAD PRODUCT</a></li>

               </ul>
            </li>

            <li>
               <a href="history.php" class="sale-btn">HISTORY
            </li>

            <li>
                <a href="report.php" class="sale-btn">REPORT
               </a>
            </li>
            <li><a href="manager.php">ADD MANAGER</a></li>
            <li><a href="employee.php">ADD EMPLOYEE</a></li>
            <li><a href="account.php">ACCOUNT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
         </ul>
      </nav>
<!--sidebar-->

  <header>
     <p style="color: white;font-size: 25px; font-weight: bold;padding: 8px;margin-left: 50px;" ><?php include("php/store_name.php")?></P>
  </header>
  <!-- user input-->
  <!--form 1-->
<!--form 4-->
<div id="form3">
  <div class="form">
  <div id="box2"class="box">
    <h1>Product Information</h1>
    <div class="content">
    <!--expenses-->
    <?php
$productcode = '';
$productco = '';
$connect = mysqli_connect("localhost", "root", "","storenewdb");
$product_id = '';         
$id = '';
$productcolor = "";
$productsize = "";
$submit = '';
$productclass = '';
$productcategory = '';
$productname = '';
$productprice = '';
$productquantity = '';
$subtotal = '';
$discount = '';
$total = '';
$productcost = '';
$productquanti = '';

// php code to search data in mysql database and set it in input text

if(isset($_POST['search']))
{

$transac_id = $_POST['transaction_id'];
  $productcode = strtoupper($_POST['productcodes']);
  $productcode_count = strlen($productcode);
  $check_quantity = "SELECT * FROM available_product WHERE `product_code` = '$productcode' OR barcode_con = '$productcode'";

  $run_check = mysqli_query($connect,$check_quantity);
if (mysqli_num_rows($run_check)>0) {

  while ($check_quan = mysqli_fetch_array($run_check)) {
    $productquanti = $check_quan['product_quantity'];
    $productco = $check_quan['product_code'];
  }
  if ($productquanti == '0' or $productquanti <= '0') {
         $_SESSION['product'] = "transaction complete";
               
  }
      else
      {

             if ($productcode_count == '10') 
             {
                $qry = "INSERT INTO transaction(`product_id`,`transaction_id`,`product_code`, `product_name`, `product_color`, `product_size`, `product_price`, `product_quantity`, `sub_total`, `discount`, `total`, `product_brand`, `product_category`) 
                    SELECT   `id`,'$number',`product_code`, `product_name`, `product_color`, `product_size`,`product_new_price`,'1',`product_new_price`,'0',`product_new_price`, `product_brand`, `product_category`FROM available_product where barcode_con = $productcode";  
            $qry_run = mysqli_query($con,$qry);
             }
             else
             {
             $query = "SELECT `id`,`product_picture`,
            `product_code`,
            `product_name`,
            `product_color`, 
            `product_size`, 
            `product_brand`, 
            `product_category`, 
            `product_cost`,
            `product_new_price` 
            FROM `available_product`   WHERE `product_code` = '$productcode' OR barcode_con = '$productcode'";
            $result = mysqli_query($connect, $query);
                  if(mysqli_num_rows($result) >0)
                  {
                    while ($row = mysqli_fetch_array($result))
                    {   
                      $productquantity = '1';
                        $product_id = $row['id'];
                        $productpicture = $row['product_picture'];
                        $productcode = $row['product_code'];
                        $productname = $row['product_name'];
                        $productcolor = $productcolor."<option value = '".$row['product_color']."'>$row[product_color] </option>";
                        $productsize =$productsize."<option value = '".$row['product_size']."''>$row[product_size]</option>";
                        $productclass = $row['product_brand'];
                        $productcategory = $row['product_category'];
                        $productprice = $row['product_new_price'];
                        $subtotal = $row['product_new_price'];
                        $total = $row['product_new_price'];
                        $productcost = $row['product_cost'];

                    }  
                  }
              }
      }
}

      else
      {
        echo "product did not exist";
      }
      }
// in the first time inputs are empty
elseif(isset($_POST['edit']))
{
    $id = $_POST['edit'];
    ;
    $connect = mysqli_connect("localhost", "root", "","storenewdb");
    $query = "SELECT 
    `id`,
    `product_id`,
    `product_code`,
    `product_name`,
    `product_color`, 
    `product_size`,
    `product_price`,
     SUM(product_quantity) as product_quantity,
     `sub_total`,
     `discount`,
     SUM(total) as total, 
    `product_brand`, 
    `product_category` 
    FROM `transaction`   WHERE `id` = '$id' group by product_code,product_color,product_size";
    $result = mysqli_query($connect, $query);
          if(mysqli_num_rows($result) >0)
          {

            while ($row = mysqli_fetch_array($result))
            {   
                $id = $row['id'];
                $product_id = $row['product_id'];
                $productcode = $row['product_code'];
                $productname = $row['product_name'];
                $productcolor = $productcolor."<option value = '".$row['product_color']."'>$row[product_color] </option>";
                $productsize =$productsize."<option value = '".$row['product_size']."''>$row[product_size]</option>";
                $productclass = $row['product_brand'];
                $productcategory = $row['product_category'];
                $productprice = $row['product_price'];
                $productquantity = $row['product_quantity'];
                $subtotal = $row['sub_total'];
                $discount = $row['discount'];
                $total = $row['total'];

            } 
            $submit = '<input type="submit" name="edits"style="   width: 202px;
  background-color: green;
  color: white;
  padding: 13px 22px;
  left: 3px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  position: absolute;
  top: 320px;
                                  " value="UPDATE">
            </div>';
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
    
    
    mysqli_free_result($result);
    mysqli_close($connect);
    
}

?>      
       
      <div>
      </div>
      <div class="alert" 
      style="
          position: absolute;
          left: 350px;
          font-size: 25px;
          top: 65px;
          background: green;
          width: 620px;
          color: white;
          text-align: center;">
            <?php if (isset($_SESSION['add_product'])): 
              echo $_SESSION['add_product'];
              unset($_SESSION['add_product']);
          ?>
          <?php endif;?>
          <?php if (isset($_SESSION['update_item'])): 
              echo $_SESSION['update_item']; 
              unset($_SESSION['update_item']);
          ?>
          <?php endif;?>
        </div>

      <div class="alert" 
      style="
          position: absolute;
          left: 350px;
          font-size: 25px;
          top: 65px;
          background: red;
          width: 620px;
          color: white;
          text-align: center;">
  
           <?php if (isset($_SESSION['deletes'])): 
              echo $_SESSION['deletes'];
              unset($_SESSION['deletes']);
          ?>
          <?php endif;?>
        </div>
        <div class="empty" style="position: absolute;
          left: 350px;
          font-size: 25px;
          top: 65px;
          background: red;
          width: 620px;
          color: white;
          text-align: center;">
           <?php if (isset($_SESSION['empty'])): 
              echo $_SESSION['empty'];
              unset($_SESSION['empty']);
          ?>
          <?php endif;?>
         
        </div>
        <div class="alert" 
        style= " position: absolute;
          left: 350px;
          font-size: 25px;
          top: 65px;
          background: red;
          width: 620px;
          color: white;
          text-align: center;">
         
     
      </div>
          <?php if (isset($_SESSION['low_quantity'])): ?>
      <script type="text/javascript">
        swal({
        title: "Product Stock is did not meet!!!!",
        text: "click the button to exit!",
        icon: "error",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['low_quantity']);
          ?>
        </div>
      <?php endif;?>
           <?php if (isset($_SESSION['product'])): ?>
      <script type="text/javascript">
        swal({
        title: "Product Stock is Out of stock!!!!",
        text: "click the button to exit!",
        icon: "error",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['product']);
          ?>
        </div>
      <?php endif;?>
      <?php if (isset($_SESSION['payment-not-enough'])): ?>
      <script type="text/javascript">
        swal({
        title: "Payment is not enough!!!!",
        text: "click the button to exit!",
        icon: "error",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['payment-not-enough']);

       endif;
          ?>
    <form name="myform" id="form10" action="" method="POST"  onkeyup="calculate()">
      <input type="text" name="prod_id" value="<?php echo $product_id; ?>" hidden>
      <input type="text" name= "transaction_id" value="<?php echo $number; ?>" readonly>
      <input type="text" name= "id" value=" <?php echo $id; ?>" hidden>
      <label>IC:</label>
      <input type="text" name="productcost" value="<?php echo $productcost; ?>" readonly>

      <input style="width: 300px; height: 40px;" type="text" id="productcode" placeholder="Please Type Product Code" id="productcode" name="productcode" value = "<?php echo $productcode;?>" hidden>
      <label style="display: block;">code</label>
      <input style="width: 300px; height: 40px;" type="text" id="productcode" placeholder="Please Type Product Code" id="productcode" name="productcodes" value = "" style="display: inline-flex; width: 150px;">
      <button name="search" style="width: 50px; background-color: transparent; border-style: none; box-shadow: none;" ><i class="fa fa-search" aria-hidden="true"></i></button>
      
      <div class="product_information">
      
         <label style="display: block;">Product Name</label>
     
      <input   class= "information"  id="productname" type="text" readonly name="productname" value="<?php echo $productname;?>" >
       <label>Brand</label>
     
      <input class= "information" readonly id = "productclass" type="text" name="productclass"value="<?php echo $productclass; ?>">
    
     <label>Color</label>
      <SELECT id="productcolor" name="productcolor" style="height: 35px; width: 150px; margin-bottom: 18px;" ><?php echo $productcolor; ?></SELECT>
      <label>Size</label>
      <SELECT id="productclass" name = "productsize" style="height: 35px; width: 150px;"><?php echo $productsize; ?></SELECT>
        <label>Category</label>
    
      <input class= "information" readonly id="productcategory" type="text" name="productcategory"value="<?php echo $productcategory; ?>">
    
      <label>Quantity</label>
     
      <input  type="text" id="productquantity" name="productquantity" value="<?php echo $productquantity; ?>">
       <label>SRP</label>
     
      <input class= "information" readonly id="productprice" type="text" name="productprice"value="<?php echo $productprice; ?>">
      <label>Sub Total</label>
     
      <input class= "information" readonly type="text" id="productsubtotal" name="productsubtotal" value="<?php echo $subtotal ;?>">
      <label>Discount</label>
     
      <input id="discount" type="text" name="discount" value="<?php echo $discount;?>">
     <label>Total</label>
      
      <input class= "information" readonly type="text" id="total" name="totals" value="<?php echo $total;?>">
      
      </div>
      <input class="save" id="inser" style=" width: 20%;
                            background-color: #4CAF50;
                            color: white;
                            padding: 10px 20px;

                            border: none;
                            border-radius: 4px;
                            cursor: pointer;" type="submit" name="submit_product" value="SUBMIT" OnClick="document.myform.productcodes.focus();">
      <?php 
        echo $submit;
      ?>
            
    </form>
    </div>
  </div>
  <div class="table" style="overflow: scroll;" >
    <h1>To Buy Product</h1>
  <div class="tbody"  >
  <table class="table1">

      <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Sub Total</th>
        <th>Color</th>
        <th>Size</th>
        <th>Class</th>
        <th>Category</th>
        <th>Action</th>
      </tr>
      <?php 

      $db = mysqli_connect("localhost","root","","storenewdb");
        $sqli = "SELECT id,`transaction_id`,`product_code`, `product_name`, `product_color`, `product_size`, `product_price`, SUM(product_quantity) as product_quantity, `sub_total`, `discount`, SUM(total) AS total, `product_brand`, `product_category` FROM transaction group by product_code, product_color,product_size";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            $productcodes = '';
            while ($res=mysqli_fetch_assoc($result)) {
              $productcodes = $res['transaction_id'];
              $id = $res['id'];
              echo "
                <tr>
                <td>".$res['product_code']."</td>
                <td>".$res['product_name']."</td>
                <td>".$res['product_quantity']."</td>
                <td>".$res['product_price']."</td>
                <td>".$res['total']."</td>            
                
                <td>".$res['product_color']."</td>
                <td>".$res['product_size']."</td>
                <td>".$res['product_brand']."</td>
                <td>".$res['product_category']."</td>
              "; ?>
               <th>
                <form method="POST" action="transaction.php">

                <button type="submit" name="edit"  value="<?php echo $id; ?>" class=" btn-primary"  >update</button>
                <button type="submit" name="delete" value="<?= $res['id'];?>">delete</button>
                </form>            
               </th>
                </tr>
                <?php
              


            }
          }
       ?>
    </table> 




    <!--transaction button-->
  </div>

    <?php 
      $db = mysqli_connect("localhost","root","","storenewdb");
        $sqli = "SELECT sum(total) FROM transaction";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            while ($row=mysqli_fetch_assoc($result)) {
        
        ?>
      <div class="payment" style="  column-count: 2;">
        <label><?php $success ?></label>
     <form action="transaction.php" method = "POST" action="" name = "myf" class="form_total" onkeyup="calculates()"> 
       <input type="hidden" class="form-control" name="invoiceid" id="invoiceid" style=" font-size: 16px; color: blue; font-weight: bold; "  value="<?php echo $number; ?>" readonly >     
     <h4> Total </h4>  
     <input type = "text" class="bot" name = "stotal" id="stotal" readonly style="
  border-style:none; text-align:center;"value="<?php echo $row['sum(total)'];
     

        }
      }

 
     ?> " >
     <br><br>
     <input type="text" name= "id" value="<?php echo $number; ?>" >
     <label class="lal"> Discount </label>    
     <input type="number" class="bot" name="discount" id="discount"  >  
     <label class="lal" > Total to Pay </label> 
     <input type="number" class="bot" name="total"  >  
     <label class="lal">Payment</label>
     <input type="number" class="bot" name="payment" id="payment"  required onkeyup="">
     
     <label class="lal">Change</label>
     <input type="number" class="bot" name="change" >

      <label class="lal">Customer Name</label>
     <input style="width: 240px; height:40px; text-align:center;margin-left: 15px;" type="text" class="bot" name="customer_name" placeholder="Customer Name(optional)">
     <br><br><input style=" width: 50%;
                            background-color: #4CAF50;
                            color: white ;
                            padding: 14px 20px;
                            margin: 0px 0;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;" type="submit" class="bot" name="submitpayment" value="CHECKOUT" >

     </form>  

     </div>
</div>
<!--end of transaction button-->
</form>
</div>
</div>

    
        </div>
        <?php
        $retrieve_transaction_id = '';
        if (isset($_SESSION['complete'])):
          $con = mysqli_connect("localhost","root","","storenewdb");
          $getstoredata = mysqli_query($con,"SELECT * FROM store_details");
          if (mysqli_num_rows($getstoredata)) 
          {
            while ($storedata = mysqli_fetch_assoc($getstoredata)) 
            {
              $storename = $storedata['store_name'];
              $storestreet = $storedata['store_street'];
              $storebrgy = $storedata['store_brgy'];
              $storemunicipality = $storedata['store_municipality'];
              $storeprovince = $storedata['store_province'];
            }
          }
            $gettransactionid = mysqli_query($con,"SELECT transaction_id as get_transaction_id,customer_name,casher FROM transaction_total group by transaction_id asc ");
          if (mysqli_num_rows($gettransactionid)) {
            while ($get_transactionid = mysqli_fetch_assoc($gettransactionid)) 
            {
             $retrieve_transaction_id = $get_transactionid['get_transaction_id'];
             $customer_names = $get_transactionid['customer_name'];
             $casher = $get_transactionid['casher'];
            }
          }

        echo "<div style =
        'background-color: white;
width: auto;
position: absolute;
top: 30%;
left: 34%;
height: auto;
padding: 30px;
box-shadow: 1px 1px 2px 1px black;'
        id = 'receipts'>";
          echo "<button id='printButton' onclick='dismiss()' style = 'background: none;
border-style: none;
margin-left: 450px;
margin-top: -9px;
width: 0px;
cursor: pointer;'><i class='fa fa-times'></i></button>  ";
        echo "<h3>".$storename."</h3>";
        echo "<p style = 'font-size:small'>Customer:".$customer_names."</p>";
        echo "<right><p style='font-size: small;
                        text-align: right;
                        margin-top: -15px;'>
                        Cashier: ".$casher."</p></right>";
        echo "<p style = 'font-size:small'>Transaction ID:".$retrieve_transaction_id."</p>";
 echo "<table>";
        echo "<thead>";
        echo  "<tr>";
        echo "<th>No</th>
        
        <th style = 'padding-right:20px;padding-left:20px;' >Code</th>
        <th style = 'padding-right:20px;padding-left:20px;'>Name</th>
        <th style = 'padding-right:20px;padding-left:20px;'>Price</th>
        <th style = 'padding-right:20px;padding-left:20px;'>Quantity</th>
        <th>Total</th>
       </tr>";
        echo "</thead>";
        echo "<tbody style='text-align:center;'>";
        $count = 1;
        $get_grand_total = mysqli_query($con,"SELECT SUM(discount) as discount,sum(total) as total from transaction_total where transaction_id = '$retrieve_transaction_id'");
        if (mysqli_num_rows($get_grand_total)) {
          $get_grand = mysqli_fetch_assoc($get_grand_total);
          $grand_total = $get_grand['total'];
          $grand_discount = $get_grand['discount'];
        }
          $gettransactionproduct = mysqli_query($con,"SELECT `transaction_id`, `product_name`, `product_code`, `product_color`, `product_size`, `product_brand`, `product_category`, SUM(product_quantity) AS product_quantity, `product_price`,
           SUM(sub_total) as sub_total, 
           SUM(discount) AS discount, 
           SUM(total) as total FROM success_transaction where transaction_id = '$retrieve_transaction_id' group by product_code ");
          if (mysqli_num_rows($gettransactionproduct)) {
            while($gettransaction_product = mysqli_fetch_assoc($gettransactionproduct))
            {
          
           
        
        echo "<tr>";
        echo "<td>".$count++."</td>";
        echo "<td>".$gettransaction_product['product_code']."</td>";
        echo "<td>".$gettransaction_product['product_name']."</td>";
        echo "<td>".$gettransaction_product['product_price']."</td>";
        echo "<td>".$gettransaction_product['product_quantity']."</td>";
        echo "<td>".$gettransaction_product['total']."</td>";
        echo "</tr>";
         }
        }
           echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>Discount</td>";
        echo "<td>".$grand_discount."</td>";
        echo "</tr>";
     
         echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>Grand Total</td>";
        echo "<td>".$grand_total."</td>";
        echo "</tr>";
     
        echo "</tbody>";
        echo "</table";        
        echo "</div>";
        unset($_SESSION['complete']);
      endif;
        ?>
     <!--form 4-->
<script type="text/javascript">
  function checkfunction(obj){
$.post("transaction.php",$(obj).serialize(),function(data){
 alert("success");
 });
 return false;
 }

</script>
<!-- <script>
$(document).ready(function(){
    $("#printButton").click(function(){
      document.getElementById("receipts").style.cssText = "position:absolute;top:0px;left:0px;";
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("div.receipts").printArea( options );
      document.getElementById("receipts").style.display = "none";

    });
     
});
    
</script>
-->
  <script type="text/javascript">
  function button_receipt() {
  document.getElementById("receipts").style.display = "block";
}

function dismiss() {
  document.getElementById("receipts").style.display = "none";
}
</script>

</script>
<script src="javascript/prevent_resub.js"></script>

<script src="javascript/box2.js"></script>

  <script type="text/javascript">
 
  $(document).ready(function(){
    setTimeout(function(){
      $(".alert").remove();
    },3000);
    }); 
</script>



<script type="text/javascript">
  function calculates() {   
 if(isNaN(document.forms["myf"]["stotal"].value) || document.forms["myf"]["stotal"].value=="") {   
 var text1 = 0;   
 } else {   
 var text1 = parseInt(document.forms["myf"]["stotal"].value);   
 }   
 if(isNaN(document.forms["myf"]["discount"].value) || document.forms["myf"]["discount"].value=="") {   
 var text2 = 0;   
 } else {   
 var text2 = parseFloat(document.forms["myf"]["discount"].value);   
 }   
 document.forms["myf"]["total"].value = (text1-text2);   
  
  if(isNaN(document.forms["myf"]["total"].value) || document.forms["myf"]["total"].value=="") {   
 var text3 = 0;   
 } else {  
 var text3 = parseInt(document.forms["myf"]["total"].value);   
 }   
 if(isNaN(document.forms["myf"]["payment"].value) || document.forms["myf"]["payment"].value=="") {   
 var text4 = 0;   
 } else {   
 var text4 = parseFloat(document.forms["myf"]["payment"].value);   
 }   
 if (text4 > text3) {
 document.forms["myf"]["change"].value = (text4-text3); 
 }
 else
 {
 document.forms["myf"]["change"].value = (text3-text4); 
  
 }  
 }
</script>
<script type="text/javascript">
   
    var form = document.forms.myform,
    qty = form.productquantity,
    cost = form.productprice,
    output = form.productsubtotal;
    discount = form.discount;
    totals = form.totals;

    window.calculate = function () {
    var q = parseFloat(qty.value, 10) || 0,
        c = parseFloat(cost.value) || 0,
        d = parseFloat(discount.value) || 0
        t = parseFloat(output.value) || 0;
    output.value = (q * c).toFixed(.5);
    totals.value = (t - d).toFixed(.5);
    };
    </script>
<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){
      $(".alert").remove();
    },1000);
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){
      $(".empty").remove();
    },1000);
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
       <script type="text/javascript">
  
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    } 
</script>
<script type="text/javascript">
    document.forms['myform'].elements['productcodes'].focus();
  </script>
</body>
</html>