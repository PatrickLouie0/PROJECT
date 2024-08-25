<?php
include("header/assets/index.html");
require_once('pms_judge.php');
$di = $_SESSION['event_id'];
if ($di == '') {
  header('location:login/login.php')
}
$con->judge_score();

//connect to database
$conn = mysqli_connect("localhost", "root", "", "pms");

//get contestants
$contestants = array();
$sql = "SELECT id, contestant_name,contestant_no,contestant_description FROM contestant where event_id ='{$_SESSION['event_id']}' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $contestants[] = $row;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Judge's Scorecard</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body style="background: url('score/assets/picture/background-3.jpg') center / cover no-repeat; color: white">
  <div class="container">
    <h1>Scorecard</h1>
    <ul class="nav nav-tabs">
      <li class="nav-item" ><a class="nav-link active"  data-toggle="tab" href="#tab-1">Intruction</a></li>
      <?php //foreach ($contestants as $contestant): ?>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#4">Candidates<?php //$contestant['contestant_name']?></a></li>
      <?php //endforeach; ?>
      <li class="nav-item" ><a class="nav-link"  data-toggle="tab" href="#tab-2">Score</a></li>
   
    </ul>
    <div class="tab-content" >
      <div id="tab-1" class="tab-pane active">
      <h1>Hello,<?=$_SESSION['judge_name']?></h1>
      <h1><?=$_SESSION['event_id']?></h1>
   	  <h2>&emsp;&emsp;Before you give the score please read the guide below</h2>
   	  </div> 
        <div id="4" class="tab-pane" style="column-count: 1">

      <?php foreach ($contestants as $contestant): ?>

        <div class="candidate" style="columns: 2;margin-bottom: 50px;">
        <div class="con d-flex" style="columns: ">

          <div class="info">
          <h2>Contestant No <?=$contestant['contestant_no']?></h2>
          
          <h3>Name: <?=$contestant['contestant_name']?></h3>
          <h3>Description</h3>
          <h4><?=$contestant['contestant_description']?></h4> 
          </div >
          <div class = "pic text-end" style="text-align: right; ">
          <img src="../assets/picture/background-3.jpg" style="width: 160px;height: 140px;text-align: right;border-radius: 48px;">
          </div>
        </div>
        <div class="form-class">
          <form method="post">
            <table class="table table-bordered" style="color: white">
              <thead>
                <tr>
                  <th>Criteria</th>
                  <th>Score</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //get criteria
                  $criteria = array();
                  $sql = "SELECT id, criteria_name,criteria_percent FROM criteria where event_id = '{$_SESSION['event_id']}'";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $criteria[] = $row;
                    }
                  }
                  $scores = array();
                  $sql = "SELECT criteria_id, score FROM score WHERE judge_id = '{$_SESSION['judge_id']}' AND contestant_id=".$contestant['id'];
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $scores[$row['criteria_id']] = $row['score'];
                    }
                  }

                  
                  //display criteria and scores
                  foreach ($criteria as $criterion):
                  
                    $score = isset($scores[$criterion['id']]) ? $scores[$criterion['id']] : '';
                ?>
                  <tr>
                    <td><?=$criterion['criteria_name']?></td>
                       <input type="text" name="criteria_id" value="<?=$criterion['id']?>" hidden>
                  
                    <td>
                      <input type="number" max="<?=$criterion['criteria_percent']?>" placeholder="<?=$criterion['criteria_percent']?>" name="scores[<?=$criterion['id']?>]" value="<?=$score?>" class="form-control" required>
                    </td>                
                  </tr>
                <?php endforeach; ?>
            <tr>
            <?php
              $comment = '';
              $sql = "SELECT comment FROM comment WHERE judge_id = '{$_SESSION['judge_id']}' AND contestant_id=" . $contestant['id'];
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
              $comment = $row['comment'];
              }
            ?>
              <td colspan="2">
                <p>comment</p>
                <textarea style="width: 100%" name="comment"><?= $comment ?></textarea>
              </td>
            </tr>
            <?php
            }
            else 
            {
            ?>
            <td colspan="2">
            <p>comment</p>
              <textarea style="width: 100%" name="comment"></textarea>
            </td>
            </tr>
            <?php
            }
          ?>
        </tbody>
            </table>
            <input type="text" name="event_id" value="<?=$_SESSION['event_id']?>" hidden>
            <input type="text" name="judge_id" value="<?=$_SESSION['judge_id']?>" hidden>
            <input type="text" name="contestant_id" value="<?=$contestant['id']?>" hidden>
            <a href="#<?=$contestant['id']?>">
            


               <?php
              $sql = "SELECT score FROM score WHERE judge_id = '{$_SESSION['judge_id']}' AND contestant_id=" . $contestant['id'];
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
            ?>
             <input type="submit" name="update" class="btn btn-primary" value="Update Scores">
            <?php
            }
            else 
            {
            ?>
             <input type="submit" name="submit" class="btn btn-primary" value="Submit Scores">
            <?php
            }
          ?>
        
            </a>
          </form>
        </div>
      </div>
      <?php endforeach; ?>
        </div>

<?php
// get criteria
$get_criteria = array();
$sql = "SELECT id,event_id, criteria_name FROM criteria WHERE event_id = '{$_SESSION['event_id']}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $get_criteria[] = $row;
  }
}

// get contestant
$get_contestant = array();
$sql = "SELECT id, contestant_name FROM contestant WHERE event_id = '{$_SESSION['event_id']}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $get_contestant[] = $row;
  }
}

// initialize totals array with zero values for each contestant
$get_totals = array();
foreach ($get_contestant as $contestant) {
  $get_totals[$contestant['id']] = 0;
}

// get score for each contestant and criteria
$get_score = array();
$sql = "SELECT criteria_id, contestant_id, score FROM score WHERE judge_id = '{$_SESSION['judge_id']}' AND event_id = '{$_SESSION['event_id']}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $get_score[$row['contestant_id']][$row['criteria_id']] = $row['score'];
  }

  // calculate total score for each contestant
  foreach ($get_contestant as $contestant) {
    $total_score = 0;
    foreach ($get_criteria as $criteria) {
      $total_score += $get_score[$contestant['id']][$criteria['id']] ?? 0;
    }
    $get_totals[$contestant['id']] = $total_score;
  }
}
?>

<!-- Tab Score -->
<div id="tab-2" class="tab-pane ">
  <table class="table table-bordered text-white text-center">
    <tr>
      <th style="width: 20%">Contestant</th>
      <th>Criteria</th>
      <th style="width: 10%">Total</th>
    </tr>

              <!--display contestant-->
    <?php foreach ($get_contestant as $contestant): ?>
      <tr>
        <td><?= $contestant['contestant_name'] ?></td>
        <td>
          <table class="table text-white text-center">
            <tr>Score</tr>
            <tr>
              <!--display criteria-->
              <?php foreach ($get_criteria as $criteria): ?>
                <th><?= $criteria['criteria_name'] ?></th>
              <?php endforeach; ?>
            </tr>
            <tr>
          <!-- display criteria scores for each contestant -->
          <?php foreach ($get_criteria as $criteria): ?>
          <td>

          <?php if (isset($get_score[$contestant['id']][$criteria['id']])): ?>
          <?= $get_score[$contestant['id']][$criteria['id']] ?>
          <?php else: ?>
            0
          <?php endif; ?>
    </td>
<?php endforeach; ?>
  </tr>
          </table>
        </td>
              <!--display total score-->
        <td><?= $get_totals[$contestant['id']] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>



















      </div> 
    </div>
      
  </div>
	<!-- include jQuery and Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
