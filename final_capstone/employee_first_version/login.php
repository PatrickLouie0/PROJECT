<!DOCTYPE html>
<html>
<head>
<?php  
	require_once('../store.php');
	$store->login_member();
?>
<?php
$con = mysqli_connect("localhost","root","","storenewdb");
$sql = "SELECT store_name FROM store_details";
$run = mysqli_query($con,$sql);
while ($res = mysqli_fetch_array($run)) {
 $store_name = $res['store_name'];
}
?>
	<style type="text/css">
	 @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Be Vietnam Pro', sans-serif;
}
body{
  justify-content: center;
  align-items: center;
  padding: 10px;
  background-size: cover;
  background-color: white;
}
.container{
  max-width: 500px;
  width: 100%;
  background-color: #fff;
  padding: 60px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.15);
}
.container .title{
  font-family: 'Be Vietnam Pro', sans-serif;
  font-size: 25px;
  font-weight: 500;
  position: relative;
}

.user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}

 form .button{
  width: 400px;
   height: 45px;
   margin: 35px 0
 }
 form .button input{
   height: 100%;
   width: 100%;
   border-radius: 5px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: linear-gradient(135deg, #034f84, #45a049);
 }
 form .button input:hover{
  /* transform: scale(0.99); */
  background: linear-gradient(135deg,#45a049, #034f84);
  }
 @media(max-width: 584px){
 .container{
  max-width: 100%;
     
}
     
form .user-details .input-box{
    margin-bottom: 15px;
    width: 100%;
  }
  form .category{
    width: 100%;
  }
  .content form .user-details{
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar{
    width: 5px;
  }
     form .button input{
   height: 100%;
   width: 50%;
   margin-left: -80px;
   border-radius: 5px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: linear-gradient(135deg, #034f84, #45a049);
 }
  }
  @media(max-width: 459px){
  .container .content .category{
    flex-direction: column;
  }
}
a {
  text-decoration: none;
  color: #000;
}
.site-header {
	color: white;
  opacity: .90;
  background-color: #034f84;
  border-bottom: 1px solid #ccc;
  padding: .3em 1em;
}

.site-header::after {
  content: "";
  display: table;
  clear: both;
}

.site-identity {
  float: left;
}

.site-identity h1 {
  font-size: 1.5em;
  margin: .7em 0 .3em 0;
  display: inline-block;
}

.site-identity img {
  border-radius: 50px;
  max-width: 55px;
  float: left;
  margin: 0 10px 0 0;
}

.site-navigation {
  float: right;
}

.site-navigation ul, li {
  margin: 0; 
  padding: 0;
}

.site-navigation li {
  display: inline-block;
  margin: 1.4em 1em 1em 1em;
}
a .create{
  color: #71b7e6;
}
	</style>
<html lang="en" dir="ltr">
    <meta charset="UTF-8">
    <title>Log in Page </title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
   <header class="site-header">
    <script src="https://kit.fontawesome.com/2724083925.js" crossorigin="anonymous"></script>
    <link  rel = "icon" href ="images/logo.png" type = "image x-icon">
    <div class="site-identity">
    <img src="../image/Product (2).png " alt="#logo" />
    <h1><?php echo $store_name;?></h1>
  </div>  
 </header><br><br><br>

  <center><div class="container">
    <div class="title">EMPLOYEE LOGIN</div>
    <div class="content"><br>
    <form class="modal-content animate" action="login.php" method="POST">

        <div class="user-details">
          <div class="input-box">
           <label for="username">User Name</label>
		<input type="text" name="username" required="enter username">
          </div><br>
          <div class="input-box">
            <label for="password">Password</label>
		<input type="password" name="password" required="enter password">
          </div>
          
        </div>
        <div class="button">
         <input type="submit" name="submit" value="LOGIN">
        </div>
      </form>
    </div>
  </div><br>
  <script src="javascript/prevent_resub.js"></script>
</body>
</html>







