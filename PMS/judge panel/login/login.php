<?php
    require_once("../pms_judge.php");
    $con->judge_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
     <link  rel = "icon" href ="../../background/logo.png" type = "image x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-blue-Gradient-1.css">
    <link rel="stylesheet" href="assets/css/Login-Form-blue-Gradient.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aguafina+Script&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alex+Brush&amp;display=swap">
    <script src=”//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js”></script>
    <style type="text/css">
        h1
        {
            color: white;
            font-weight: bolder;
            text-shadow: 4px 3px 5px orange;
            font-size: 32px;
            padding-bottom: 1rem;
        }
    </style>
</head>
<body style="background: url('assets/picture/background-1.avif') center / cover no-repeat; height: 526px;background-color: black;">
       <?php if (isset($_SESSION['failed'])): ?>
      <script type="text/javascript">
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Wrong password...please try again',
            showConfirmButton: false,
            timer: 1500
        });
      </script>
        <?php
            unset($_SESSION['failed']);
          ?>
      <?php endif;?>

      <?php if (isset($_SESSION['validate'])): ?>
      <script type="text/javascript">
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'You are not allowed to login...please contact the event organizer for more information',
            showConfirmButton: false,
            timer: 4500
        });
      </script>
        <?php
            unset($_SESSION['failed']);
          ?>
      <?php endif;?>
    <nav class="navbar navbar-light navbar-expand-md" style="background-color: black">
        <div class="container-fluid"><a class="navbar-brand" href="#" style="font-family: 'Alex Brush', serif;color: rgba(255,153,0,0.9);font-weight: bold;text-align: center;font-size: 23px;"><strong>PMS</strong></a>
        </div>
    </nav>

    <section>
        <div class="container login-cont">
            <div class="row">
                <div class="col-10 col-sm-6 col-md-4 col-lg-4 offset-1 offset-sm-3 offset-md-4 offset-lg-4 login-col">
                    <form class="login-form" method="post">
                        <h1>PCMS JUDGE LOGIN</h1>
                        <div class="form-group mb-3">
                            <input class="form-control form-control-lg lg-frc" type="password" required="" placeholder="Enter Code" name="password"></div>
                        <div class="form-group mb-3">
                            <button class="btn btn-light btn-lg login-btn" type="submit" name="login"><strong>Login</strong></button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>