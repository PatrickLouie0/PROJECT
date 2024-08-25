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

$rows = ''; 
$event_id = filter_var($_GET['event_id'],FILTER_SANITIZE_NUMBER_INT);
$eid = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
$get_con_picture = 'SELECT  c.id, c.event_id, c.contestant_picture, c.contestant_name, c.age, c.motto, c.contestant_no, c.contestant_description, c.address
FROM contestant c
INNER JOIN event m ON m.event_id = :ids and c.event_id = :id and c.id !=:eid';
$stmt = $pdo->prepare($get_con_picture);
$stmt->bindParam(':ids',$event_id,PDO::PARAM_INT);
$stmt->bindParam(':id',$event_id,PDO::PARAM_INT);
$stmt->bindParam(':eid',$eid,PDO::PARAM_INT);
$stmt->execute();
$num_rows = $stmt ->rowCount();
if ($num_rows>0) {
    $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else
{
    echo "failed";
}

$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
$get_con_picture = 'SELECT * FROM contestant WHERE id = :id';
$stmt = $pdo->prepare($get_con_picture);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();
$num_rows = $stmt ->rowCount();
if ($num_rows>0) {
    $get =  $stmt->fetch(PDO::FETCH_ASSOC);
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PCMS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Image-Tab-Gallery-Horizontal.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style type="text/css">
        *
        {
            color: white;
        }
        <script>
function myFunction(img) {
  // Get the expanded image element
  var expandedImg = document.getElementById("expandedImg");
  // Use the same src as the clicked thumbnail image
  expandedImg.src = img.src;
  // Show the image text
  var imgText = document.getElementById("imgtext");
  imgText.innerHTML = img.alt;
}

</script>

    </style>
</head>

<body style="background: rgb(40,45,50);">
      <nav class="navbar navbar-light navbar-expand-md text-center" style="color: rgb(248,248,248);background: #000000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="color: rgba(255,255,255,0.9);background: url('../../background/logo.png') center / cover no-repeat;width: 88px;height: 50px;"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span>   <i class="fa-solid fa-bars" style="color: white"></i>
 </button>
            <div class="collapse navbar-collapse ml-auto " id="navcol-1">
                <ul class="navbar-nav " >
                    <li class="nav-item"><a class="nav-link active" href="../home.php?id=<?=$_GET['ids']?>" style="color: white;font-size: 15px;">Home </a></li>
                    <li class="nav-item">
                    
              <a class="nav-link" href="../gallery/gallery.php?id=<?=$_GET['ids']?>" style="color: white;font-size: 15px;"> Gallery</a>
          
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../result/result.php?id=<?=$_GET['ids']?>" style="color: white;font-size: 15px;"> Result</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid top-container">
        <div class="row">
            <div class="col-12 col-md-6 col-xl-4 offset-xl-2">

                <div class="img-container"><img class="rounded" id="expandedImg" style="width:100%" src="../../contestant/assets/picture/<?=$get['contestant_picture']?>">
                    <div id="imgtext"></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4 offset-xl-0">
                <h1><?=$get['contestant_name']?><small style="font-size: 20px;">(Age:<?=$get['age']?>)</small></h1>
                <p style="font-size: 20px;">
                    <?=$get['contestant_description']?>
                </p>
                <p style="font-size: 20px;"><b> Motto:</b>
                    <?= $get['motto']?>
                </p>
            </div>
        </div>
             <div class="row img-row" style="width: 90%; overflow-x: scroll; margin: 0 auto;">
    <?php foreach($rows as $row):?>
    <div class="col-3 column" style="padding: 5px;">
        <a href="candidate_picture.php?id=<?=$row['id']?>&event_id=<?=$_GET['event_id']?>">
        <img class="img-thumbnail img-fluid" src="../../contestant/assets/picture/<?=$row['contestant_picture']?>" onclick="myFunction(this);" alt="image 1" style="width: 100%; height: 200px;">
        </a>
    </div>
    <?php endforeach;?>
</div>

          
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Image-Tab-Gallery-Horizontal.js"></script>
</body>

</html>