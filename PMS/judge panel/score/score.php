<?php
require_once('../pms_judge.php');
/*$di = $_SESSION['event_id'];
if ($di == '') {

  ob_end_clean();
  header('location:../login/login.php');
  exit();
}*/
include("../header/assets/index.html");

//connect to database
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
$conn = mysqli_connect("localhost", "root", "", "pms");

//get contestants
$contestants = array();
$sql = "SELECT id,contestant_picture, contestant_name,contestant_no,contestant_description FROM contestant where event_id ='{$_SESSION['event_id']}' ORDER BY contestant_no asc ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $contestants[] = $row;
  }
}

$ed = $_SESSION['event_id'];
$getcriteria = $pdo->prepare('SELECT * FROM criteria WHERE event_id = :event_id');
$getcriteria->bindParam(':event_id',$ed);
$getcriteria->execute();
$criteria_get = $getcriteria->fetchALl(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>PCMS</title>
 
  <script

      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">
    <style type="text/css">
      *
      {
        text-align: justify;
        color: black;
      }
      body
      {
        background-color: #d5d5d7;
      }
    </style>

</head>
<body >
  <div class="container" style="margin-top: 10px;">
    <ul class="nav nav-tabs">
      <li class="nav-item" ><a class="nav-link active"  data-toggle="tab" href="#tab-1">Intruction</a></li>
      <?php //foreach ($contestants as $contestant): ?>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#4">Candidates<?php //$contestant['contestant_name']?></a></li>
      <?php //endforeach; ?>
      <li class="nav-item" ><a class="nav-link"  data-toggle="tab" href="#tab-2">Score</a></li>
   
    </ul>
    <div class="tab-content" >
      <div id="tab-1" class="tab-pane active" style="background: url('../../background/bg-judge1.png') center / cover no-repeat; padding-right: 10px;padding-left: 10px; padding-top: 40px;padding-bottom: 30px;">
        <div style="margin-top: 50px;">
      <h3 >Welcome Judge <?=$_SESSION['judge_name']?></h3>
      <h4>&emsp;&emsp; We're thrilled to have you with us today. As a respected member of our panel of judges, your expertise and keen eye will be invaluable in evaluating the contestants and helping us crown the winner. Thank you for your dedication to this event, and we look forward to working with you throughout the competition.</h4>
      <h6>Criteria Description</h6>
      <?php foreach($criteria_get as $get):?>
        <h6><?=$get['criteria_name']?></h6>
        <h6><?=$get['criteria_description']?></p>
      <?php endforeach;?>
      <p style="color: red;">
        Please note that once you enter a score, it will be automatically submitted after 30 seconds and cannot be changed. Please review your scores carefully before submitting. Good luck and have a great competition!
      </p>
   	  </div> 
    </div>
        <div id="4" class="tab-pane" style="column-count: 1">

      <?php foreach ($contestants as $contestant): ?>

        <div class="candidate" style="columns: 2;margin-bottom: 50px;">
        <div class="con d-flex" >

          <div class="info">
          <h2>Contestant No <?=$contestant['contestant_no']?></h2>
          
          <h3>Name: <?=$contestant['contestant_name']?></h3>
          <p><?=$contestant['contestant_description']?></p> 
          </div >
          <div class = "pic text-end col-md-5" style="text-align: right; ">
          <img src="../../contestant/assets/picture/<?=$contestant['contestant_picture']?>" style="width: 240px;height: 250px;text-align: right;border-radius: 120px;">
          </div>
        </div>
        <div class="form-class">
          <form method="POST" id="scorecard-form-<?=$contestant['id']?>" class="scorecard-form" >
            <table class="table table-bordered" style="color: black;border-color: black;">
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
                     $readonly = !empty($scores) ? 'readonly' : '';
   
                ?>
                  <tr>
                    <td><?=$criterion['criteria_name']?></td>
                       <input type="text" name="criteria_id" value="<?=$criterion['id']?>" hidden>
                  
                    <td>

                      <input type="number" max="<?=$criterion['criteria_percent']?>" id="score"
                     placeholder="<?=$criterion['criteria_percent']?>" name="scores[<?=$criterion['id']?>]" value="<?=$score?>" class="form-control" required <?= $readonly ?>>
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
                <textarea style="width: 100%"  name="comment" readonly=""><?= $comment ?></textarea>
              </td>
            </tr>
            <?php
            }
            else 
            {
            ?>
            <td colspan="2">
            <p>comment</p>
              <textarea style="width: 100%" id="comment" name="comment"></textarea>
            </td>
            </tr>
            <?php
            }
          ?>
        </tbody>
            </table>
            <input type="text" id="event_id" name="event_id" value="<?=$_SESSION['event_id']?>" hidden>
            <input type="text" id="judge_id" name="judge_id" value="<?=$_SESSION['judge_id']?>" hidden>
            <input type="text" id="contestant_id" name="contestant_id" value="<?=$contestant['id']?>" hidden>
            <a href="#<?=$contestant['id']?>">
            

              <?php
                      $score = isset($scores[$criterion['id']]) ? $scores[$criterion['id']] : '';
                     $hidden = !empty($scores) ? 'hidden' : '';
   
              ?>
             <input type="submit" name="submit" id="save" class="btn btn-primary" value="Submit Scores" <?=$hidden?>>
            </a>
          </form>
        </div>
      </div>
      <?php endforeach; ?>
        </div>



<!-- Tab Score -->
<div id="tab-2" class="tab-pane ">
  <!--<button id="refresh-button">Refresh Table</button>-->
  <table id="score-table" class="table table-bordered  text-center" style="border-color: black; margin-top: 10px; text-align: center;" >

</div>

      </div> 
    </div>
      
  </div>
	<!-- include jQuery and Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
  <script type="text/javascript">
  function refreshTable() {
    // Code to refresh the table here
    // This could include an AJAX call to the server to update the data
    // and then re-render the table HTML

    // For example, you could replace the contents of the table container
    // with new HTML returned by the server
    var tableContainer = document.getElementById("score-table");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        tableContainer.innerHTML = this.responseText;
      }
    };
    xhr.open("GET", "refresh.php", true);
    xhr.send();
  }

  // Refresh the table every 10 seconds (10000 milliseconds)
  setInterval(refreshTable, 1000);
</script>

  </script>
<!--
<script type="text/javascript">
   $(document).ready(function() {
  $('.scorecard-form').submit(function(event) {
    event.preventDefault();

    // Get the form data
    var formData = $(this).serialize();

    // Send the form data to the server
    $.ajax({
      url: '../judgescore.php',
      type: 'POST',
      data: formData,
      success: function(response) {
        // Display a success message to the user
        alert('Scores submitted successfully!');
        
        // Reset the form
        $('.scorecard-form')[0].reset();
      },
      error: function() {
        // Display an error message to the user
        alert('An error occurred while submitting the scores.');
      }
    });
  });
});



</script>
-->
<script type="text/javascript">
$(document).ready(function() {
  // Make the input boxes read-only initially

  $('.scorecard-form').submit(function(event) {
    event.preventDefault();

    // Get the form data
    var formData = $(this).serialize();

    // Send the form data to the server
    $.ajax({
      url: '../judgescore.php',
      type: 'POST',
      data: formData,
      success: function(response) {
        // Display a success message to the user
        alert('Scores submitted successfully!');
        
        // Hide the submit button
        var submitBtn = $(event.target).find('input[type="submit"]');
        submitBtn.attr('hidden', true);
        submitBtn.prop('disabled', true);
        
        // Make the input boxes read-only
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error submitting scores: ' + textStatus);
      }
    });
  });
});




</script>

  <script type="text/javascript">
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
  </script>
</body>
</html>
