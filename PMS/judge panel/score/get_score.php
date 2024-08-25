<?php
require_once('../pms_judge.php');

// Get the judge ID and contestant ID from the query parameters
$judge_id = $_GET['judge_id'];
$contestant_id = $_GET['contestant_id'];

// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "pms");

// Retrieve the scores for the given judge and contestant
$sql = "SELECT criteria_id, score FROM score WHERE judge_id = '{$judge_id}' AND contestant_id = '{$contestant_id}'";
$result = mysqli_query($conn, $sql);

// Prepare the scores as a JSON object
$scores = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $scores[$row['criteria_id']] = $row['score'];
  }
}
echo json_encode($scores);

// Close the database connection
mysqli_close($conn);
?>
