<?php
    include("../header.php");
    require_once('../folder/pms.php');
    $con->judge();
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
    <title>Judge</title>
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background: url(../background/bg.jpg) center / cover no-repeat;">
    <div class="container py-2 px-4 my-4 col-12 col-sm-6 col-md-12 col-lg-6" style="
        background: radial-gradient(circle, gray 0%, white 100%);
        height: 550px;
        overflow-y: scroll;
        overflow-x: hidden;
        opacity: 90%;
        height: 450px;
        overflow-y: scroll;
        overflow-x: hidden;">
        <h4 class="text-center text-dark"><strong>Judge-1</strong></h4>
        <form style="color: black;" method="POST">
            <div class="mb-2">
                <input type="text" name="event_id[]" value="<?php echo $_SESSION['event_id'] ?>" hidden>
                <div class="mb-3"><label class="form-label">Judge</label><input class="form-control" type="text" name="judge_name[]" placeholder="Judge Name" autofocus="" required=""></div>
                <div class="mb-3"><label class="form-label">password(<span style="text-decoration: underline;">send this to the judge</span>)</label><input class="form-control" type="text" placeholder="Judge password" name="judge_password[]" id="pass" value="" autofocus="" required=""></div>
            </div>
            <div id="newrow"></div>
            <div><button class="btn btn-primary" id="new-input" type="button"><strong>Add Judge</strong></button>
<button class="btn btn-primary" id="delete-input" type="button"><strong>Delete Judge</strong></button>
            </div>
            <div class="text-end"><button class="btn btn-primary" type="submit" name="submit"><strong>Submit</strong></button></div>
        </form>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
       <script type="text/javascript">
        
    document.getElementById("pass").value = Math.floor(Math.random()*(100000-200000+4)+200000); let a = 2;
       
    $("#new-input").click(function (){
        let uid = Math.floor(Math.random() * (100000 - 200000 + 4)) + 200000;
        newrowadd = 
        '<div class="mb-2 row">'+
        '<h4 class="text-center text-dark"><strong>Judge-'+ a++ +'</strong></h4>'+
        '<input type="text" name="event_id[]" value="<?php echo $_SESSION["event_id"] ?>" hidden>'+
                '<div class="mb-3"><label class="form-label text-dark">Judge Name</label><input class="form-control" type="text" placeholder="Judge Name" name= "judge_name[]" autofocus="" required=""></div>'+
                '<div class="mb-3"><label class="form-label text-dark">Judge Password</label><input class="form-control" type="text" placeholder="" value="'+uid+'" name="judge_password[]" id="percent" autofocus="" required=""></div>'+
            '</div>'
            
            $('#newrow').append(newrowadd);
    });
   $("body").on("click", "#delete-input", function() {
        $(".row").last().remove();
        a--;
  
});
</script>

</body>

</html>