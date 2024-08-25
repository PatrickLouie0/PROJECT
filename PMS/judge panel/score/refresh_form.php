<?php
require_once('../pms_judge.php');
$conn = mysqli_connect("localhost", "root", "", "pms");

$form_output = '';
//get contestants
$contestants = array();
$sql = "SELECT id,contestant_picture, contestant_name,contestant_no,contestant_description FROM contestant where event_id ='{$_SESSION['event_id']}' ORDER BY contestant_no asc ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $contestants[] = $row;
  }
}
 foreach ($contestants as $contestant):
 
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


  	$form_output .='
        <div class="candidate" style="columns: 2;margin-bottom: 50px;">
        <div class="con d-flex" style="columns: ">

          <div class="info">
          <h2>Contestant No '.$contestant['contestant_no'].'</h2>      
          <h3>Name: '.$contestant['contestant_name'].'</h3>
          <p>'.$contestant['contestant_description'].'</p> 
          </div >
          <div class = "pic text-end col-md-5" style="text-align: right; ">
          <img src="../../contestant/assets/picture/'.$contestant['contestant_picture'].'" style="width: 240px;height: 250px;text-align: right;border-radius: 120px;">
          </div>
        </div>
        <div class="form-class">
          <form method="POST" id="scorecard-form-'.$contestant['id'].'" class="scorecard-form" >
            <table class="table table-bordered" style="color: white">
              <thead>
                <tr>
                  <th>Criteria</th>
                  <th>Score</th>
                </tr>
              </thead>
              <tbody>';
                
                 
                  //display criteria and scores
             foreach ($criteria as $criterion):
    $score = isset($scores[$criterion['id']]) ? $scores[$criterion['id']] : '';
    $readonly = !empty($scores) ? 'readonly' : '';
    $form_output .= '
        <tr>
            <td>'.$criterion['criteria_name'].'</td>
            <input type="text" name="criteria_id" value="'.$criterion['id'].'" hidden>
            <td>
                <input type="number" max="'.$criterion['criteria_percent'].'" id="score"
                placeholder="'.$criterion['criteria_percent'].'" name="scores['.$criterion['id'].']" value="'.$score.'" class="form-control" '.$readonly.' required>
            </td>                
        </tr>
    ';
endforeach;


            $form_output .= '<tr>';
            
             $comment = '';
              $sql = "SELECT comment FROM comment WHERE judge_id = '{$_SESSION['judge_id']}' AND contestant_id=" . $contestant['id'];
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
              $comment = $row['comment'];
              }
            $form_output .='
              <td colspan="2">
                <p>comment</p>
                <textarea style="width: 100%"  name="comment" readonly="">'. $comment .'</textarea>
              </td>
            </tr>';
     
            }
            else 
            {
            $form_output .= '
            <td colspan="2">
            <p>comment</p>
              <textarea style="width: 100%" id="comment" name="comment"></textarea>
            </td>
            </tr>';
            }

         $form_output .='
        </tbody>
            </table>
            <input type="text" id="event_id" name="event_id" value="'.$_SESSION['event_id'].'" hidden>
            <input type="text" id="judge_id" name="judge_id" value="'.$_SESSION['judge_id'].'" hidden>
            <input type="text" id="contestant_id" name="contestant_id" value="'.$contestant['id'].'" hidden>
            <a href="#'.$contestant['id'].'">
            


             <input type="submit" name="submit" id="save" class="btn btn-primary" value="Submit Scores">
           
            </a>
          </form>
        </div>
      </div>';
       endforeach;
echo $form_output;
?>