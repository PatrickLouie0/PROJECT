<?php 

 require_once('../folder/pms.php');
 $con->main_event();
 include('../con.php');

$eid=$_SESSION['username'];
if($eid=="")
{
header('location:../login/login.php');
}
include_once('../header.php');

if (isset($_POST['update_web_info'])) {
            $main_event_id = filter_var($_POST['main_event_id'],FILTER_SANITIZE_STRING);
            $picture = time() . '_' . $_FILES['image']['name'];
            
                if ($_FILES['image']['size'] == 0) {

                
                $link1 = filter_var(strtolower($_POST['facebooklink']),FILTER_SANITIZE_STRING);
                $link2 = filter_var($_POST['instagramlink'],FILTER_SANITIZE_STRING);
                $link3 = filter_var($_POST['twitterlink'],FILTER_SANITIZE_STRING);
                
                $stmt = $pdo->prepare("UPDATE `website` SET `facebooklink`= :link1,`instagramlink`=:link2,`twitterlink`=:link3 WHERE main_event_id = :main_event_id");
                    $stmt->bindParam(':link1',$link1);
                    $stmt->bindParam(':link2', $link2);
                    $stmt->bindParam(':link3', $link3);
                    $stmt->bindParam(':main_event_id', $main_event_id);
                    $stmt->execute();
                        
                    if($stmt)
                    {
                        $_SESSION['success']= "successfully added";
                    }
                    
                }
                
                else
                {
                $picture = time() . '_' . $_FILES['image']['name'];
                $target = 'assets/picture/' . $picture;
                
                $link1 = filter_var(strtolower($_POST['facebooklink']),FILTER_SANITIZE_STRING);
                $link2 = filter_var($_POST['instagramlink'],FILTER_SANITIZE_STRING);
                $link3 = filter_var($_POST['twitterlink'],FILTER_SANITIZE_STRING);
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
                    {
                    
                    $stmt = $pdo->prepare("UPDATE `website` SET `picture`= :picture,`facebooklink`= :link1,`instagramlink`=:link2,`twitterlink`=:link3  WHERE main_event_id = :main_event_id");
                        $stmt->bindParam(':picture',$picture);
                        $stmt->bindParam(':link1',$link1);
                        $stmt->bindParam(':link2', $link2);
                        $stmt->bindParam(':link3', $link3);
                        $stmt->bindParam(':main_event_id', $main_event_id);
                            $stmt->execute();
                            
                        if($stmt)
                        {
                            $_SESSION['success']= "successfully added";
                        }
                    }
                }
        }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer=""></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">

    <link rel="stylesheet" type="text/css" href="assets/css/table.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/styles.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>

    <style type="text/css">
        table,tr,td
        {
            border-style: 1px solid black;
        }
    </style>
</head>

<body style="background: url(../background/bg.jpg) center / cover no-repeat;height: 500px;">



<nav class="navbar navbar-expand-lg navbar-light" style="background-color: black;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../background/logo.png" style="width: 75px;height: 50px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars" style="color: white"></i>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav" style="float: right;margin-right: 30px;">
      <ul class="navbar-nav ms-auto" > 
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="mainevent.php" style="color: white;">Event</a>
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
            

            if ($id == 2) {?><a class="dropdown-item" href="../new account/create_account.php">Create Account</a>
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

<div class="text-center">
    <h1 style="font-weight: bolder">Main Event</h1>
</div>



    <div class="container ms-0 my-2 py-1"><button class="btn btn-primary" type="button" data-bs-target="#modal-2" data-bs-toggle="modal"><strong>Event</strong></button></div>
    
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: var(--bs-blue);"><strong>ADD EVENT</strong></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="text" name="user_id" value="<?=$_SESSION['username']?>" hidden >
                        <div class="mb-3"><label class="form-label">Event Name</label><input class="form-control" type="text" name="event_name"></div>
                        <div class="mb-3"><label class="form-label">Event Description</label><textarea class="form-control" name="event_description"></textarea></div>
                        <div class="mb-3"><label class="form-label"  >Event Date</label><input class="form-control form-control" type="date" name="event_date_start"></div>
                        <div class="mb-3"><label class="form-label"  >Event Time</label><input class="form-control form-control" type="time" name="event_time_start"></div>
                        <div class="mb-3"><label class="form-label"  >Event Date End</label><input class="form-control form-control" type="date" name="event_date_end"></div>
                        <div class="mb-3"><label class="form-label"  >Event Time End</label><input class="form-control form-control" type="time" name="event_time_end"></div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="submit">Save</button></div>
                    </form>
                </div>
                
            </div>
        </div>

    </div>

    <!--edit event-->
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: var(--bs-blue);"><strong>EDIT EVENT</strong></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                          
                        <input class="form-control" type="text" id="event_name_value" name="event_name_value" hidden="">

                        <input class="form-control form-control" id="event_date_start_value" type="date" name="event_date_start_value" hidden="">

                        <input class="form-control form-control" type="time" id="event_time_start_value" name="event_time_start_value" hidden="">
                        
                        <div class="mb-3"><label class="form-label">Event Name</label>
                            <input class="form-control" type="text" id="event_name" name="event_name"></div>
                        <div class="mb-3"><label class="form-label">Event Description</label>
                            <textarea class="form-control"  id="event_description" name="event_description"></textarea></div>
                        <div class="mb-3"><label class="form-label"  >Event Date</label>
                            <input class="form-control form-control" id="event_date_start" type="date" name="event_date_start"></div>
                        <div class="mb-3"><label class="form-label"  >Event Time</label>
                            <input class="form-control form-control" type="time" id="event_time_start" name="event_time_start"></div>
                        <div class="mb-3"><label class="form-label"  >Event Date End</label>
                            <input class="form-control form-control" type="date" id="event_date_end" name="event_date_end"></div>
                        <div class="mb-3"><label class="form-label"  >Event Time End</label>
                            <input class="form-control form-control" type="time" id="event_time_end" name="event_time_end"></div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="update_event">Save</button></div>
                    </form>
                </div>
                
            </div>
        </div>

    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: var(--bs-blue);"><strong>EDIT EVENT</strong></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
                
            </div>
        </div>

    </div>

    


    <div class="table-responsive mx-2" style="height: 70%;width: 97%;">
        
        <?php
            include('event_table.php');
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
    <script type="text/javascript">
function trigger() {
  document.querySelector('#website-picture').click();
}

function display(e) {
  if (e.target.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      document.querySelector('#website_picture').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
  }
}
</script>
</body>

</html>