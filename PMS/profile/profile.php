<?php
require_once('../folder/pms.php');
$profile = $con->profile();
$con->update_profile();
include('../header.php');

$eid=$_SESSION['username'];
if($eid=="" )
{
header('location:../login/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>profile</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Account-setting-or-edit-profile.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>

</head>

<body style="background: url(../background/bg-form.png) center / cover no-repeat;height: 580px;">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: black;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../background/logo.png" style="width: 75px;height: 60px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars" style="color: white"></i>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav" style="float: right;">
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
            

            if ($id == 2) {?><a class="dropdown-item" href="../new account/create_account.php"><?=$id?>Add Account</a>
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
    <div class="container" >
    <div class="row gutters">
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mx-auto" style="margin-top: 50px">
    <div class="card h-100">
        <div class="card-body">

            <form method="POST" class="form">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Personal Details</h6>
                </div>
                <?php foreach($profile as $get):?>
    
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>

                        <input type="text" class="form-control" id="fullName" name="name_value" value="<?=$get['name']?>" placeholder="Enter full name" hidden>
                        <input type="text" class="form-control" id="fullName" name="username_value" value="<?=$get['username']?>" placeholder="Enter full name" hidden>

                        <input type="text" class="form-control" id="fullName" name="name" value="<?=$get['name']?>" placeholder="Enter full name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="eMail">Email</label>
                        <input type="email" class="form-control" id="eMail" name="email" value="<?=$get['email']?>" placeholder="Enter email">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="phone">UserName</label>
                        <input type="text" class="form-control" id="phone" name="username" value="<?= $get['username'] ?>" placeholder="Enter UserName">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="website">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?= $get['password'] ?>" placeholder="Password">
                        <label>Show password</label>
                        <input type="checkbox" id="show-password">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Address</h6>
                </div>
                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="zIp" name="address" value="<?= $get['address'] ?>" placeholder="Address">
                    </div>
                </div>
            </div>

           
        <?php endforeach;?>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right mt-2">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
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