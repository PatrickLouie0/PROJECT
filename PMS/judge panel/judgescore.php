<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "pms");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the scores and comments from the form data
$judge_id = $_POST['judge_id'];
$event_id = $_POST['event_id'];
$scores = $_POST['scores'];
$comment = $_POST['comment'];
$contestant_id = $_POST['contestant_id'];

// Check if the judge has already scored the contestant
$sql = "SELECT * FROM score WHERE judge_id = '$judge_id' AND event_id = '$event_id' AND contestant_id = '$contestant_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // The judge has already scored the contestant, so do not insert the scores or comments
  echo "You have already scored this contestant.";
} else {
  // Insert the scores into the database
  foreach ($scores as $criteria_id => $score) {
    $sql = "INSERT INTO score (event_id,judge_id, contestant_id, criteria_id, score) VALUES ('$event_id','$judge_id', '$contestant_id', '$criteria_id', '$score')";
    mysqli_query($conn, $sql);
  }

  // Insert the comment into the database
  $sql = "INSERT INTO comment (event_id,judge_id, contestant_id, comment) VALUES ('$event_id','$judge_id', '$contestant_id', '$comment')";
  mysqli_query($conn, $sql);

  // Close the database connection
  mysqli_close($conn);

  // Return a success message to the user
  echo "Scores submitted successfully!";
}
?>
