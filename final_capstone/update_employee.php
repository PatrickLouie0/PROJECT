 <?php 
	
session_start();
	require_once('store.php');
	$store->employee();
	$store->update_employee_data();	
	$store->delete_employee_data();
 ?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
	height: 50px;
	background-color: blue;
}
.box
{
  background-color:green;display: none; position: absolute; height: 500px;width: 700px; top: 50%;left: 50%; transform: translate(-50%,-50%);
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<title></title>
</head>
<body>
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
            <li class="active"><a href="dashboard.php">Dashboard</a></li>
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
                  <li><a href="request_product.php">Request Product</audio></li>
               </ul>
            </li>

            <li>
               <a href="#" class="sale-btn">HISTORY
               <span class="fas fa-caret-down third"></span>
               </a>
               <ul class="sale-show">
                  <li><a href="transactionhistory.php">TRANSACTION HISTORY</a></li>
                </ul>
            </li>
            <li><a href="employee.php">ADD EMPLOYEE</a></li>
            <li><a href="account.php">ACCOUNT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
         </ul>
      </nav>
<!--sidebar-->
  <header >
  </header>
	
		
		<h2>
			Store Manager Information
		</h2>
	
<button onclick="button8()"> NEW MANAGER</button>
<button onclick="button9()">UPDATE INFORMATION</button>
	<form method="post" enctype="multipart/form-data" id="box1" class="box" >

     Manager Information
 		       <div class="container">
        <?php if (isset($_SESSION['msg'])): ?>
        <div class="<?=$_SESSION['alert'];?>">
          <?= $_SESSION['msg'];
            unset($_SESSION['msg']);?>
        </div>
      <?php endif;?>
      </div>
		<label for="profileimage" style="padding-bottom: 10px;">Employee Image</label>
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
    <input type="text" class="form-control" placeholder="Current Address" name="address" aria-label="address">
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
  
    <button type="submit" name ="add_employee">Add employee</button>
		</form>

       <div class="container">
        <?php if (isset($_SESSION['msg'])): ?>
        <div class="<?=$_SESSION['alert'];?>">
          <?= $_SESSION['msg'];
            unset($_SESSION['msg']);?>
        </div>
      <?php endif;?>
      </div>
    <div  id="box2" class="box">
  <form method="post" enctype="multipart/form-data" >
   Update Information
    
<?php  
//update form
$id = '';
$username = '';
$lastname = '';
$firstname = '';
$middlename = '';
$number = '';
$email = '';
$address = '';
$password = '';
  if (isset($_POST['search_id'])) 
  {
    $connection = mysqli_connect("localhost","root","","store_member");
         
    $id = $_POST['id'];
    $query = "SELECT * FROM employee WHERE id = $id";
    $run = mysqli_query($connection,$query);

          while ($row = mysqli_fetch_array($result))
      {
        $id = $row['id'];
        $username = $row['username'];
        $lastname = $row['lastname'];
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $number = $row['number'];
        $email = $row['email'];
        $address = $row['address'];
        $password = $row['password'];
      }
    }
  ?>    
    <input type="text" class="form-control" value="" name="id" placeholder = "User ID" aria-label= "">
    <button type="search_id">Search</button>
    <label for="image" style="padding-bottom: 10px;">Manager Picture</label>
      <img src="employee_picture/user.png" 
    class="display"value="<?php echo "<img class='img' src='fonts/".$row['picture']."'"; ?>" id="display"
     onclick="trigger()" 
     style="display: block;
      width: 100px;
       height: 100px;
        margin-left: 85px;
         border-radius: 50px;
         " >
    <input type="file" name="image" onchange="displaypicture(this)" id="image" style="display: none;" >
      <div class="row">
      <div class="col">
    <label>lastname</label>
    <input type="text" class="form-control" name="lname" value="<?php echo $lastname?>" placeholder = "Last Name" aria-label= "">
  </div>
     <div class="col">
    <label>firstname</label >
    <input type="text" class="form-control" name="fname" value="<?php echo $firstname?>" placeholder = "First Name" aria-label= "">
  </div>
  <div class="col">
    <label>middlename</label>
    <input type="text" class="form-control" name="mname" value="<?php echo $middlename?>" placeholder = "Middle Name" aria-label= "">
  </div>
  </div>
  <div class="row">
  <div class="col">
    <label>number</label>
    <input type="text" class="form-control" name="number" value="<?php echo $number?>" placeholder = "Number" aria-label= "">
  </div>

  <div class="col">
    <label>email</label>
    <input type="text" class="form-control" name="email" value="<?php echo $email?>" placeholder = "Email" aria-label= "">
  </div>
  </div>
    <div class="row">
      <div class="col">
    <label>address</label>
    <input type="text" class="form-control" name="address" value="<?php echo $address?>" placeholder = "Address" aria-label= "">
  </div>
</div>
  <div class="row">
    <div class="col">
    <label>username</label>
    <input type="text" class="form-control" value="<?php echo $username?>" placeholder = "User Name" name="username"aria-label= "">
  </div>
  <div class="col">
    <label> password</label>
    <input type="text" class="form-control" name="password" value="<?php echo $password?>" placeholder = "Password" aria-label= "">
    </div>
    </div>
    <button type="submit" name="update">Update</button>
 </form>
  </div>

      </div>
			<table>
				
<?php if (isset($_SESSION['message'])): ?>
        <div class="<?=$_SESSION['alerts'];?>">
          <?= $_SESSION['message'];
            unset($_SESSION['message']);?>
        </div>
      <?php endif;?>
				</thead>
				<tbody style="background-color:#fff;">
					<tr>
						<th>employee picture</th>
						<th>employee username</th>
						<th>lastname</th>
						<th>firstname</th>
						<th>middlename</th>
						<th>number</th>
						<th>email</th>
						<th>address</th>
						<th>password</th>
						<th>action</th>
					</tr>
					         <?php 

         $db = mysqli_connect("localhost","root","","store_member");
         $sqli = "SELECT * FROM employee";
         $result =mysqli_query($db,$sqli);
            $num = mysqli_num_rows($result);
            if($num>0){
              $x = 1;
               while ($res=mysqli_fetch_assoc($result)) {
                  echo "
                     <tr>
                     <td><img class='img' style='width:50px; height:50px;' src='employee_picture/".$res['picture']."' ></td>
                     <td>".$res['username']."</td>
                     <td>".$res['lastname']."</td>
                     <td>".$res['firstname']."</td>
                           <td>".$res['middlename']."</td>
                      <td>".$res['number']."</td>
                            <td>".$res['email']."</td>
                            <td>".$res['address']."</td>
                           <td>".$res['password']."</td>

  ";
  ?>
  						<td>
                        <form action="employee.php" method="post">
                        	<button type="submit" name="delete" value="<?= $res['id'];?>">delete</button>
                        	<input type="hidden" name="employee_id" value="<?php echo $res['id']?>">
                        	<button type="submit" name="edit" class=" btn-success" id="edit" >edit</button>
                        </form>
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

</body>
</html>