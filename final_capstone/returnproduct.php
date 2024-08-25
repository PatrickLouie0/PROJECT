 <?php 
session_start();
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}
$data_quanti = '';
$prod_id = '';
 $id = '';
  $code = '';
  $name= '';
  $color = '';
  $size = '';
  $brand = '';
  $category = '';
  $stock = '';
  $price = '';
  $update = '';

  $con = mysqli_connect("localhost","root","","storenewdb");
  if (isset($_POST['edit'])) 
  {
      $id = $_POST['edit'];
      $sql = "SELECT * FROM return_product WHERE id = '$id'";
      $run = mysqli_query($con,$sql);
      if (mysqli_num_rows($run)) {
          while ($res = mysqli_fetch_assoc($run)) 
          {
            $data_quanti = $res['product_quantity'];
              $prod_id = $res['id'];
              $code = $res['product_code'];
              $name= $res['product_name'];
              $color = $color."<option value = '".$res['product_color']."'>$res[product_color] </option>";
          $size =$size."<option value = '".$res['product_size']."''>$res[product_size]</option>";
          $brand = $res['product_brand'];
              $category = $res['product_category'];
              $stock = $res['product_quantity'];
              $price = $res['product_price'];

          }
        }  
      $update = '<button type = "submit" name = "update" style = "
      position:absolute;
      border: none;
      border-radius: 10px;
      margin-left: 50px;
      background-color: #4CAF50;
      color: white;
      width: 200px;
      height: 50px;
 ">Update</button>';
        }

 $con = mysqli_connect("localhost","root","","storenewdb");
  if (isset($_POST['update'])) 
  {
    $data_quantity = $_POST['data_quantity'];
    $ids = $_POST['ids'];
    $productcode = $_POST['productcode'];
    $productname = $_POST['productname'];
    $productcolor = $_POST['productcolor'];
    $productsize = $_POST['productsize'];
    $productclass = $_POST['productclass'];
    $productcategory = $_POST['productcategory'];
    $productquantity = $_POST['productquantity'];
    $productprice = $_POST['productprice'];
    $total = $_POST['productquantity'] * $_POST['productprice'];
    

  $sql = "UPDATE `return_product` SET `product_code`='$productcode',`product_name`='$productname',`product_color`='$productcolor',`product_size`='$productsize',`product_brand`='$productclass',`product_category`='$productcategory',`product_quantity`='$productquantity',`product_price`='$productprice',`total`='$total' WHERE id = '$ids'";
    $run = mysqli_query($con,$sql);
    if ($run) 
    {
          if ($productquantity == $data_quantity){
          $_SESSION['status'] = "Product Data Updated Successfully!";
            
    
        }
        elseif($data_quantity<$productquantity)
        {
          $total = (int)$data_quantity-(int)$productquantity;
            $sql = "UPDATE `available_product` SET `product_quantity`= (product_quantity + $total) where (`product_code` = '$productcode') AND (`product_color` = '$productcolor') AND (`product_size` = '$productsize') ";
          $run = mysqli_query($con,$sql);
       
        if ($run) {
         $_SESSION['status'] = "Product Data Updated Successfully!";
    
          }
        }
        elseif  ($data_quantity > $productquantity)  {

              $total = (int)$productquantity-(int)$data_quantity;
               $sql = "UPDATE `available_product` SET `product_quantity`= (product_quantity - $total) where (`product_code` = '$productcode') AND ( `product_color` = '$productcolor')AND( `product_size` = '$productsize') ";
          $run = mysqli_query($con,$sql);
       if ($run) {
            $_SESSION['status'] = "Product Data Updated Successfully!";
    
          }
        }
    }
  }
 ?>

 <!DOCTYPE html>
<html>
<head>

  <style type="text/css">
    .return-form
    {
      width: 300px;
    }

@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  user-select: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.btn{
  position:absolute;
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

header
{
  background-color: #034f84;
  width: 100%;
  height: 40px;
}
table
{
    text-align: center;
    border-style: solid;
    border-width: 2px;
    border-color: gray;
    background-color: transparent;
    width: 96%;
    margin-left: 25px;
    margin-top: 50px;
    padding: 5px;
}
#mytable_wrapper
{
  margin-left: 20px;
  margin-right: 30px;
}
.table .tbody
{
    font-size: 20px;
    overflow-x: hidden;
    overflow-y: scroll;
    height: 0px;
}
.code {
  width: 400px;
  font-size: 25px;
  margin-left: 27px;
    border-radius: 50px;
    display: flex;
}

.code {
    flex: 1;
}
div .code button{
  background-color: transparent;
  background-repeat:no-repeat;
}
  .col input{
  margin-right: 42px;
  height: 45px;
  width: 250px;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}

 form .product_information{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .product_information label{
   display: flex;
   align-items: center;
   cursor: pointer;
   margin-left: 30px;
   font-size: 20px;
 }
 div .but input{
  border: none;
  border-radius: 10px;
  margin-left: 50px;
  background-color: #4CAF50;
  color: white;
  width: 200px;
  height: 50px;
 }
  label  [type=search] {
  font-size: 20px;
  height: 35px;
  margin-right: 10px;
  margin-bottom: 20px ;
 }
label{
  font-size:  20px;
  margin-left: 10px;
}
select{
  height: 35px;
}
 }
  </style>
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
   
  <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
       <link rel="stylesheet" type="text/css" href="css/badproduct.css">
              <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
  <title>Bad Product</title>
</head>
<body>
  <!--sidebar-->
  <div class="con">
      <div class="btn" id="btns">
         <span class="fas fa-bars" style="margin-left: 10px;margin-top: 5px; color: white;"></span>
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
            <li><a href="dashboard.php">Dashboard</a></li>
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
            <li class="active">
               <a href="#" class="serv-btn">TRANSACTION
               <span class="fas fa-caret-down second"></span>
               </a>
               <ul class="serv-show">
                  <li><a href="transaction.php">TRANSACTION</a></li>
                  <li><a href="expenses.php">EXPENSES </a></li>
                  <li><a href="returnproduct.php">BAD PRODUCT</a></li>
                  
               
               </ul>
            </li>

                  <li ><a href="history.php">HISTORY</a></li>
                  
            <li>
                <a href="report.php" class="sale-btn">Report
               </a>
            </li>
            <li><a href="manager.php">ADD MANAGER</a></li>
            <li><a href="employee.php">ADD EMPLOYEE</a></li>
            <li><a href="user_profile.php">ACCOUNT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
         </ul>
      </nav>
      <header>
        

         <p style="color: white;font-size: 25px; font-weight: bold;padding: 3px;margin-left: 50px;" ><?php include("php/store_name.php")?></P>
      </header>

  <h1 style="text-align: center;">Bad Product Information</h1><br><br><br>
      <!--end of sidebar-->
<!--submit return product query-->
<?php  
$msg = "";
$css_class = "";
$success = "";
if (isset($_POST['submits'])) 
{
  $con = mysqli_connect("localhost","root","","storenewdb") or die("not connected");
    $prodid = $_POST['ids'];
    $product_code = $_POST['productcode'];
    $productname = $_POST['productname'];
    $productcolor = $_POST['productcolor'];
    $productsize = $_POST['productsize'];
      $productclass = $_POST['productclass'];
      $productcategory = $_POST['productcategory'];
      $productquantity = $_POST['productquantity'];
      $productprice = $_POST['productprice'];
   
      $total = (int)$_POST['productquantity'] * (int)$_POST['productprice'];
      

       $sql = " INSERT INTO return_product( product_id,product_code, product_name, product_color, product_size, product_brand, product_category, product_quantity, product_price,total) VALUES ('$prodid','$product_code','$productname','$productcolor','$productsize','productclass','$productcategory','$productquantity','$productprice','$total');";

        $result = mysqli_query($con,$sql);
        if ($result) 
        {
            $update_quantity = "UPDATE available_product SET `product_quantity` = (product_quantity- $productquantity) where (`product_code` = '$product_code') AND ( `product_color` = '$productcolor')AND( `product_size` = '$productsize')";
            $run_update_quantity = mysqli_query($con,$update_quantity);
            if ($run_update_quantity) {
                $_SESSION['statuss'] = "<p style = 'background-color: green;
width: 400px;
text-align: center;
margin-left: 439px;
position: absolute;
height: 30px;
font-size: 27px;
margin-top: -25px;'>Product Added Successfully!</>";
            }
        }
        else
        {
          echo "failed";
          $msg = "failed to upload";
          $css_class = "alert-danger";
        }
      
}
?>
<!-- search product-->
<?php
$productcode_count = '';
      if(isset($_POST['search']))
{

    $productcode = $_POST['productcode'];
     $productcode_count = strlen($productcode);
  
    $connect = mysqli_connect("localhost", "root", "","storenewdb");
    $query = "SELECT `id`,`product_picture`,
    `product_code`,
    `product_name`,
    `product_color`, 
    `product_size`, 
    `product_brand`, 
    `product_category`, 
    `product_new_price` 
    FROM `available_product`  WHERE `product_code` = '$productcode' OR barcode_con = '$productcode' ";
    $result = mysqli_query($connect, $query);
    if ($productcode_count == '10') {
         $totalss = 1 * (int)$_POST['productprice'];
     
        $sql = " INSERT INTO return_product(`product_id`,`product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `product_price`,`total`) 
       SELECT   `id`,`product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, '1' ,`product_new_price`,`product_new_price` FROM available_product where barcode_con = '$productcode';";

        $result = mysqli_query($con,$sql);
        if ($result) 
        {
            $update_quantity = "UPDATE available_product SET `product_quantity` = (product_quantity- '1') where (`product_code` = '$productcode'  OR barcode_con = '$productcode')";
            $run_update_quantity = mysqli_query($con,$update_quantity);
            if ($run_update_quantity) {

                $_SESSION['statuss'] = "<p style = 'background-color: green;
width: 400px;
text-align: center;
margin-left: 439px;
position: absolute;
height: 30px;
font-size: 27px;
margin-top: -25px;'>Product Added Successfully!</>";
                


            }
        }
        else
        {
          echo "failed";
          $msg = "failed to upload";
          $css_class = "alert-danger";
        }
      }
      else if(mysqli_num_rows($result) >0)
    {
      while ($row = mysqli_fetch_array($result))
      {   
          $prod_id = $row['id'];
          $code = $row['product_code'];
          $name = $row['product_name'];
          $color = $color."<option value = '".$row['product_color']."'>$row[product_color] </option>";
          $size =$size."<option value = '".$row['product_size']."''>$row[product_size]</option>";
          $brand = $row['product_brand'];
          $category = $row['product_category'];
          $price = $row['product_new_price'];
          $stock = '1';

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

// in the first time inputs are empty
else{
          $productcode = "";
          $productname = "";
          $productcolor = "";
          $productsize = "";
          $productclass = "";
          $productcategory = "";
          $productprice = "";
}


?>
  <?php if (isset($_SESSION['status'])): ?>
      <script type="text/javascript">
        swal({
        title: "Product Updated Successfully!",
        text: "click the button to exit!",
        icon: "success",
        button: "close",
        });
      </script>
       <?php
            unset($_SESSION['status']);
        endif
      
          ?>
          <div class="statuss" style="
 
          ">
  <?php if (isset($_SESSION['statuss'])): ?>
       <?php
       echo $_SESSION['statuss'];
            unset($_SESSION['statuss']);
        endif
      
          ?>
      </div>

          <div class="statuss" style="
          ">
      </div>
       <?php if (isset($_SESSION['statusss'])): ?>
       <?php
       echo $_SESSION['statuss'];
            unset($_SESSION['statusss']);
        endif
      
          ?>
 
<div class="return-form">
    <form name="myform"  action="" method="POST" style="margin-left: 20px;"  onkeyup="calculate()">
      <!--<input type="te" name="id" value="<?php echo $customer_ID; ?>">-->


    <input type="text" name="data_quantity" value="<?php echo $data_quanti; ?>" HIDDEN>
    <input type="text" name="ids" value="<?php echo $prod_id?>" hidden>



      <label style="display: block;margin-left: 30px;">Code</label>
    <div class="code">
      <input style= "width: 600px; height: 40px;" type="text"  name="productcode" value = "<?php echo $code; ?>">
      <button name="search" style="border-style: none;margin-left: 10px;"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div><br><br>

      <div class="product_information">
        
       
        <div class="col"><label >Name</label>
       <input  class= "information"  id="productname" type="text" name="productname" value="<?php echo $name;?>">
       <label>Brand</label>
          <input class= "information"  type="text" name="productclass"value="<?php echo $brand; ?>">
        
        </div>


       
        <div class="col"><label>Category</label>
        <input class= "information"  type="text" name="productcategory"value="<?php echo $category; ?>">
        <label>Size</label>
          <SELECT style= "width: 250px;height: 49px;margin-top: -2px;" name="productsize" id="productsize" ><?php echo $size; ?></SELECT>
          
        </div>

      <div class="col">
      <label>quantity</label>
        <input  type="text"  name="productquantity" value="<?php echo $stock; ?>">
    <label>Color</label>
          <SELECT style= "width: 250px;height: 49px;margin-top: -2px;"  name="productcolor" id="productcolor" ><?php echo $color; ?></SELECT>  
      
        </div>

      <div class="col">
        
        <label>Price</label>
          <input class= "information" type="text" name="productprice"value="<?php echo $price; ?>">
      </div> 
       
      
    

      </div>
       <div class="but">
        <?php echo $update; ?>
        <input type="submit" name="submits" value="Submit" OnClick="document.myform.productcode.focus();">
       </div>
    </form>
</div>
<br><br><br>
  <!--end of form-->
  <!-- return product table-->
          <table class = "table" id="mytable" style="height: 200px;">
                <thead>
         <tr>
          <th>No</th>
          <th>Code</th>
         <th>Name</th>
          <th>Brand</th>
         <th>Color</th>
         <th>Size</th>
         <th>Category</th>
         <th>Quantity</th>
         <th>Product Price</th>
         <th>Total</th>
         <th>Time</th>
            <th>Action</th>

      </tr>
    </thead>
         <?php 

         $db = mysqli_connect("localhost","root","","storenewdb");
         $sqli = "SELECT  `id`,`product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `product_price`, `total`, time(date_time) as date_time FROM return_product where date(date_time) = date(curdate()) ORDER BY date(date_time) desc";
         $result =mysqli_query($db,$sqli);
            $num = mysqli_num_rows($result);
            if($num>0){
              $id = '';
              $numpy = 1;
               while ($res=mysqli_fetch_assoc($result)) {
                $id = $res['id'];
                  echo "
                     <tr>
                     <td >".$numpy++."</td>
                     <td>".$res['product_code']."</td>
                     <td>".$res['product_name']."</td>
                        <td>".$res['product_brand']."</td>
                     <td>".$res['product_color']."</td>
                           <td>".$res['product_size']."</td>
                            <td>".$res['product_category']."</td>
                            <td>".$res['product_quantity']."</td>
                            <td>".$res['product_price']."</td>
                            <td>".$res['total']."</td>
                            <td>".$res['date_time']."</td>
                            ";
                          ?>
                            <td>
                              <form method="POST" action="returnproduct.php">

                            <center><button style=" width: 100%;
                            background-color: #4CAF50;
                            color: white;
                            padding: 14px 20px;
                            margin-bottom: 10px;
                            margin-top: 5px;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;" type="submit" class="edit" name="edit" value="<?php echo $id;?>">EDIT</button>
                            </td>                     
                            </tr>
                            </form>
                            <?php

                  
               }
            }
       ?>

     </table>
     <script type="text/javascript" src="javascript/prevent_resub.js"></script>
  <script>
    $(document).ready( function () 
    {
    $('#mytable').DataTable();
    } 
    );
    </script>

  <!--js sidebar-->


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
            function autoCalculate(){
            var productprice = document.getElementById('productprice').value;
            var priceadded = document.getElementById('priceadded').value;

            var digit1 = parseFloat(productprice);
            var digit2 = parseFloat(priceadded);
            var total = digit1 * digit2;
            document.getElementById('result').innerHTML = "total";
         }
</script>
<!--end of js sidebar-->
<script type="text/javascript">
    document.forms['myform'].elements['productcode'].focus();
  </script>
</div>
  <script type="text/javascript">
 
  $(document).ready(function(){
    setTimeout(function(){
      $(".statuss").remove();
    },3000);
    }); 
</script>

</body>
</html>