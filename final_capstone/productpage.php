<?php  

   include 'php/addproduct.php';
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}

 ?>
 <?php
 $edit = '';
 $productpicture = "";
          $productcode= "";
          $productname = "";
          $productcolor = "";
          $productsize = "";
          $productclass = "";
          $productcategory = "";
          $productcost = "";
          $addedprice = "";
          $productprice = "";
          $productquantity = "";
  
if(isset($_POST['edit']))
{
      
    $id = $_POST['edit'];
    $connect = mysqli_connect("localhost", "root", "","storenewdb");
    $query = "SELECT
      `id`,`product_picture`,
     `product_code`, 
     `product_name`, 
     `product_color`, 
     `product_size`, 
     `product_brand`, 
     `product_category`, 
     `product_quantity`, 
     `product_cost`, 
     `product_added_price`, 
     `product_new_price`
     FROM `available_product` WHERE `id` = $id";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) >0)
    {

      while ($row = mysqli_fetch_array($result))
      {   
          $id = $row['id'];
          $productpicture = $row['product_picture'];
          $productcode = $row['product_code'];
          $productname = $row['product_name'];
          $productcolor = $row['product_color'];
          $productsize =$row['product_size'];
          $productclass = $row['product_brand'];
          $productcategory = $row['product_category'];
          $productcost = $row['product_cost'];
          $addedprice = $row['product_added_price'];
          $productprice = $row['product_added_price'];
          $productquantity = $row['product_quantity'];
          
         } 
         $edit = '<input type="submit" name="update_data" value="Update">';

       }
     }

 ?>
 <?php

 ?>
 <!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/productpage.css">
  <script src="javascript/jquery.dataTables.min.js"></script>
           <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
           <link rel="stylesheet" type="text/css" href="font-awesome.css">
   <style>
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700  display=swap');
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
nav ul .feat-show-member.show3{
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
#myform
{
  column-count: 7;
}
.table
{
  width: 100%;
}
.table .table1
{

}
.table .table1 th,tr,td
{
  text-align: center;
  padding: 15px;
}
.img
{
  width: 200px;
}
h1{
  text-align: center;

}

input[type=word], select {
  width: 180%;
  padding: 13px 19px;
  margin: 15px 1;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type="text"], select {
  width: 100px;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
   margin-top: 80px;
  margin-left: 5px;
}
input[type="search"] {
  border-radius: 10px;
  outline-offset: -2px;
  width: 280px;
  height: 40px;
  -webkit-appearance: none;
  margin-top: 90px;
  margin-right: 10px;
}

input[type=submit] {
 text-align: center;
  width: 30%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 11px;
  margin: 60px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input [type=update] {
 text-align: center;
  width: 10px;
  background-color: #4CAF50;
  color: white;
  padding: 14px 11px;
  margin: 60px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
input[type=update]:hover {
  background-color: #45a049;
}
div .user-details{
  padding-left:80px;
}
.edit
{
      position: absolute;
      left: 470px;
      width: 1390px;
}

label {
  display: inline-block;
  margin-bottom: .5rem;
}
label {
  font-size: 14px;  
}
.dataTables_wrapper {
  position: static;
  clear: both;
  *zoom: 1;
  zoom: 1;

}
.btn-primary{
  border-radius: 5px;
  color: white;
  background-color: #0062cc;
  
}
.btn-primary:hover {
  color: #fff;
  background-color: #0069d9;
  border-color: #0062cc;
}
i{
  visibility: 50px;
}
   </style>

   <title>Add Product</title>
</head>
<body style="background-color: white;">


 <body>
      <nav class="sidebar">
         <div class="text">

      <div class="btn" id="btn">
         <i class="fa fa-times" aria-hidden="true"></i>
      </div>
      <p>Sales&Inventory</p>
         </div>
         <ul>
            <li ><a href="dashboard.php">DASHBOARD</a></li>
            <li class="active">
               <a href="#" class="feat-btn">PRODUCT
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li ><a href="productpage.php">ADD PRODUCT</a></li>
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

            <li>
                <a href="manager.php" class="sale-btn">ADD MANAGER
               </a>
            </li>
            <li>
                <a href="employee.php" class="sale-btn">ADD EMPLOYEE
               </a>
            </li>
    
            <li><a href="user_profile.php">ACCOUNT</a></li>
           <li><a href="logout.php">LOGOUT</a></li>
         </ul>
      </nav>
<!--sidebar-->
   <header>
    <div class="btn" id="btns">
         <i class="fa fa-bars"  style="color: white; position: ;"></i>
      </div>
      
      <p style="color: white;font-size: 25px; font-weight: bold;padding: 8px;" ><?php include("php/store_name.php")?></P>
   </header>
        <!-- user input-->
   <!--form 1-->
<div id = "form">
   <div class="form">    
          
             <div class="content" id="productinfo">
          <h1 >Product Information</h1>
          <div><?php echo $success; ?> <div>
          <br><br>
               
               <form method="POST" action="php/addproduct.php" id = "myform"name="myform" enctype="multipart/form-data" onkeyup="calculate()">
               <center><img src="image/box.png" class="productdisplay" id="productdisplay" onclick="trigger()" style="display: block; width: 170px; height: 170px; margin-left: 50px; ">
               <input type="file" name="productpicture" onchange="displayproduct(this)" id="productpicture" style="display: none;" value="box.png">

                 <div class="user-details">
                  <input type="file" name="barcode"  id="productpicture" style="display: none;" value="box.png">
  


                   




                    <input type="word" id="productcode" name="productcode" placeholder="Product Code.." value="<?php echo $productcode;?>">
                    <label for="fname">Code</label>

                    <input type="word" id="productname" name="productname" placeholder="Product Name.." value="<?php echo $productname;?>" required>
                    <label for="fname"> Name</label>

                    <input type="word" name="productclass" placeholder="Product Brand" value="<?php echo $productclass;?>">
                    <label for="productclass">Brand</label>

                    <input type="word" id="productcolor" name="productcolor" placeholder="Product Color.." value="<?php echo $productcolor;?>">
                    <label for="fname">Color</label>

                    <input type="word" id="productsize" name="productsize" placeholder="Product Size.." value="<?php echo $productsize;?>">
                    <label for="fname">Size</label>

                    <input type="word" id="productcategory" name="category" placeholder="Product Category.." value="<?php echo $productcategory;?>">
                     <label for="fname">Category</label>
            
                    <input type="word" id="productquantity" name="productquantity" placeholder="Product Quantity.." value="<?php echo $productquantity;?>"required>
                    <label for="fname">Quantity(pcs)</label>
                
                    <input type="word" id="productprice" name="productprice" placeholder="Product Cost.." value="<?php echo $productcost;?>"required>
                     <label for="fname">Cost</label>
              
                    <input type="word" id="productaddedprice" name="addedprice" placeholder="Price Add.." value="<?php echo $addedprice;?>"required>
                    <label for="fname">Markup</label>
                    
                    <input type="word" id="productnewprice" name="newprice" placeholder="New SRP.." value="<?php echo $productprice;?>">
                    <label for="lname">SRP </label>

                    
                    
              </center>
            
                   
                </div>
           </div>
   </div>
 </div>
 <div class="edit" id="update">
   <?php 
    echo $edit;
   ?>
 </div>
<center><div id="save">
            <input type="submit"  value="Submit" name="submit" class="save" OnClick="document.myform.submit.focus();">
</div>
</center>
</form>
   <br><br><br>
   <div class="table">
    <h1>Table Of New Added Product</h1><br>
      <!--table-->
      
      <div class="container">
        <?php if (isset($_SESSION['status'])): ?>
      <script type="text/javascript">
        swal({
        title: "Product added successfully!",
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
                <?php if (isset($_SESSION['update'])): ?>
      <script type="text/javascript">
        swal({
        title: "Product Was Updated!",
        text: "click the button to exit!",
        icon: "success",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['update']);
          ?>
        </div>
      <?php endif;?>


             <?php if (isset($_SESSION['available'])): ?>
      <script type="text/javascript">
        swal({
        title: "Product Is Available!",
        text: "click the button to exit!",
        icon: "error",
        button: "close",
        });
      </script>
        <?php
            unset($_SESSION['available']);
          ?>
        </div>
      <?php endif;?>

      </div>
         <table class="table table-fluid" id="myTable">
    <thead>
        <tr>
        <th>No</th>
         <th>Picture</th>
         <th>Code</th>
         <th>Name</th>
         <th>Color</th>
         <th>Size</th>
         <th>Class</th>
         <th>Category</th>
         <th>stock</th>
         <th>Cost(pcs)</th>
         <th>Markup</th>
         <th>SRP</th>
            <th>Action</th>
        </tr>
     </thead>
  <form method="POST">
         <?php 
         $c = 1;
         $db = mysqli_connect("localhost","root","","storenewdb");
         $sqli = "SELECT * FROM available_product order by date_time DESC";
         $result =mysqli_query($db,$sqli);
            $num = mysqli_num_rows($result);
            if($num>0)
            {
               while ($res=mysqli_fetch_assoc($result)) 
               {
                $x = $res['id'];
                
                  echo "
                     <tr>
                     <td>".$c++."</td>
                     <td><img class='img' src='product_picture/".$res['product_picture']."' ></td>
                     <td>".$res['product_code']."</td>
                     <td>".$res['product_name']."</td>
                     <td>".$res['product_color']."</td>
                           <td>".$res['product_size']."</td>
                      <td>".$res['product_brand']."</td>
                            <td>".$res['product_category']."</td>
                            <td>".$res['product_quantity']."</td>
                           <td style=''>".$res['product_cost']."</td>
                      <td>".$res['product_added_price']."</td>
                            <td>".$res['product_new_price']."</td>
                            ";
                          ?>
                            <td>

                            </form>
                            <form method="POST">
                            <button type="update" name="edit" onclick="b1" value="<?php echo $x; ?>" class=" btn-primary">UPDATE</button>
                            </form>               
                            
                            <?php

                  
               }
            }
       ?>

       </tbody>
    </table>

      <!--endtable-->
   </div>
</div>
</div>


<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>

<!--form 1-->

<!--form 4-->
<script type="text/javascript">
  function b1(){
  document.getElementById("update").style.display = "block";
  document.getElementById("save").style.display = "none";
 }

function dismiss() {
  document.getElementById("update").style.display = "none";
}
</script>
<script src="javascript/sidebar.js"></script>
<script src="javascript/form.js"></script>
<script src="javascript/select.js"></script>
<script src="javascript/closeopen.js"></script>
<script src="javascript/box.js"></script>
<script src="javascript/box2.js"></script>
<script src="javascript/picture.js">
</script>
<script type="text/javascript">
  function calculate() {   
 if(isNaN(document.forms["myform"]["productprice"].value) || document.forms["myform"]["productprice"].value=="") {   
 var text1 = 0;   
 } else {   
 var text1 = parseInt(document.forms["myform"]["productprice"].value);   
 }   
 if(isNaN(document.forms["myform"]["addedprice"].value) || document.forms["myform"]["addedprice"].value=="") {   
 var text2 = 0;   
 } else {   
 var text2 = parseFloat(document.forms["myform"]["addedprice"].value);   
 }   
 document.forms["myform"]["newprice"].value = (text1+text2);   
 }  

</script>
  

    <script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){
      $(".alert").remove();
    },3000);
    $(".btn-primary").click(function()
    {
        $(".table1").find('tr').eq(this.value).each(function(){
            
            $("#productcode").val($(this).find('td').eq(2).text());
            $("#productname").val($(this).find('td').eq(3).text());
            $("#productcolor").val($(this).find('td').eq(4).text());
            $("#productsize").val($(this).find('td').eq(5).text());
            $("#productclass").val($(this).find('td').eq(6).text());
            $("#productcategory").val($(this).find('td').eq(7).text());
            $("#productquantity").val($(this).find('td').eq(8).text());
            $("#productprice").val($(this).find('td').eq(9).text());
            $("#productaddedprice").val($(this).find('td').eq(10).text());
            $("#productnewprice").val($(this).find('td').eq(11).text());
            
            $("#id").val($(this).find('td').eq(0).text());
          });
          $(".save").attr("name","edit");
         });
    });
  
</script>

<script type="text/javascript">
    document.forms['myform'].elements['productcodes'].focus();
  </script>
<script src="javascript/prevent_resub.js"></script>

</body>
</html>