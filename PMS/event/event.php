<?php 
 require_once('../folder/pms.php');   
 include('../header.php');
  $con->event(); 
  $con->delete_event();

$eid=$_SESSION['username'];
$meid = $_GET['id'];
if($eid=="" )
{
header('location:../login/login.php');
}
elseif (empty($meid)) {
    header('location:../main_event/mainevent.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer=""></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
       <link rel="stylesheet" type="text/css" href="../main_event/assets/css/table.css">
 
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/styles.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
        <style type="text/css">
        table,th,td
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
    <div class="text-center" >
        <h1 style="font-weight: bold;">Sub Event</h1>
    </div>
    <div class="container ms-0 my-2 py-1"><button class="btn btn-primary" type="button" data-bs-target="#modal-2" data-bs-toggle="modal"><strong>Sub Event</strong></button></div>
    
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">


                    <h4 class="modal-title" style="color: var(--bs-blue);"><strong>ADD EVENT</strong></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="text" name="user_id" value="<?=$_GET['id']?>" hidden>
                        <div class="mb-3"><label class="form-label">Event Name</label>
                            <input class="form-control" type="text" name="event_name"></div>

                        <div class="mb-3">
                            <label>Is this for top 5 Candidates<small style="color: red">(if not please ignore this)</small></label><br>
                            <input type="checkbox" id="" name="top" value="5">
                            <label for="top">Yes</label>
                        </div>
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

                        <div class="mb-3">
                            
                            <label>Is this for top 5 Candidates<small style="color: red">(if not please ignore this)</small></label><br>
                            <input type="checkbox" id="top" name="top" value="5" checked>
                            <label for="top">Yes</label>
                        </div>
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
    
    <div class="table-responsive mx-2" style="width: 98%;">
        
        <?php
            include('event_table.php');
        ?>

    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
</body>

</html>