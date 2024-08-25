 <?php
  require_once('store.php');
  $store->update_employee_data(); 

  $id = $_GET['id'];
  $con = mysqli_connect("localhost","root","","store_member");
  $sql = mysqli_query($con,"SELECT `id`, `picture`, `username`, `password`, `lastname`, `firstname`, `middlename`, `number`, `email`, `address`, `status` FROM employee WHERE id = $id");
  if (mysqli_num_rows($sql)) {
    $res = mysqli_fetch_assoc($sql);
  }
 ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
 <div id="box-1" style="background-color: #f0f0f0; padding-bottom: 160px;">
		<form method="post" enctype="multipart/form-data" id="box1" class="box" >

    <input type="text" name="id" value="<?php echo $_GET['id']; ?>" hidden> 


   <div style="float: right; margin-right: 10px;"  class="close" id="close">
         <span class="fa fa-times" aria-hidden="true"></span>
      </div>
     <H1 style="text-align: center;" >UPDATE EMPLOYEE INFORMATION</H1>
 		      
    	<img  <?php echo " src='employee_picture/".$res['picture']."'" ?>
		class="rounded mx-auto d-block" id="profiledisplay"
		 onclick="triggerclick()" 
		 style="display: block;
		  width: 100px;
		   height: 100px;
		    margin-left: 85px;
        margin-bottom: 10px;
		     border-radius: 50px;
		     " value="<?php echo "<img class='img' src='fonts/".$res['picture']."'" ?>">

		<input type="file" name="profileimage"  onchange="displayimage(this)" id="profileimage" style="display: none;" >
    <div class="row">
  <div class="col" style="margin-bottom: 10px;">
    <input type="text" class="form-control" placeholder="Last name" name="lname" value="<?php echo $res['lastname'] ?>" aria-label="Last name" required>
  </div>
    <div class="col" style="margin-bottom: 10px;">
    <input type="text" class="form-control" placeholder="First Name" name="fname" value="<?php echo $res['firstname'] ?>" aria-label="First name" required>
  </div>
  <div class="col" style="margin-bottom: 10px;">
    <input type="text" class="form-control" placeholder="Middle name" name="mname" value="<?php echo $res['middlename'] ?>" aria-label="middle name">
  </div>

</div>
   <div class="row">
      <div class="col" style="margin-bottom: 10px;">
    <input type="text" class="form-control" placeholder="Contact Number" name="number" value="<?php echo $res['number'] ?>" aria-label="number" required>
    </div>
    <div class="col" style="margin-bottom: 10px;">
    <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $res['email'] ?>" aria-label="email">
   </div>
   <div class="row">
      <div class="col" style="margin-bottom: 10px;">
    <input style="margin-left: 10px" type="text" class="form-control" placeholder="Current Address" name="address" value="<?php echo $res['address'] ?>"aria-label="address">
    </div>
    </div>  
   </div>
     <div class="row">
  <div class="col" style="margin-bottom: 10px;">
    <input type="text" class="form-control" placeholder="User Name" name="username" value="<?php echo $res['username'] ?>" aria-label="username"required>
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="Password" name="password" value="<?php echo $res['password'] ?>" aria-label="password" required>
  </div>
  
  </div>
    <div class="but2">
    <center><button style="width: 200px;height: 50px; background-color: green;font-weight: bold; color:white; " class="but2" type="submit" name ="update_employee">Update</button>
    </div>
		</form>

</div>
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
