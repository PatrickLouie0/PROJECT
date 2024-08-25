<?php
include_once('../folder/pms.php');
$profile = $con->get_profile();
$con->add_profile();
$con->getprofile();
$eid=$_SESSION['username'];
if($eid=="")
{
header('location:../login/login.php');
}
if ($eid != 2) {
	header('location:../main_event/mainevent.php');
}
include_once('../header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-v2-Modal--Full-with-Google-Map.css">
    <link rel="stylesheet" href="assets/css/styles.css">
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: black;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../background/logo.png" style="width: 75px;height: 50px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars" style="color: white"></i>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav" style="float: right;margin-right: 30px;">
      <ul class="navbar-nav ms-auto" > 
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../main_event/mainevent.php" style="color: white;">Event</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../score/score.php" style="color: white;">Score</a>
        </li>
         
         <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
          Account
        </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="../profile/profile.php">Profie</a>
          <?php
            $id = $_SESSION['username'];
            

            if ($id == 2) {?><a class="dropdown-item" href="create_account.php">Create Account</a>
              <?php
            }
            else{
            }
          ?>
          <a class="dropdown-item" href="../login/logout.php">Logout</a>
     </div>
      </li>
      </ul>
    </div>
  </div>
</nav>

	<div>
	 <?php if (isset($_SESSION['exist'])): ?>
      <script type="text/javascript">
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Name or username is already exist',
            showConfirmButton: false,
            timer: 1500
        });
      </script>
        <?php
            unset($_SESSION['exist']);
          ?>
        </div>
      <?php endif;?>
   	</div>
       <div class="container-fluid">
            <h1>User Information</h1>
            <hr>
            <form id="contactForm-1"  method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div id="successfail-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6" id="message-1">
                        <h2 class="h4"> Personal Information</h2>
                        <div class="form-group mb-3">
                        	<label class="form-label" for="from-name">Name</label>
                        	<div class="input-group">
                        		<span class="input-group-text">
                        		<i class="fa fa-user-o"></i>
                        	</span>
                        	<input class="form-control" type="text" id="name" name="name" required="" placeholder="Full Name">
                        </div>
                        </div>

   						<div class="row">
                            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                <div class="form-group mb-3">
                                	<label class="form-label" for="from-phone">User Name</label>
                                    <div class="input-group">
                                    	<span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    	<input class="form-control" type="text" id="username" name="username" required="" placeholder="User Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                <div class="form-group mb-3"><label class="form-label" for="from-calltime">Password</label>
                                    <div class="input-group">
                                    		<span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    	<input class="form-control" type="password" id="password" name="password" required="" placeholder="Password">

                                    </div>

                        <label>Show password</label>
                        <input type="checkbox" id="show-password">
                                </div>
                            </div>
                        </div>
                                          

                        <div class="row">
                         <div class="form-group mb-3">
                               <div class="form-group mb-3"><label class="form-label" for="from-calltime">Email</label>
                                    <div class="input-group">
                                    		<span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                    	<input class="form-control" type="text" id="email" name="email" required="" placeholder="Primary Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                        	<label class="form-label" for="from-comments">Address</label>
                        	<div class="input-group">
                        	<span class="input-group-text"><i class="fa-sharp fa-solid fa-location-pin"></i></span>
                        	<input class="form-control" id="address" name="address" placeholder="Current Address" rows="5">
                        	</div>
                        </div>
                        
                        <div class="form-group mb-3" id="box1">
                            <div class="row">
                                <div class="col">
                                	<button class="btn btn-primary d-block w-100" name="submit" type="submit">Submit </button>
                                </div>
                            </div>
                        </div>

                          <div class="form-group mb-3" id="box2" style="display: none;">
                            <div class="row">
                                <div class="col">
                                	<button class="btn btn-primary d-block w-100" name="update" type="submit">Update </button>
                                </div>
                            </div>
                        </div>
                      
                        <hr class="d-flex d-md-none">
                    </div>
                    </form>
                    <div class="col-12 col-md-6">
                        <h2 class="h4"><i class="fa-solid fa-users"></i> User Data</h2>
                        <div class="row">
                            <div class="col-12">
                            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-12 table-responsive">
                           		<table class="table table-bordered" style="max-height: 300px;">
                           			<thead>
                           				<tr>
                           					<th>Name</th>
                           					<th>Username</th>
                           					<th>Password</th>
                           					<th>Email</th>
                           					<th>Address</th>
                           					<th>Action</th>
                           				</tr>
                           			</thead>
                           			<tbody>
                           				<?php foreach($profile as $get): ?>
                           				<tr id="event-row-<?= $get['id'] ?>">
                           					<td><?=$get['name']?></td>
                           					<td><?=$get['username']?></td>
                           					<td data-password="<?=$get['password']?>">********</td>
                           					<td><?=$get['email']?></td>
                           					<td><?=$get['address']?></td>
                           					<td>
                           						 <form method="POST"> 	
                           						 <div class="d-flex">     
						                    	<button class="btn btn-primary" type="button" name="update" style="background-color: transparent;border-style: none;" onclick="editevent(<?php echo $get['id']; ?>)"><i class="fa fa-pencil" style="color: black"></i></button>
						                       <button name="delete" type="submit" value="<?=$get['id']?>" style="background-color: transparent;border-style: none;"><i class="fa fa-trash" style="color: black;"></i></button>
						                        </div>
						                        </form>
						                    
                           					</td>
                           				</tr>
                           				<?php endforeach;?>
                           			</tbody>
                           		</table>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Contact-Form-v2-Modal--Full-with-Google-Map.js"></script>
  <script type="text/javascript">
   function editevent(id) {
    // Retrieve the data from the current row
    var name = document.getElementById("event-row-" + id).cells[0].innerText;
    var username = document.getElementById("event-row-" + id).cells[1].innerText;
    var password = document.getElementById("event-row-" + id).cells[2].getAttribute("data-password");
    var email = document.getElementById("event-row-" + id).cells[3].innerText;
    var address = document.getElementById("event-row-" + id).cells[4].innerText;
  
    // Show the data in the modal fields
    document.getElementById("name").value = name;
    document.getElementById("username").value = username;
    document.getElementById("password").value = password;
    document.getElementById("email").value = email;
    document.getElementById("address").value = address;


      document.getElementById("box1").style.display = "none";
      document.getElementById("box2").style.display = "block";

}

     const passwordInput = document.getElementById("password");
        const showPasswordCheckbox = document.getElementById("show-password");

        showPasswordCheckbox.addEventListener("change", function() {
        if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
        } else {
        passwordInput.type = "password";
        }
        });

</script>
</body>

</html>