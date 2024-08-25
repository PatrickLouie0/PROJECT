<?php
session_start();
$conn = mysqli_connect("localhost","root","","pms");
$get_criteria = array();
$sql = "SELECT id,event_id, criteria_name FROM criteria WHERE event_id = '{$_SESSION['event_id']}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $get_criteria[] = $row;
  }
}
$count_criteria = '';
$sql = "SELECT COUNT(criteria_name) AS count FROM criteria WHERE event_id = '{$_SESSION['event_id']}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $count_criteria = $row['count'];
  }
}

// get contestant
$get_contestant = array();
$sql = "SELECT c.id, c.contestant_name,c.contestant_no, COALESCE(SUM(s.score), 0) as total_score
        FROM contestant c
        LEFT JOIN score s ON s.contestant_id = c.id
        WHERE c.event_id = '{$_SESSION['event_id']}' 
        AND s.judge_id = '{$_SESSION['judge_id']}'
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

// Same code that generates the table in your original PHP file

// Instead of outputting HTML, output the table data as a string
$output = '';

$output .= '<tr style="text-align:center"><th>No</th><th>Contestant</th><th>Score</th><th>Total</th></tr>';

foreach ($get_contestant as $contestant) {
  $output .= '<tr><td style = "vertical-align:middle;text-align:center">' . $contestant['contestant_no'] . '</td>';
  $output .= '<td style = "vertical-align:middle;text-align:center">' . $contestant['contestant_name'] . '</td><td>';

  $output .= '<table class="table table-bordered" style = "color:black;border-color:black;margin-top:5px;text-align:center"><tr><th colspan="'.$count_criteria.'" style = "text-align:center">Criteria</th></tr><tr>';

  foreach ($get_criteria as $criteria) {
    $output .= '<th style="text-align:center">' . $criteria['criteria_name'] . '</th>';
  }

  $output .= '</tr><tr>';

  foreach ($get_criteria as $criteria) {
    $output .= '<td style = "text-align:center">';

    if (isset($get_score[$contestant['id']][$criteria['id']])) {
      $output .= $get_score[$contestant['id']][$criteria['id']];
    } else {
      $output .= '0';
    }

    $output .= '</td>';
  }

  $output .= '</tr></table></td><td style = "vertical-align:middle;text-align:center">' . $get_totals[$contestant['id']] . '</td></tr>';
}

echo $output;
?>
