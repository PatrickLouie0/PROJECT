<?php
    require_once('../folder/pms.php');
    $con->contestant();
    $eid=$_SESSION['username'];
if($eid=="")
{
header('location:../login/login.php');
}
    include("../folder/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
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

     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background: url(../background/bg.jpg) center / cover no-repeat;">
    <div class="container py-2 px-4 my-4 " style="
        background: radial-gradient(circle, gray 0%, white 100%);
        height: 550px;
        overflow-y: scroll;
        overflow-x: hidden;
        opacity: 90%;
        height: 450px;
        overflow-y: scroll;
        overflow-x: hidden;"

>
        <form method="POST" enctype="multipart/form-data">
            <div>
                <div class="mb-2 mx-4">
                    <h2 class="text-center" style="color: black;"><strong>Candidate No 1</strong></h2>
                    <input type="text" name="event_id[]" value="<?=$_SESSION['event_id'] ?>" hidden>
                    <div class=" col-md-3 mb-2">
                        <label style="color: black;">Candidate Picture</label>
                      <img src="assets/picture/black.jpg" class="d-block contestant-image" onclick="trigger(event)" style="width: 150px; height: 150px; border-radius: 75%;" data-index="(a-2)">
                      <input type="file" name="image[]" onchange="display(event)" class="candidates-picture" style="display: none;"  data-index="(a-2)">

                
                    </div>
                    <div class="mb-3">
                     <input class="form-control col-md-1" type="text" placeholder="Contestant no" name="contestant_no[]" autofocus="" value="1" required="" hidden="">
                    </div>
            
                        <label class="form-label" style="">Candidate Name</label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label" style="">Last Name</label>
                        <input class="form-control" type="text" placeholder="Last Name"  name="lastname[]" autofocus="" required="">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label class="form-label" style="">Fist Name</label>
                        <input class="form-control" type="text" placeholder="First Name" name="firstname[]" autofocus="" required="">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label class="form-label" style="">Middle Name  </label>
                        <input class="form-control" type="text" placeholder="Middle Name" name="middlename[]" autofocus="" >
                    </div>

                    <div class="form-group col-md-1">
                        <label class="form-label" style=""> Age  </label>
                        <input class="form-control" type="number" placeholder="Age" name="contestant_age[]" autofocus="" required="">
                    </div>
                </div>
                    
                    <div>
                        <label class="form-label" style="">Candidate Address  </label>
                        <input class="form-control" type="text" placeholder="Candidate Address" name="contestant_address[]" autofocus="" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="">Candidate Motto</label>
                        <input class="form-control" type="text" placeholder="Candidate Motto" name="motto[]" autofocus="" >
                    </div>
                 

                    <div class="mb-3"><label class="form-label" style="">Candidate Description</label><input class="form-control" type="text" name="contestant_description[]" placeholder="Candidate Description" \ autofocus="" ></div>
                </div>
                <div id="newrow"></div>
                <div><button class="btn btn-primary" id="new-input" type="button"><strong>Add Candidate</strong></button>
                <button class="btn btn-primary" id="delete-input" type="button"><strong>Delete Candidate</strong></button></div>
                <div class="text-end"><button class="btn btn-primary me-5 mt-2" type="submit" name="submit"><strong>Submit</strong></button></div>
            </div>
        </form>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
 let contestant_no = 2;
let a = 2;

$("#new-input").click(function (){

  newrowadd = `
    <div class="mb-2 mx-4 row">
      <h4 class="text-center" style="color: black;"><strong>Candidate No ${a++}</strong></h4>
      <input type="text" name="event_id[]" value="<?= $_SESSION['event_id'] ?>" hidden>
      <div class=" col-md-3 mb-2">
        <label for="profileimage" style="padding-bottom: 10px;color: black"> Candidate Picture</label>
        <img src="assets/picture/black.jpg" class="d-block contestant-image" onclick="trigger(event)" style="width: 150px;height: 150px;border-radius: 75%;" data-index="${a-2}">
        <input type="file" name="image[]" onchange="display(event)" class="candidates-picture" style="display: none;" 
        data-index="${a-2}">
      </div>
      <div class="mb-3"><input class="form-control" type="text" placeholder="Candidate no" name="contestant_no[]" id="percent" value="${contestant_no++}" autofocus="" required="" hidden></div>
                    <label class="form-label" style="">Candidate Name</label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label" style="">Last Name</label>
                        <input class="form-control" type="text" placeholder="Last Name" name="lastname[]" autofocus="" required="">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label class="form-label" style="">Fist Name</label>
                        <input class="form-control" type="text" placeholder="First age" name="firstname[]" autofocus="" required="">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label class="form-label" style="">Middle Name  </label>
                        <input class="form-control" type="text" placeholder="Middle Name" name="middlename[]" autofocus="" >
                    </div>

                 <div class="form-group col-md-1">
                        <label class="form-label" style="">Age  </label>
                        <input class="form-control" type="number" placeholder="Age" name="contestant_age[]" autofocus="" required="">
                    </div>
   </div>
               
                    <div>
                        <label class="form-label" style="">Candidate Address  </label>
                        <input class="form-control" type="text" placeholder="Candidate Address" name="contestant_address[]" autofocus="" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="">Candidate Motto</label>
                        <input class="form-control" type="text" placeholder="Candidate Motto" name="motto[]" autofocus="" >
                    </div>
            
      <div class="mb-3"><label class="form-label ">Candidate Description</label><input class="form-control" type="text" placeholder="Candidate Description" name="contestant_description[]" autofocus="" ></div>
    </div>
  `;

  $('#newrow').append(newrowadd);
});

$("body").on("click", "#delete-input", function() {
  $(".row").last().remove();
  a--;
  contestant_no--;
});

function trigger(e) {
  let index = $(e.target).data("index");
  $(`.candidates-picture[data-index="${index}"]`).click();
}

function display(e) {
  let index = $(e.target).data("index");
  if (e.target.files && e.target.files[0]) {
      var reader = new FileReader();
      reader.onload = function (event) {
          $(`.contestant-image[data-index="${index}"]`).attr('src', event.target.result);
      };
      reader.readAsDataURL(e.target.files[0]);
  }
}

</script>
<script type="text/javascript">
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
           

</body>

</html>