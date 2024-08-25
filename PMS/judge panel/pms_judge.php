 
 <?php 
 session_start();
//connection to database
	class Mycon
	{
		private $server = "mysql:host=localhost;dbname=pms";
		private $user = "root";
		private $pass= "";
		//PDO CONFIGURATION
		private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC);
		protected $con;
		public function openConnection()
		{
			try
			{
				$this->con = new PDO($this->server,$this->user,$this->pass,$this->options);
				return $this->con; 
			}
			catch(PDOException $e)
			{
				echo "There is some problem in the connection:".$e->getMessage();
			}
		}
		public function closeConnection()
		{
			$this->con = null;
		}
	
		public function judge_login()
		{
			if (isset($_POST['login'])) {
			  $con = $this->openConnection();
			  $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
			  $stmt = $con->prepare("SELECT id,event_id,judge_name FROM judge WHERE judge_password = :password");
			  $stmt->bindParam(":password",$password);
			  $stmt->execute();
			  $row = $stmt->rowCount();
			  $data = $stmt->fetchAll();
			  if ($row>0) {
			    $validate = $con->prepare("SELECT `event_date_start`, `event_time_start`, `event_date_end`, `event_time_end`, `date_time` FROM `event` WHERE event_id =:event_id");
			    $eve_id = $data[0]['event_id'];
			    $validate->bindParam(':event_id',$eve_id);
			    $validate->execute();
			    $count = $validate->rowCount();
			    $validate_data = $validate->fetchAll();
			    if ($count>0) {
			    	date_default_timezone_set('Asia/Manila');
			     $current_date_time = date('Y-m-d H:i:s');
			     echo $current_date_time;
				$event_date_time_start = $validate_data[0]['event_date_start'] . ' ' . date('H:i:s', strtotime($validate_data[0]['event_time_start']));
				echo "<br>".$event_date_time_start."<br>";
				$event_date_time_end = $validate_data[0]['event_date_end'] . ' ' . date('H:i:s', strtotime($validate_data[0]['event_time_end']));
				echo $event_date_time_end;
			      if ($current_date_time < $event_date_time_start || $current_date_time > $event_date_time_end) {
			        // Not within event time, do not allow login
			        $_SESSION['validate'] = "login failed";
			      } else {
			        // Within event time, allow login
			        $_SESSION['event_id'] = $data[0]['event_id'];
			        $_SESSION['judge_id'] = $data[0]['id'];
			        $_SESSION['judge_name'] = $data[0]['judge_name'];
			        header("location:../score/score.php");
			      }
			    }
			    else
			    {
			      echo "no data";
			    }
			  }
			  else
			  {
			    $_SESSION['failed'] = "login failed";
			  }
			}

		}

public function judge_score()
{
    if(isset($_POST['event_id']) && isset($_POST['judge_id']) && isset($_POST['contestant_id']) && isset($_POST['scores']) && isset($_POST['comment'])) {
        // Get the values from the AJAX request
        $event_id = $_POST['event_id'];
        $judge_id = $_POST['judge_id'];
        $contestant_id = $_POST['contestant_id'];
        $scores = $_POST['scores'];
        $comment = $_POST['comment'];
        
        // Open a connection to the database
        $con = $this->openConnection();
        
        // Insert the scores into the database
        $stmt = $con->prepare("INSERT INTO score (event_id, judge_id, contestant_id, criteria_id, score) VALUES (:event_id, :judge_id, :contestant_id, :criteria_id, :score)");

        foreach ($scores as $criteria_id => $score) {
            $stmt->bindValue(':event_id', $event_id);
            $stmt->bindValue(':judge_id', $judge_id);
            $stmt->bindValue(':contestant_id', $contestant_id);
            $stmt->bindValue(':criteria_id', $criteria_id);
            $stmt->bindValue(':score', $score);
            $stmt->execute();
        }

        // Insert the comment into the database
        $stmt = $con->prepare("INSERT INTO comment (event_id, judge_id, contestant_id, comment) VALUES (:event_id, :judge_id, :contestant_id, :comment)");

        $stmt->bindValue(':event_id', $event_id);
        $stmt->bindValue(':judge_id', $judge_id);
        $stmt->bindValue(':contestant_id', $contestant_id);
        $stmt->bindValue(':comment', $comment);
        $stmt->execute();
        
        // Close the database connection
        $this->closeConnection($con);
    }
}





	}
	$con = new Mycon();
?>