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

$get_con_picture = $pdo->prepare("SELECT e.main_event_id, c.event_id, e.event_name, c.id, c.contestant_picture, c.contestant_name, c.age, c.motto, c.contestant_no, c.contestant_description, c.address
FROM contestant c
INNER JOIN event e ON c.event_id = e.event_id
INNER JOIN main_event m ON e.main_event_id = m.main_event_id
WHERE m.main_event_id = :id
GROUP BY c.event_id, c.id 


");
$get_con_picture->bindParam(":id",$id);
$get_con_picture->execute();
$num_rows = $get_con_picture ->rowCount();
if ($num_rows>0) {
    $rows =  $get_con_picture->fetchAll(PDO::FETCH_ASSOC);
}


$stmts = $pdo->prepare('SELECT * FROM website  WHERE main_event_id = :id limit 1');
$stmts->bindParam(":id",$id);
$stmts->execute();
$num_row = $stmts ->rowCount();
if ($num_row>0) {
    $link =  $stmts->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
     <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
   
     <link  rel = "icon" href ="../../background/logo.png" type = "image x-icon">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-4---Photo-Gallery.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
  .card-img-top {
    width: 300px;
    height: 300px;
    object-fit: cover; /* to maintain aspect ratio of the image */
  }
</style>
</head>

<body style="background: rgb(40,45,50);color: white;">
    <nav class="navbar navbar-light navbar-expand-md text-center" style="color: rgb(248,248,248);background: #000000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="color: rgba(255,255,255,0.9);background: url('../../background/logo.png') center / cover no-repeat;width: 88px;height: 50px;"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span>   <i class="fa-solid fa-bars" style="color: white"></i>
 </button>
            <div class="collapse navbar-collapse ml-auto " id="navcol-1">
                <ul class="navbar-nav " >
                    <li class="nav-item"><a class="nav-link active" href="../home.php?id=<?=$id?>" style="color: white;font-size: 15px;">Home </a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../gallery/gallery.php?id=<?=$id?>" style="color: white;font-size: 15px;"> Gallery</a></li>
                    <li class="nav-item">
                     <a class="nav-link" href="../result/result.php?id=<?=$id?>" style="color: white;font-size: 15px;"> Result</a></li>

                </ul>
            </div>
        </div>
    </nav>
<div class="photo-gallery">
<div class="container-fluid">
  <div class="px-lg-5">
    <h1>Candidates Picture</h1>
    <div class="row">
      <!-- Gallery item -->

  <?php
$current_event_id = null; // variable to track the current event_id
foreach($rows as $row) {
  if ($current_event_id !== $row['event_id']) { // if we have a new event_id, display the event name
    echo '<h2>' . $row['event_name'] . '</h2>';
    $current_event_id = $row['event_id'];
  }
?>
  <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
    <div class="bg-white rounded shadow-sm">
      <a href="../candidate_picture/candidate_picture.php?id=<?=$row['id']?>&event_id=<?=$row['event_id']?>&ids=<?=$id?>">
        <img src="../../contestant/assets/picture/<?=$row['contestant_picture']?>" alt="" class="img-fluid card-img-top">
      </a>
      <div class="p-4">
        <p class="small text-muted mb-0"><?=$row['contestant_name']?></p>
      </div>
    </div>
  </div>
<?php } ?>

      <!-- End -->

    </div>
  </div>
</div>
</div>
  <footer class="footer-dark" style="margin-top: 50px;background: black;border-top-style: solid; border-color: black;width: 100%;text-align: center;">
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
</body>

</html>