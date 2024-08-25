<?php
//SELECT c.contestant_name,(SUM(DISTINCT s.score)/COUNT(DISTINCT s.judge_id))/COUNT(s.event_id) as total_score FROM contestant c 
//INNER JOIN score s ON c.event_id = s.event_id
//INNER JOIN event e ON s.event_id = e.event_id
//INNER JOIN main_event m ON e.main_event_id = m.main_event_id
//WHERE m.main_event_id = 60120 GROUP BY c.id,s.contestant_id;


$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
// Database credentials
$host = 'localhost';
$dbname = 'pms';
$username = 'root';
$password = '';

// Establish a connection to the database using PDO
try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  
  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


$stmts = $conn->prepare('SELECT * FROM website  WHERE main_event_id = :id limit 1');
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
   <link  rel = "icon" href ="../../background/logo.png" type = "image x-icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
     <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
     <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>

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
                        <a class="nav-link" href="../gallery/gallery.php?id=<?=$id?>" style="color: white;font-size: 15px;"> Gallery</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="result/result.php" style="color: white;font-size: 15px;"> Result</a></li>

                </ul>
            </div>
        </div>
    </nav>
  <?php

$id = $_GET['id'];
$getallscore = array();
$empty = '';
$stmt = $conn->prepare('SELECT e.event_id,c.contestant_name,c.contestant_picture,SUM(s.score) AS score FROM event e 
  INNER JOIN contestant c ON e.event_id = c.event_id
  INNER JOIN score s ON c.id = s.contestant_id
  WHERE e.main_event_id = :id and e.top = 5
  GROUP BY c.id,e.main_event_id ORDER BY score DESC LIMIT 5;');
  $stmt->bindParam(':id',$id);
  $stmt->execute();
  $count = $stmt->rowCount();
  if ($count>0) {
    # code...
  $get =  $stmt->fetchAll(PDO::FETCH_ASSOC);
  $getallscore = $get;
  }
  else
  {
    echo "<h1>no data<h2>";
    $empty = 'No GrandWinner event is set';
  }

$getrunner = array();
  $stmt = $conn->prepare('SELECT e.event_id, cr.criteria_name, c.contestant_name, c.contestant_picture, MAX(total_score) AS total_score
FROM event e 
INNER JOIN contestant c ON e.event_id = c.event_id
INNER JOIN (
  SELECT s.contestant_id, cr.criteria_name, SUM(s.score) AS total_score
  FROM score s
  INNER JOIN criteria cr ON s.criteria_id = cr.id
  GROUP BY s.contestant_id, cr.criteria_name
) ct ON c.id = ct.contestant_id
INNER JOIN (
  SELECT criteria_name, MAX(total_score) AS max_score
  FROM (
    SELECT cr.criteria_name, s.contestant_id, SUM(s.score) AS total_score
    FROM score s
    INNER JOIN criteria cr ON s.criteria_id = cr.id
    GROUP BY cr.criteria_name, s.contestant_id
  ) t
  GROUP BY criteria_name
) max_scores ON ct.criteria_name = max_scores.criteria_name AND ct.total_score = max_scores.max_score
INNER JOIN criteria cr ON ct.criteria_name = cr.criteria_name
WHERE e.main_event_id = :id 
GROUP BY e.event_id, ct.criteria_name
ORDER BY e.event_id, total_score DESC;;
');
  $stmt->bindParam(':id',$id);
  $stmt->execute();
  $count = $stmt->rowCount();
  if ($count>0) {
    # code...
  $runner =  $stmt->fetchAll(PDO::FETCH_ASSOC);
  $getrunner = $runner;
  }
  else
  {
    echo "no data";
  }

?>
<h1 class="text-center" style=""> GRAND WINNER</h1>
<div class="mx-5">
  <div class="container">
    <div class="row align-items-start">
      <h3><?php echo $empty ?></h3>
      <?php
        $rank = 1;
        foreach($getallscore as $get):
          $rank_text = '';
          $rank_icon = '';

          if ($rank == 1) {
            $rank_text = 'WINNER';
            $rank_icon = '<i class="fa-solid fa-crown" style="font-size:50px; color:gold;"></i>';
          } elseif ($rank == 2) {
            $rank_icon = '<i class="fa-solid fa-crown" style="font-size:35px; color:gold;"></i>';
            $rank_text = '1st Place';
          } elseif ($rank == 3) {
            $rank_icon = '<i class="fa-solid fa-crown" style="font-size:30px; color:gold;"></i>';
            $rank_text = '2nd Place';
          } elseif ($rank == 4) {
            $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:gold;"></i>';
            $rank_text = '3rd Place';
          } elseif ($rank == 5) {
            $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:gold;"></i>';
            $rank_text = '4th Place';
          }
      ?>
      <?php if ($rank == 1): ?>
        <div class="col-12 mb-4">
          <div class="text-center">
            <h6><?=$rank_icon?></h6>
            <img src="../../contestant/assets/picture/<?=$get['contestant_picture']?>" class="img-fluid rounded-circle" style="width: 280px;height: 350px;" >
          </div>
          <div class="text-center mt-3">
            <h5><?=$rank_text?></h5>
            <p><?=$get['contestant_name']?></p>
          </div>
        </div>
      <?php else: ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="text-center">
            <h6><?=$rank_icon?></h6>
            <img src="../../contestant/assets/picture/<?=$get['contestant_picture']?>" class="img-fluid rounded-circle" style="width: 280px;height: 350px;" >
          </div>
          <div class="text-center mt-3">
            <h5><?=$rank_text?></h5>
            <p><?=$get['contestant_name']?></p>
          </div>
        </div>
      <?php endif; ?>
      <?php $rank++; endforeach; ?>
    </div>
  </div>
</div>



  <h1 class="text-center" style="">Candidate who are best </h1>
<div class="mx-5">
<div class="container">
  <div class="row align-items-start">
    <?php
    $rank = 1;
      foreach($getrunner as $runner):
  
      $rank_text = '';
      $rank_icon = '';

      if ($rank == 1) {
        $rank_text = '1st Runner Up';
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
      } elseif ($rank == 2) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '2nd Runner up';
      } elseif ($rank == 3) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '3rd runner up';
      } elseif ($rank == 4) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '4th Place';
      
      } elseif ($rank == 5) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '5th Place';
      
      } elseif ($rank == 6) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '6th Place';
  
      } elseif ($rank == 7) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '7th Place';
      
      } elseif ($rank == 8) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '8th Place';
      
      } elseif ($rank == 9) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '9th Place';
      
      } elseif ($rank == 10) {
        $rank_icon = '<i class="fa-solid fa-crown" style="font-size:25px; color:silver;"></i>';
        $rank_text = '10th Place';
      }
      ?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="text-center">
          <h6><?=$rank_icon?></h6>
          <h5 class="mb-4">Best in <?=$runner['criteria_name']?></h5>
          <img src="../../contestant/assets/picture/<?=$runner['contestant_picture']?>" class="img-fluid rounded-circle" style="width: 200px;height: 250px;">
        </div>
        <div class="text-center mt-3">
          <p><?=$runner['contestant_name']?></p>
        </div>
      </div>
      <?php $rank++; endforeach ?>
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