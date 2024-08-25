<?php 
	if (isset($_POST['submit'])) 
	{
   		 $name = $_POST['name'];
   		 $detail = $_POST['detail'];
   		 $db = mysqli_connect("localhost","root","","storenewdb");
         $sqli = "INSERT INTO `request_product`(`product_name`, `details`) VALUES ('$name','$detail')";
         $sqli = mysqli_query($db,$sqli);
        if ($sqli) 
        {
          echo "successfully";
        }
        else
        echo "not successfully";
        
	}

?>
<?php 
session_start();
                $con = mysqli_connect("localhost","root","","storenewdb") or die("not connect");
              if (isset($_POST['delete'])) {
              $id = $_POST['delete'];
               $stmt = $con->prepare("DELETE FROM `request_product` WHERE id = $id");
               $run = $stmt->execute();
                  if ($run) {
                    $_SESSION['delete'] = "transaction complete";
                    echo "complete";
                  }
                  else
                  {
                    echo "failed ";
                  }
      
          }

?>

<!DOCTYPE html>
<html>
<head>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     
	<style type="text/css">
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
  top: 3px;
  left: 2px;
  height: 45px;
  width: 45px;
  font-size: 15px;
  text-align: left;
  border-radius: 3px;
  cursor: pointer;
  transition: left 0.4s ease;
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
	background-color: blue;
	height: 40px;
	margin-bottom: 10px;
}
.wrapper
{
  display: flex;
}
.Request_form {
    width: 400px;
    height: 500px;
    background-color: #f5f5f5;
}
.Request_form .detail
{
	height: 300px;
	width: 300px;
}
table
{
  width: 820px;
}
.table
{
    margin-left: 20px;
    background-color: #f5f5f5;
      width: 850px;
      height: 500px;
    text-align: center;
    overflow-y: scroll;

}
button
{
  background-color: #0d6efd;
  border-color: #0d6efd;
}
label,input,textarea
{
  margin-left: 10px;
}
	</style>
	<title>Request Product</title>
</head>
<body>
	  <div class="btn" id="btn">
        <i class="fa fa-bars" aria-hidden="true" style="height: 200px; width: 200px;"></i>
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
                  <li><a href="request_product.php">Request Product</a></li>
                  <li><a href="returnproduct.php">Return Product</a></li>

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
      <header></header>
      <div class = "wrapper">
      <form class="Request_form" method="POST" action="request_product.php">
      	<h1>
      		Request New Product
      	</h1>
      	<label>Product Name</label>
      	<br>
      	<input type="text" name="name">
      	<br>
      	<label>Product Details</label>
      	<br>
      	<textarea name="detail">
      		
      	</textarea>
      	<br>
      	<input type="submit" name="submit">
      </form>
      <div class="table">
      <table>
      	<tr>
        	<th>Name of Product</th>
      		<th>Product Details</th>
          <th>Date</th>
          <th>Action</th>
      	</tr>

      	<?php 

         $db = mysqli_connect("localhost","root","","storenewdb");
         $sqli = "SELECT * FROM request_product";
         $result =mysqli_query($db,$sqli);
            $num = mysqli_num_rows($result);
            if($num>0){
              $x = 1;
               while ($res=mysqli_fetch_assoc($result)) {
                  echo "
                     <tr>
                           <td>".$res['product_name']."</td>
                      <td>".$res['details']."</td>
                            <td>".$res['date_time']."</td>
                            ";
                          ?>
                          <form method="post">
               <td><button type="submit" name="delete" value="<?= $res['id'];?>">Done</button>
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
<!--sidebar-->
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
      <script src="javascript/prevent_resub.js"></script>
</body>
</html>