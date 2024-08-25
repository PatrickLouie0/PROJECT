 <?php
 session_start();
  $eid=$_SESSION['usernames'];
if($eid=="")
{
header('location:Login.php');
}
 $usernames = $_SESSION['usernames'];

$id = '';
$picture = '';
$username = '';
$lastname = '';
$firstname = '';
$middlename = '';
$number = '';
$email = '';
$address = '';
$password = '';
 $store_name = '';
$street = '';
$barangay = '';
$municipality = '';
$province =''; 
$near = '';
     // $checker_if_someone_is_login = $connection->prepare("SELECT * FROM employee_info WHERE id = '1'");
    //  $checker_if_someone_is_login->execute();
      //if ($checker_if_someone_is_login) {
      //  echo '<h2 style = "position:absolute;top:120px; background-color:red;"> '.'PLEASE LOGOUT THE ACCOUNT TO LOGIN NEW ACCOUNT...SORRY FOR INCONVENIENCE'.'<h2>';
      //}
      //else
      //{
      
  $con = mysqli_connect("localhost","root","","store_member");
  $sql = "SELECT `id`, `picture`, `username`, `password`, `lastname`, `firstname`, `middlename`, `number`, `email`, `address`, `status`, `date_time` FROM employee
    where username = '$usernames';
   ";
   $result = mysqli_query($con,$sql);
  
  
       while ($row = mysqli_fetch_array($result))
      {
        $id = $row['id'];
        $picture = $row['picture'];
        $username = $row['username'];
        $lastname = $row['lastname'];
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $number = $row['number'];
        $email = $row['email'];
        $address = $row['address'];
        $password = $row['password'];

      }
?>

<?php

require_once('../store.php');
  $store->update_employee_profile();
 ?>
<!DOCTYPE html>
<html>
<head>
  
     <link  rel = "icon" href ="../image/Product (2).png" type = "image x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       
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
 .data_update
    {
      height: 370px;
      width: 1200px;
      padding: 20px;
      margin-left: 80px;
     
    }
    .store_data
    {
      height: 310px;
      width: 1230px;
      background-color: #f5f5f5;
      margin-top: 10px;
      margin-left: 20px;
      padding: 20px;
    }
    .info_details
    {
      display: inline;
      float: right;
      background-color: #f5f5f5;
      height: 500px;
      width: 400px;
    }
    .update-button
    {
      background-color: green;
      border-color: green;
      margin-top: 10px;
      float:right;
      cursor: pointer;
    }
    .picture{
       
         height: 370px;
         width: 240px;
    }
    input{
      border-style: solid;
      border-width: 3px;
    }
    img{
      display: block;
      width: 200px;
       height: 200px;
        margin-left: 5px;
         border-radius: 50%;
    }
    @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  .data_update {
    width: 100%;
    margin-left: 2px;
  }
}
 @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  header{
    width: 100%;
  
  }
}
 @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  input{
    height: 30px;
  }
}
@media only screen and (orientation: landscape) {
    .data_update {
    width: 100%;
    margin-left: 2px;
  }
}
@media only screen and (orientation: landscape) {
    input {
     border-style: solid;
      border-width: 3px;
  }
}
  </style>
  <title>Manger Profile</title>
</head>
<body>
  <div class="con">
      <div class="btn" id="btn">
         <span class="fas fa-bars" style=""></span>
      </div>
      <nav class="sidebar">
         <div class="text">

      <div class="btn" id="btn">
         <span class="fa fa-times"></span>
      </div>
      <br>
      <p>Sales&Inventory</p>
         </div>
            <li>
               <ul class="serv-show">
                  <li><a href="viewproduct.php">VIEW PRODUCT</a></li>
                       <li><a href="check_stock.php">CHECK STOCK</a></li>       
                  <li class="active"><a href="user_profile.php">ACCOUNT</a></li>
                  <li><a href="logout.php">LOGOUT</a></li>
                  
               
               </ul>
            </li>
         </ul>
      </nav>
      <header>     <p style="color: white;font-size: 25px; font-weight: bold;padding: 4px;margin-left: 60px;" ><?php include("../php/store_name.php")?></p></header>
 
  <?php if (isset($_SESSION['alerts'])): ?>
      <script type="text/javascript">
        swal({
        title: "User Information Updated Successfully!",
        text: "click the button to exit!",
        icon: "success",
        button: "close",
        });
      </script>
       <?php
            unset($_SESSION['alerts']);
        endif
      
          ?>

            <form action="" method="post" enctype="multipart/form-data" >

    <input type="text" name="id" value="<?php echo $id; ?>" hidden >
    
  <div class="data_update">
  <center><h1>PERSONAL INFORMATION</h1>

    <center>
      <img <?php echo "<img class='img' src='../employee_picture/".$picture."'" ?> 
    class="display" 
    id="display"
     onclick="trigger()" 
     value="<?php echo "<img class='img' src='../employee_picture/".$picture."'" ?>">
    <input type="file" name="profileimage" onchange="displaypicture(this)" id="image" style="display: none;" >
      <label for="profileimage">Employee Picture</label>

    
       <BR><BR><div class="row">
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
    <input type="text" class="form-control" value="<?php echo $username?>" placeholder = "User Name" name="username"aria-label= "" readonly>
  </div>
  <div class="col">
    <label> password</label>
    <input type="text" class="form-control" name="password" value="<?php echo $password?>" placeholder = "Password" aria-label= "">
    </div>
    </div>
    <button type="submit" class="update-button" name="update_employee" >UPDATE</button><br><br>
   </div>

</form>
    </div>

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
      <script src="../javascript/prevent_resub.js"></script>

</body>
</html>