<?php
require_once('../pms_judge.php');
$con->judge_score();
$di = $_SESSION['event_id'];
if ($di == '') {

  ob_end_clean();
  header('location:../login/login.php');
  exit();
}
include("../header/assets/index.html");

//connect to database
$conn = mysqli_connect("localhost", "root", "", "pms");

$sql = "SELECT count(id) as count FROM judge WHERE event_id = '{$_SESSION['event_id']}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $count = $row['count'];
  }
}
$tops = '';
$top = "SELECT top FROM event WHERE event_id = '{$_SESSION['event_id']}'";
$results = mysqli_query($conn, $top);
if (mysqli_num_rows($results) > 0) {
  while ($row = mysqli_fetch_assoc($results)) {
    $tops = $row['top'];
  }
}


//get contestants
$rank = 1;
$ranking_name = array('Winner','ND Runner Up','RD Runner Up','TH Runner Up','FT Runner Up');
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
<body style="background: url('assets/picture/background-3.jpg') center / cover no-repeat; color: white">
     
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
$sql = "SELECT c.id, c.contestant_name,c.contestant_no, COALESCE(SUM(s.score), 0) as total_score
        FROM contestant c
        LEFT JOIN score s ON s.contestant_id = c.id
        WHERE c.event_id = '{$_SESSION['event_id']}' 
        GROUP BY c.id
        ORDER BY total_score DESC";
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
$sql = "SELECT criteria_id, contestant_id,sum(score) as scores, ROUND(SUM(score)/".$count.") AS score FROM score WHERE  event_id = '{$_SESSION['event_id']}' GROUP BY criteria_id,contestant_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $get_score[$row['contestant_id']][$row['criteria_id']] = $row['score'];
    $get_scores[$row['contestant_id']][$row['criteria_id']] = $row['scores'];
  }

  // calculate total score for each contestant
  foreach ($get_contestant as $contestant) {
    $total_score = 0;
    $total_scores = 0;
    foreach ($get_criteria as $criteria) {
      $total_score += $get_score[$contestant['id']][$criteria['id']] ?? 0;
      $total_scores += $get_scores[$contestant['id']][$criteria['id']] ?? 0;
    }
    $get_totals[$contestant['id']] = $total_score;
    $total[$contestant['id']] = $total_scores;
  }
}
?>

<!-- Tab Score -->
<h1 class="text-center">Score</h1>
  <table class="table table-bordered text-white text-center" style="width: 98%;margin-left: 10px;">
    <tr>
      <th style="width: 20%">Contestant</th>
      <th style="width: 20 ">Criteria</th>
      <th style="width: 10%">Total</th>
      <th style="width: 5%">Tally</th>
      <th style="width: 5%">Rank</th>
    </tr>

              <!--display contestant-->
    <?php 
    $rank = 1;
    foreach ($get_contestant as $contestant): 
      $rank_text = '';
      if ($tops == 0) {
         if ($rank == 1) {
            $rank_text = '1st';
          } elseif ($rank == 2) {
            $rank_text = '2nd';
          } elseif ($rank == 3) {
            $rank_text = '3rd';
          } elseif ($rank == 4) {
            $rank_text = '4th';
          } elseif ($rank == 5) {
            $rank_text = '5th';
          } elseif ($rank == 6) {
            $rank_text = '6th';
          } elseif ($rank == 7) {
            $rank_text = '7th';
          } elseif ($rank == 8) {
            $rank_text = '8th ';
          } elseif ($rank == 9) {
            $rank_text = '9th ';
          } elseif ($rank == 10) {
            $rank_text = '10th ';
          }
      }
      else
      {
          if ($rank == 1) {
            $rank_text = 'WINNER';
          } elseif ($rank == 2) {
            $rank_text = '1st Place';
          } elseif ($rank == 3) {
            $rank_text = '2nd Place';
          } elseif ($rank == 4) {
            $rank_text = '3rd Place';
          } elseif ($rank == 5) {
            $rank_text = '4th Place';
          } elseif ($rank == 6) {
            $rank_text = '5th Place';
          } elseif ($rank == 7) {
            $rank_text = '6th Place';
          } elseif ($rank == 8) {
            $rank_text = '8th Place';
          } elseif ($rank == 9) {
            $rank_text = '9th Place';
          } elseif ($rank == 10) {
            $rank_text = '10th Place';
          } 
      }
      



      //elseif ($rank > 10) {
      //  break; // stop displaying ranks after top 10
      //} else {
      //  $rank_text = $rank . 'th Place';
      //}
      ?>

      <tr>
        <td style = "vertical-align:middle"><?= $contestant['contestant_name'] ?></td>
        <td>
          <table class="table table-bordered text-white text-center">
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

          <?php if (isset($get_scores[$contestant['id']][$criteria['id']])): ?>
          <?= $get_scores[$contestant['id']][$criteria['id']] ?>
          <?php else: ?>
            0
          <?php endif; ?>
    </td>
<?php endforeach; ?>
  </tr>
          </table>
        </td>
      
              <!--display tally -->
        <?php if(isset($total[$contestant['id']])): ?>
        <td style = "vertical-align:middle"><?= $total[$contestant['id']] ?></td>
        <?php else: ?>
            0
          <?php endif; ?>

              <!--display total score-->
        <?php if(isset($total[$contestant['id']])): ?>
        <td style = "vertical-align:middle"><?= $get_totals[$contestant['id']] ?></td>
        <?php else: ?>
            0
          <?php endif; ?>
        <td style = "vertical-align:middle"><?= $rank_text ?></td>






      </tr>

    <?php
    $rank++;
     endforeach; ?>
  </table>



















	<!-- include jQuery and Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
