<?php
require_once('../folder/pms.php');
$eventid = filter_var($_GET['event_id'],FILTER_SANITIZE_NUMBER_INT);

//connect to database
$conn = mysqli_connect("localhost", "root", "", "pms");

$sql = "SELECT count(id) as count FROM judge WHERE event_id = '$eventid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $count = $row['count'];
  }
}

//get contestants
$rank = 1;
$ranking_name = array('Winner','ND Runner Up','RD Runner Up','TH Runner Up','FT Runner Up');
$contestants = array();
$sql = "SELECT id, contestant_name,contestant_no,contestant_description FROM contestant where event_id ='$eventid' ";
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
  <title>Result</title>
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style type="text/css">
    table
    {
      border:1px solid black;
    }
  </style>
</head>
<body style="background: url('../background/bg-table.png') center / cover no-repeat; color: black;height: 560px;">
     
<?php
// get criteria
$get_criteria = array();
$sql = "SELECT id,event_id, criteria_name FROM criteria WHERE event_id = '$eventid'";
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
        WHERE c.event_id = '$eventid' 
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
$sql = "SELECT criteria_id, contestant_id,sum(score) as scores, ROUND(SUM(score)/".$count.") AS score FROM score WHERE  event_id = '$eventid' GROUP BY criteria_id,contestant_id";
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
<h1 class="text-center" >Score Result</h1>
  <table class="table table-bordered text-white text-center" style="width: 98%;max-height: 200px;overflow-y: scroll; margin-left: 10px;border-color: black;border-width: 2px;">
    <tr class="" style="border-color: black;">
      <th style="width: 20%;text-align: center;border-color: black;">Contestant</th>
      <th style="width: 20%;text-align: center;border-color: black;">Criteria</th>
      <th style="width: 10%;text-align: center;border-color: black;">Total</th>
      <th style="width: 5%;text-align: center;border-color: black;">Tally</th>
      <th style="width: 5%;text-align: center;border-color: black;">Rank</th>
    </tr>

              <!--display contestant-->
    <?php 
    $rank = 1;
    foreach ($get_contestant as $contestant): 
      $rank_text = '';

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
        $rank_text = '3rd Place';
      } elseif ($rank == 8) {
        $rank_text = '8th Place';
      } elseif ($rank == 9) {
        $rank_text = '9th Place';
      } elseif ($rank == 10) {
        $rank_text = '10th Place';
      } 
      
      



      //elseif ($rank > 10) {
      //  break; // stop displaying ranks after top 10
      //} else {
      //  $rank_text = $rank . 'th Place';
      //}
      ?>

      <tr style="border-color: black;">
        <td style="border-color: black;vertical-align: middle;"><?= $contestant['contestant_name'] ?></td>
        <td style="border-color:black;">
          <table class="table table-bordered text-white text-center " style="background-color: transparent;text-align:center; border-style:1px solid black;">
            <tr style="border-color: black;">Score</tr>
            <tr style="border-color: black;">
              <!--display criteria-->
              <?php foreach ($get_criteria as $criteria): ?>
                <th style="border-color: black;"><?= $criteria['criteria_name'] ?></th>
              <?php endforeach; ?>
            </tr>
            <tr style="border-color: black;">
          <!-- display criteria scores for each contestant -->
          <?php foreach ($get_criteria as $criteria): ?>
          <td style="border-color: black;">

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
      <!-- display tally -->
<td style="border-color: black; vertical-align: middle;">
    <?php if(isset($total[$contestant['id']])): ?>
        <?= $total[$contestant['id']] ?>
    <?php else: ?>
        0
    <?php endif; ?>
</td>

<!-- display total score -->
<td style="border-color: black;vertical-align: middle;">
    <?php if(isset($get_totals[$contestant['id']])): ?>
        <?= $get_totals[$contestant['id']] ?>
    <?php else: ?>
        0
    <?php endif; ?>
</td>

        <td style="border-color: black;vertical-align: middle;"><?= $rank_text ?></td>






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
