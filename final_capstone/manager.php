 <?php 
	 
session_start();
  $eid=$_SESSION['user-manager'];
if($eid=="")
{
header('location:Login.php');
}
	require_once('store.php');
	$store->manager();
	$store->delete_manager_data();
 ?>
<!DOCTYPE html>
<html>
<head>
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
   
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
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
  top: -5px;
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
  padding-left: 5px;
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
  padding-left: 20px;
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
  width: 100%;
	height: 50px;
	background-color: #034f84;
}
.box
{ 
  margin-top: 50px;
  padding: 40px;
  padding-bottom: 20px;
  border-radius: 10px;
  background-color: #034f84;
  background-size: cover;
  display: none;
  position: absolute;
  height: 570px;
  width: 80%;
  top: 50%;
  left: 50%;
  border-width: 0.9px;
  transform: translate(-50%,-50%);
}
td
{   
  font-size: 12px;
   padding: 10px;
   text-align: center;
}
th{
  text-align: center;
}
input{
  margin-bottom: 20px;
  margin-left: 10px;
  width: 90%;
  text-align: center;
  padding: 0px;
}

 .but1 button {

 margin-right: 80px;
}

button  {
 margin-right: 10px;
 width: 100px;
}
button [type=submit] {
 text-align: center;
  width: 390px;
  background-color: #4CAF50;
  color: white;
  padding: 14px 11px;
  margin: 60px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button[type=submit]:hover {
  background-color: #45a045;
}
.col input{
  background-color:lightcyan;
  border-style: solid;
  border-width: 2px;
}
#close span{
  color:black;
  font-size: 28px;
  line-height: 23px;
}
#close.click span:before{
  content: '\f00d';
}
.but1 a {
  
 text-align: center;
  width: 390px;
  background-color: #4CAF50;
  color: white;
  padding: 10px 11px;
  border: none;
  font-size: 20px;
  border-radius: 4px;
  cursor: pointer;
}

.but1 a:hover {
  background-color: #45a045;
}
h2{
  font-size: 50px;
}
table
{
  margin-left: 20px;
  margin-right: 20PX;
}
table,th,td
{
  border-collapse: collapse;
  border-style: solid;
}
th
{
  padding-left:5px;
  padding-right: 5px;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<title>Manager</title>
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
            <li ><a href="dashboard.php">Dashboard</a></li>
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
                  <li><a href="returnproduct.php">BAD PRODUCT</a></li>
            
               </ul>
            </li>
            <li>
               <a href="history.php" class="sale-btn">HISTORY
               </a>
               
            </li>
            <li class="active"><a href="manager.php">ADD MANAGER</a></li>
            <li ><a href="employee.php">ADD EMPLOYEE</a></li>
            
            <li>
                <a href="report.php" class="sale-btn">REPORT
               </a>
            </li>
            <li><a href="user_profile.php">ACCOUNT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
         </ul>
      </nav>
<!--sidebar-->
  <header >
            <p style="color: white;font-size: 25px; font-weight: bold;padding: 8px;margin-left: 70px;" ><?php include("php/store_name.php")?></P>
  
  </header>
	
		
		<h2>
			<center>Store Manager Information</center>
		</h2>

<br><br>
<center><div class="but1">	
<a style="color: white;" onclick="button8()"> NEW MANAGER</a>
</div><br><br>

	<form method="post" enctype="multipart/form-data" id="box1" class="box" >
   <div style="float: right; margin-right: 10px;"  class="close" id="close">
         <span class="fa fa-times" aria-hidden="true"></span>
      </div>
     <H1>MANAGER INFORMATION</H1>
 		      
		<label for="profileimage" style="padding-bottom: 10px;">Manager Image</label>
    	<img src="employee_picture/user.png" 
		class="rounded mx-auto d-block" id="profiledisplay"
		 onclick="triggerclick()" 
		 style="display: block;
		  width: 100px;
		   height: 100px;
		    margin-left: 85px;
		     border-radius: 50px;
		     " value="<?php echo "<img class='img' src='fonts/".$row['picture']."'" ?>">

		<input type="file" name="profileimage" onchange="displayimage(this)" id="profileimage" style="display: none;" >
    <div class="row">
  <div class="col">
    <input type="text" class="form-control" placeholder="Last name" name="lname" aria-label="Last name" required>
  </div>
    <div class="col">
    <input type="text" class="form-control" placeholder="First Name" name="fname" aria-label="First name" required>
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="Middle name" name="mname" aria-label="middle name">
  </div>

</div>
   <div class="row">
      <div class="col">
    <input type="text" class="form-control" placeholder="Contact Number" name="number" aria-label="number" required>
    </div>
    <div class="col">
    <input type="text" class="form-control" placeholder="Email" name="email" aria-label="email">
   </div>
   <div class="row">
      <div class="col">
    <input style="width: 850px;" type="text" class="form-control" placeholder="Current Address" name="address" aria-label="address">
    </div>
    </div>  
   </div>
     <div class="row">
  <div class="col">
    <input type="text" class="form-control" placeholder="User Name" name="username" aria-label="username"required>
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="Password" name="password" aria-label="password" required>
  </div>
  
  </div>
    <div class="but2">
    <center><button style="width: 200px;height: 50px; background-color: green;font-weight: bold;color:white;" class="but2" type="submit" name ="add_employee">Add Manager</button>
    </div>
		</form>

      
    <div  id="box2" class="box">
      
      <div style="float: right; margin-right: 10px;"  class="close" id="close">
         <span class="fa fa-times" aria-hidden="true"></span>
      </div>
  
  </div>

      </div>
			<table>
				
<?php if (isset($_SESSION['message'])): ?>
        <div class="<?=$_SESSION['alerts'];?>">
          <?= $_SESSION['message'];
            unset($_SESSION['message']);?>
        </div>
      <?php endif;?>
				<thead style="font-size: 15px;">
					<tr>
						<th>Employee Picture</th>
						<th>Employee Username</th>
						<th>Full Name</th>
						<th>Number</th>
						<th>Email</th>
						<th>Address</th>
						<th>Password</th>
						<th>Action</th>
					</tr>
        </thead>
          <tbody style="background-color:#fff; font-size: 10px;">
        
					         <?php 

         $db = mysqli_connect("localhost","root","","store_member");
         $sqli = "SELECT * FROM manager where status = 'manager' order by date_time";
         $result =mysqli_query($db,$sqli);
            $num = mysqli_num_rows($result);
            if($num>0){
              $x = 1;
               while ($res=mysqli_fetch_assoc($result)) {
                  echo "
                     <tr>
                     <td><img class='img' style='width:50px; height:50px;' src='employee_picture/".$res['picture']."' ></td>
                     <td>".$res['username']."</td>
                     <td>".$res['lastname'].', '.$res['firstname'].' '.$res['middlename']."</td>
                      <td>".$res['number']."</td>
                            <td>".$res['email']."</td>
                            <td>".$res['address']."</td>
                           <td>".$res['password']."</td>

  ";
  ?>
  						<td> 
              
                        <form action="employee.php" method="post">
                        	<button type="submit" name="delete" value="<?= $res['id'];?>">delete</button>
                        	</form>
                        <a style="text-decoration: none;color: black" href="manager_update.php?id=<?= $res['id']; ?>" ><button>Edit</button></a>
                 
                    </td>
                            <?php

                  
               }
            }
       ?>

				</tbody>
			</table>


<script src="javascript/sidebar.js"></script>
<script src="javascript/prevent_resub.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#edit").click(function(){
			$("$form1").hide();
		})
	})
</script>
<script>
function triggerclick()
{
	document.querySelector('#profileimage').click();
}
	function displayimage(e)
	{
		if (e.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e)
			{
				document.querySelector('#profiledisplay').setAttribute('src',e.target.result);
			}
			reader.readAsDataURL(e.files[0]);
		}
	}


	function trigger()
	{
		document.querySelector('#productpicture').click();
	}
	function displayproduct(e)
	{
		if (e.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e)
			{
				document.querySelector('#productdisplay').setAttribute('src',e.target.result);
			}
			reader.readAsDataURL(e.files[0]);
		}
	}

</script>
<!--edit-->
<script>
function trigger()
{
	document.querySelector('#image').click();
}
	function display(e)
	{
		if (e.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e)
			{
				document.querySelector('#display').setAttribute('src',e.target.result);
			}
			reader.readAsDataURL(e.files[0]);
		}
	}


	function trigger()
	{
		document.querySelector('#image').click();
	}
	function displaypicture(e)
	{
		if (e.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e)
			{
				document.querySelector('#display').setAttribute('src',e.target.result);
			}
			reader.readAsDataURL(e.files[0]);
		}
	}

</script>

<script>
$(document).ready(function()
{
  	setTimeout(function()
    {
      $(".alert").remove();
    },3000);

});
    
</script>
<script type="text/javascript">
  
 function button8() {
  document.getElementById("box1").style.display = "block";

  document.getElementById("box2").style.display = "none";
  }
 function button9(){
  document.getElementById("box1").style.display = "none";
  document.getElementById("box2").style.display = "block";
  
 }

</script>
<script>
var closebtns = document.getElementsByClassName("close");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>
</body>
</html>