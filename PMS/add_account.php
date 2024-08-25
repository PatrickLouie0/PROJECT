<?php
require_once('folder/pms.php');
$profile = $con->profile();
$con->add_profile();
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>profile</title>
    <link rel="stylesheet" href="profile/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile/assets/css/Account-setting-or-edit-profile.css">
    <link rel="stylesheet" href="profile/assets/css/styles.css">
</head>

<body class="bg-dark">
    <div class="container" >
    <div class="row gutters">
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mx-auto" style="box-shadow: 2px 2px 5px white;margin-top: 50px">
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
            <div class="row gutters ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-0 mb-2 text-dark">Address</h6>
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
                    <div class="text-right">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Add Account</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    </div>
    
    </div>
    </div>

    <script src="profile/assets/bootstrap/js/bootstrap.min.js"></script>
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