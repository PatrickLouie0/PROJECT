<?php

$gid = $_GET['id'];
if ($gid == '') {
    header('location:Error');
}
// database credentials
$host = "localhost";
$dbname = "pms";
$username = "root";
$password = "";

// create a PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

//get event id
$event_id = '';
$name = '';
$stmt = $pdo->prepare("SELECT event_id,event_name FROM event WHERE main_event_id = :id");
$stmt->BindParam(":id",$gid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$counts = $stmt->rowCount();


$id_event = $row['event_id'];

$name = $row['event_name'];

$get_con_picture = $pdo->prepare("SELECT * FROM contestant WHERE event_id = :event_id ");
$get_con_picture->bindParam(":event_id",$id_event);
$get_con_picture->execute();
$num_rows = $get_con_picture ->rowCount();
if ($num_rows>0) {
    $rows =  $get_con_picture->fetchAll(PDO::FETCH_ASSOC);

}
else
{
    echo "failed";
}

$stmts = $pdo->prepare('SELECT * FROM main_event  WHERE main_event_id = :id limit 1');
$stmts->bindParam(":id",$id);
$stmts->execute();
$num_row = $stmts ->rowCount();
if ($num_row>0) {
    $get_event =  $stmts->fetchAll(PDO::FETCH_ASSOC);
}


$stmts = $pdo->prepare('SELECT * FROM website  WHERE main_event_id = :id limit 1');
$stmts->bindParam(":id",$id);
$stmts->execute();
$num_row = $stmts ->rowCount();
if ($num_row>0) {
    $link =  $stmts->fetchAll(PDO::FETCH_ASSOC);
}


$stmtss = $pdo->prepare('SELECT * FROM website  WHERE main_event_id = :id limit 1');
$stmtss->bindParam(":id",$id);
$stmtss->execute();
$num_row = $stmtss ->rowCount();
if ($num_row>0) {
    $picture =  $stmtss->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alex+Brush&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>


<style>
  .fade-in-scroll {
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
  }

  .fade-in-scroll.fade-in {
    opacity: 1;
  }
  .h1-responsive {
  font-size: 3rem; /* Default font size */
}

@media (max-width: 576px) {
  /* Screen width less than 576px */
  .h1-responsive {
    font-size: 13px; /* Font size for small screens */
  }
}
.container-1
{
    height: 500px;
}
@media (max-width: 576px)
{
    .container-1
    {
        height: 200px;
    }
}
</style>

<script>
  window.addEventListener('scroll', function() {
    const element = document.querySelector('.fade-in-scroll');
    const position = element.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;

    if (position < windowHeight) {
      element.classList.add('fade-in');
    }
  });
</script>
</head>

<body style="margin-left: 2PX;font-size: 5px;background: rgb(40,45,50);">
    <nav class="navbar navbar-light navbar-expand-md text-center" style="color: rgb(248,248,248);background: #000000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="color: rgba(255,255,255,0.9);background: url(../background/logo.png) center / cover no-repeat;width: 88px;height: 50px;"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span>   <i class="fa-solid fa-bars" style="color: white"></i>
 </button>
            <div class="collapse navbar-collapse ml-auto " id="navcol-1">
                <ul class="navbar-nav " >
                    <li class="nav-item"><a class="nav-link active" href="home.php?id=<?=$id?>" style="color: white;font-size: 15px;">Home </a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery/gallery.php?id=<?=$id?>" style="color: white;font-size: 15px;"> Gallery</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="result/result.php?id=<?=$id?>" style="color: white;font-size: 15px;"> Result</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <?php foreach($picture as $linked){ ?>
    <div style="background: url(../main_event/assets/picture/<?=$linked['picture']?>) center / cover no-repeat;width: 100%;max-height: 1000px;height: 500px;margin-bottom: 30px;">
        <div class="text-center">
            <h1 class="" style="color: rgb(255,255,255);font-weight: bold;font-size: 56.9px; text-shadow: 4px 4px 2px black">Welcome To</h1>
            <?php foreach($get_event as $get): ?>
            <h1 class="" style="color: rgb(255,255,255);; font-weight: bold; text-shadow: 4px 4px 2px black"><?= ucfirst($get['main_event_name'])?></h1>
            <h3 class="h3-responsive" style="color: rgb(255,255,255); font-weight: bold; text-shadow: 4px 4px 2px black"><?= $get['main_event_description']?></h3>
        <?php endforeach?>
        </div>
    </div>  
<?php } ?>

<div class="container" style="background: url() center / cover no-repeat;width: 100%;transform: scale(1);filter: invert(1%) saturate(100%);margin-bottom: 30px;">
        <div class="text-center" >
            <?php foreach($get_event as $get): ?>
            <h1 class="fade-in-scroll h1-responsive" data-mdb-toggle="animation" data-mdb-animation="fade-in" data-wow-duration="2s" data-wow-delay="0.5s" style="color: rgb(255,255,255); font-weight: bold; text-shadow: 4px 4px 2px black;margin-top: 20%;">
                Get ready to witness the most spectacular <?=$name?> event of the year! Join us on <?= date("F j, Y", strtotime($get['event_date_start']))?> and experience the glamour and glitz like never before. Are you prepared to be mesmerized by the beauty, grace, and elegance of our Candidates? Don't miss this unforgettable extravaganza that will leave you breathless!
            </h1>
        <?php endforeach?>
        </div>
    </div>  





    <div class="container">
        <div class="container">
            <div class="row row-pic">
                <div class="col-md-12 col-pic">
                    <h1 style="text-align: center;color: rgb(255,255,255);font-weight:bolder;">Candidates</h1>
                </div>
            </div>
            <div class="row">
                <?php foreach($rows as $getpic): ?>
                <div class="col-md-3">
                <a href="candidate_picture/candidate_picture.php?id=<?=$getpic['id']?>&event_id=<?=$row['event_id']?>">
                    <img class="img-fluid" src="../contestant/assets/picture/<?=$getpic['contestant_picture'] ?>">
                </a>

                </div>  
            <?php endforeach; ?>

                    <a href="gallery/gallery.php?id=<?=$id?>" style = "color: white;font-size: 30px">
                    View All
                    </a>
             </div>
</div>
    </div>
            <footer class="footer-dark" style="margin-top: 50px;background: black;border-top-style: solid; border-color: black;width: 100%">
                <div class="container">
                    <div class="row">
                        <div class="col item social">
                            <?php foreach($link as $links){?>
                            
                            <a href="<?=$links['facebooklink']?>">
                            <i class="icon ion-social-facebook"></i>
                            </a>
                            <a href="<?=$links['twitterlink']?>">
                                <i class="icon ion-social-twitter"></i>
                            </a>
                            <a href="<?=$links['instagramlink']?>">
                                <i class="icon ion-social-instagram"></i>
                            </a>

                        <?php } ?>
                        </div>
                    </div>
                    <p class="copyright text-light" >2023 - SmarkLab Tech - All Right Reserved</p>
                </div>
            </footer>
        
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  // On scroll, check if element is visible
  $(window).scroll(function() {
    $('.animated').each(function() {
      var elementTop = $(this).offset().top;
      var elementBottom = elementTop + $(this).outerHeight();
      var viewportTop = $(window).scrollTop();
      var viewportBottom = viewportTop + $(window).height();
      if (elementBottom > viewportTop && elementTop < viewportBottom) {
        $(this).addClass('fadeIn');
      }
    });
  });
});

    </script>
</body>

</html>