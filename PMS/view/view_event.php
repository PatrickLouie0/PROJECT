<?php
    include('../header.php');
    require_once('../folder/pms.php');
    $con->add_new_criteria();
    $con->add_new_judge();
    $con->add_new_contestant();
    $con->update();
    $con->delete();
$eid=$_SESSION['username'];
if($eid=="")
{
header('location:../login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
    <script type="text/javascript" src="assets/javascript/javascript.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>

</head>

<body class="" style="background: url(../background/bg.jpg) center / cover no-repeat;">

<!--print content-->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: black;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../background/logo.png" width="70px" height="50px"></a>
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


    <!--Edit criteria-->
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Criteria</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="text" name="criteria_name_value" id="criteria_name_value" hidden>
                        <input type="text" name="criteria_percent_value" id="criteria_percent_value" hidden="">
                        <input type="text" name="criteria_description_value" id="criteria_description_value" hidden>
                        <div class="mb-3"><label class="form-label">Criteria Name</label>
                            <input class="form-control form-control" id="criterianame" name="criteria_name" type="text" placeholder="Criteria Name"></div>
                        <div class="mb-3"><label class="form-label">Criteria %<b style="font-size: 10px">(Do not include % sign)</b></label>
                            <input class="form-control form-control" name="criteria_percent" id="criteriapercent" type="text" placeholder="Criteria percent"></div>
                        <div class="mb-3"><label class="form-label">Criteria Description</label>
                            <input class="form-control form-control" name="criteria_description" id="criteriadescription" type="text" placeholder="Criteria description"></div>
                    
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="update_criteria">Save</button></div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit judge-->
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit judge</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input class="form-control" type="text" name="judge_name_value" id="judge_name_value" placeholder="Judge name" hidden="">
                        <input class="form-control" type="text" name="judge_password_value" id="judge_password_value" placeholder="Judge Code" hidden="">
                        <div>
                            <label class="form-label">Judge Name</label>
                            <input class="form-control" type="text" name="judge_name" id="judge_name" placeholder="Judge name"></div>
                        <div><label class="form-label">Judge Code</label>
                            <input class="form-control" type="text" name="judge_password" id="judge_password" placeholder="Judge Code"></div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" name="update_judge" type="submit">Save</button></div>
                    </form>
            </div>
        </div>
    </div>

    <!--edit contestant-->
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Contestant</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">

    <label for="profileimage" style="padding-bottom: 10px;">Candidate Picture</label>
        <img src="employee_picture/user.png" 
        class="rounded mx-auto d-block" id="profiledisplay"
         onclick="triggerclick()" 
         style="display: block;
          width: 100px;
           height: 100px;
            margin-left: 85px;
             border-radius: 50px;
             " value="">

        <input type="file" name="profileimage" onchange="displayimage(this)" id="profileimage" style="display:none ;" >
    

                        <input type="text" name="contestant_no_value" id="contestant_no_value" hidden="">
                        <input type="text" name="contestant_name_value" id="contestant_name_value" hidden="">
                        <div><label class="form-label">Contestant NO</label>
                            <input class="form-control form-control" id="contestant_no" type="text" name="contestant_no" placeholder="Contestant No"></div>
                        <div><label class="form-label">Contestant Name</label>
                            <input class="form-control form-control" type="text" id="contestant_name" name="contestant_name" placeholder="Contestant Name"></div>
                        <div><label class="form-label">Contestant Age</label>
                            <input class="form-control form-control" type="text" id="contestant_age" name="contestant_age" placeholder="Contestant age"></div>      

                            <div><label class="form-label">Contestant Description</label>
                            <input class="form-control form-control" id="contestant_description" type="text" name="contestant_description" placeholder="Contestant Description"></div>
                        <div><label class="form-label">Contestant Motto</label>
                            <input class="form-control form-control" type="text" id="contestant_motto" name="contestant_motto" placeholder="Contestant Motto"></div>
                        <div><label class="form-label">Contestant Address</label>
                            <input class="form-control form-control" type="text" id="contestant_address" name="contestant_address" placeholder="Contestant Address"></div>
                    
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit" name="update_contestant">Save</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-4">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Candidate</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">

    <label for="profileimage" style="padding-bottom: 10px;">Candidate Picture</label>
        <img src="../contestant/assets/picture/black.jpg" 
        class="rounded mx-auto d-block" id="display"
         onclick="trigger()" 
         style="display: block;
          width: 100px;
           height: 100px;
            margin-left: 85px;
             border-radius: 50px;
             " value="">

        <input type="file" name="profileimage" onchange="displayimage(this)" id="profile" style="display:none ;" >
                        <input type="text" name="event_id" value="<?=$_GET['id']?>" hidden>
                        <div><label class="form-label">Contestant NO</label>
                            <input class="form-control form-control" type="text" id="conno" name="contestant_no" placeholder="Contestant No"></div>
                        <div>
                            <label class="form-label">Contestant Name</label>
                            <input class="form-control form-control" type="text" name="contestant_name" placeholder="Contestant Name">
                        </div>
                        <div>
                            <label class="form-label">Contestant Age</label>
                            <input class="form-control form-control" type="text" name="contestant_age" placeholder="Contestant Age">
                        </div>
                        
                        <div>
                            <label class="form-label">Contestant Description</label>
                            <input class="form-control form-control" type="text" name="contestant_description" placeholder="Contestant Description"></div>
                        <div>
                            <label class="form-label">Contestant Motto</label>
                            <input class="form-control form-control" type="text" name="contestant_motto" placeholder="Contestant Motoo">
                        </div><div>
                            <label class="form-label">Contestant Address</label>
                            <input class="form-control form-control" type="text" name="contestant_address" placeholder="Contestant Address">
                        </div>
                        
                        
                    
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" name="add_new_contestant" type="submit">Save</button></div>
            </div>
                    </form>
                </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-5">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Criteria</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="text" name="event_id" value="<?=$_GET['id']?>" hidden>
                        <div class="mb-3"><label class="form-label">Criteria Name</label><input class="form-control form-control" type="text" name="criteria_name" placeholder="Criteria Name"></div>
                        <div class="mb-3"><label class="form-label">Criteria %</label><input class="form-control form-control" type="text" name="criteria_percent" placeholder="Criteria percent"></div>
                        <div class="mb-3"><label class="form-label">Criteria Description</label><input class="form-control form-control" type="text" name="criteria_description" placeholder="Criteria description"></div>
                    
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit" name="add_new_criteria">Save</button></div>
            </div>
                    </form>
                </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-6">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add judge</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="text" name="event_id" value="<?=$_GET['id']?>" hidden>
                        <div><label class="form-label">Judge Name</label>
                            <input class="form-control" type="text" name="judge_name" placeholder="Judge name"></div>
                        <div><label class="form-label">Judge Code</label>
                            <input class="form-control" type="text" name="judge_password" id="pass" placeholder="Judge Code"></div>

                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" name="add_new_judge" type="submit">Save</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container" >



        <?php
        $con = mysqli_connect('localhost','root','','pms');
        $id = $_GET['id'];
        $event = "";
        $stmt = mysqli_query($con,"SELECT event_name FROM event WHERE event_id = $id");
        if (mysqli_num_rows($stmt)>0) {
            $res = mysqli_fetch_assoc($stmt);
            $event = $res['event_name'];
        }
        //rgb(239,187,0)
        ?>

        <h1 class="text-center mt-4" style="color:black;font-weight: bolder;"><?=strtoupper($event)?></h1>
        <button style="margin-left: 95%;" onclick="printContent()"><i class="fa fa-print"></i></button>
        <br>
                <button class="btn btn-primary" type="button" data-bs-target="#modal-5" data-bs-toggle="modal" style="margin-bottom: 2px;">Criteria</button>
                <button class="btn btn-primary" type="button" data-bs-target="#modal-6" id="new-input" data-bs-toggle="modal">Judge</button>
                <button class="btn btn-primary" type="button"  data-bs-target="#modal-4" data-bs-toggle="modal">Contestant</button>
             
        <div>
            <div class="table-responsive ">
                         <?php

                    include('judge_table.php');
                ?>
       
            </div>
        </div>

        <div class="table-responsive">
            
            <?php
                 include('criteria_table.php');
            ?>   
        </div>
        <div class="table-responsive">
       
                <?php
                    include('contestant_table.php');
                ?>
           
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    document.getElementById("pass").value = Math.floor(Math.random()*(100000-200000+4)+200000); let a = 2;
       
    $("#new-input").click(function (){
        let uid = Math.floor(Math.random() * (100000 - 200000 + 4)) + 200000;
    });
function printContent() {
  // Get the ID from the URL
  var urlParams = new URLSearchParams(window.location.search);
  var id = urlParams.get('id');

  // Construct the URL for print_file.php with the ID parameter
  var printUrl = 'print_content.php?id=' + encodeURIComponent(id);

  // Open the new window and print the page
  var printWindow = window.open(printUrl, '_blank');
  printWindow.onload = function() {
    printWindow.print();
  };
}
</script>
<script type="text/javascript">
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
    document.querySelector('#profile').click();
}
    function displayimage(e)
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
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

</html>
