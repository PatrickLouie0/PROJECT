<?php
    require_once('../folder/pms.php');
    $con->criteria();
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
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background: url(../background/bg.jpg) center / cover no-repeat;">
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

    <div class="container py-2 px-4 my-4 col-12 col-sm-6 col-md-12 col-lg-6" style="
        background: radial-gradient(circle, gray 0%, white 100%);
        height: 550px;
        overflow-y: scroll;
        overflow-x: hidden;
        opacity: 90%;
        height: 450px;
        overflow-y: scroll;
        overflow-x: hidden;"
    >

        <form id="form" method="POST" >
            <div class="mb-2" id="">
                <h4 class="text-center text-dark"><strong>Criteria-1</strong></h4>
                <div class="mb-3"><label class="form-label text-dark">Criteria Name</label><input class="form-control" type="text" name="criteria_name[]" placeholder="Criteria Name" autofocus="" required=""></div>
                <div class="mb-3"><label class="form-label text-dark" id="percent">Criteria %</label><input class="form-control" type="text" placeholder="Criteria %" name="criteria_percent[]" autofocus="" required=""></div>
                <div class="mb-3"><label class="form-label text-dark">Criteria Description</label><input class="form-control" type="text" placeholder="Criteria Description" name="criteria_description[]" autofocus="" ></div>
                
                <input type="text" name="event_id[]" value="<?php echo $_SESSION['event_id']; ?>" hidden>
                
            </div>

            <div class="mb-2" id="newrow">
            </div>
            <div><button class="btn btn-primary" id="new-input" type="button"><strong>Add Criteria</strong></button>

            <button class="btn btn-primary" id="delete-input" type="button"><strong>Delete Criteria</strong></button>
            </div>
            <div class="text-end"><button class="btn btn-primary me-5" type="submit" name="submit"><strong>Submit</strong></button></div>
        </form>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  
</body>

<script type="text/javascript">

let totalPercent = 0;

$("#form").submit(function (e) 
{
 
    let percentInputs = $('input[name="criteria_percent[]"]');
    totalPercent = 0;

    percentInputs.each(function () {
        totalPercent += parseFloat($(this).val());
    });

        if (totalPercent > 100) 
        {
               e.preventDefault();
            alert("The total criteria must not exceed 100%");
        } 
        else if(totalPercent<100) 
        {
        // Submit form data

               e.preventDefault();
            alert("the total criteria must be 100%");
        }
        else
        {

        }
});


     let a = 2;
       
    $("#new-input").click(function (){
        
        newrowadd = 
        '<div class="mb-2 row">'+
        '<h4 class="text-center text-dark"><strong>Criteria-'+ a++ +'</strong></h4>'+

                '<div class="mb-3"><label class="form-label text-dark">Criteria Name</label><input class="form-control" type="text" name="criteria_name[]" placeholder="Criteria Name" autofocus="" required=""></div>'+
                '<input type="text" name="event_id[]" value="<?php echo $_SESSION["event_id"] ?>" hidden>'+
        
                '<div class="mb-3"><label class="form-label text-dark">Criteria %</label><input class="form-control" type="text" name="criteria_percent[]" placeholder="Criteria %" id="percent" autofocus="" required=""></div>'+
                '<div class="mb-3"><label class="form-label text-dark">Criteria Description</label><input class="form-control" type="text" name="criteria_description[]" placeholder="Criteria Description" autofocus=""></div>'+
            '</div>'
            
            $('#newrow').append(newrowadd);
    });
   $("body").on("click", "#delete-input", function() {
        $(".row").last().remove();
        a--;
  
});
</script>
<script type="text/javascript">
    
</script>
</html>