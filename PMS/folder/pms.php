 
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

		public function login()
		{
			if (isset($_POST['login'])) {
				$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
				$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
				$con = $this->openConnection();
				$stmt = $con->prepare("SELECT * FROM `username` WHERE username = :name AND password = :password");
				$stmt->bindParam(':name',$name);
				$stmt->bindParam(':password',$password);
				$stmt->execute();
				$row = $stmt->rowCount();
				$fetch = $stmt->fetch();
				if ($row>0) {
					header("location:../main_event/mainevent.php");
					$_SESSION['username'] = $fetch['id'];
				}
				else
				{
					$_SESSION['failed'] = "wrong username and password";
				}
			}
		}
		
		public function event()
		{
			if (isset($_POST['submit'])) {
				$event_name = filter_var(strtolower($_POST['event_name']));
				$user_id = $_POST['user_id'];
				$event_id = filter_var(str_pad(rand(0, 999999), 5, '0', STR_PAD_LEFT));
				$event_description = filter_var($_POST['event_description'],FILTER_SANITIZE_STRING);
				$event_date_start = filter_var($_POST['event_date_start']);
				$event_time_start = filter_var($_POST['event_time_start']);
				$event_date_end = filter_var($_POST['event_date_end']);
				$event_time_end = filter_var($_POST['event_time_end']);
				$top = filter_var($_POST['top'],FILTER_SANITIZE_NUMBER_INT);
				$con = $this->openConnection();

				$stmt = $con->prepare("INSERT INTO `event`(`main_event_id`,`event_id`, `event_name`, `event_description`, `event_date_start`, `event_time_start`, `event_date_end`, `event_time_end`,`top`) VALUES (?,?,?,?,?,?,?,?,?)");
				$stmt->execute([$user_id,$event_id,$event_name,$event_description,$event_date_start,$event_time_start,$event_date_end,$event_time_end,$top]);
				if ($stmt) {
					$_SESSION['event_id'] = $event_id;
					header("location:../judge/judge.php");
				}
				else
				{
					echo "failed";
				}
			}
		}	

		public function main_event()
		{
			
			if (isset($_POST['submit'])) {
				$event_name = filter_var(strtolower($_POST['event_name']));
				$user_id = filter_var($_POST['user_id']);
				$main_event_id = filter_var(str_pad(rand(0, 999999), 5, '0', STR_PAD_LEFT));
				$event_description = filter_var($_POST['event_description']);
				$event_date_start = filter_var($_POST['event_date_start']);
				$event_time_start = filter_var($_POST['event_time_start']);
				$event_date_end = filter_var($_POST['event_date_end']);
				$event_time_end = filter_var($_POST['event_time_end']);
				$con = $this->openConnection();

				$stmt = $con->prepare("INSERT INTO `main_event`(`user_id`,`main_event_id`, `main_event_name`, `main_event_description`, `event_date_start`, `event_time_start`, `event_date_end`, `event_time_end`) VALUES (?,?,?,?,?,?,?,?)");
				$stmt->execute([$user_id,$main_event_id,$event_name,$event_description,$event_date_start,$event_time_start,$event_date_end,$event_time_end]);
				if ($stmt) {
					$_SESSION['main_event_id'] = $main_event_id;
					$stmt = $con->prepare("INSERT INTO `website`( `main_event_id`, `picture`, `facebooklink`, `instagramlink`, `twitterlink`) VALUES (?,'black.jpg','','','')");
					$stmt->execute([$main_event_id]);
					
				}
				else
				{
					echo "failed";
				}
			}
				else if (isset($_POST['update_event'])) {
				

				$event_name = filter_var(strtolower($_POST['event_name']),FILTER_SANITIZE_STRING);
				$event_description = filter_var($_POST['event_description'],FILTER_SANITIZE_STRING);
				$event_date_start = filter_var($_POST['event_date_start']);
				$event_time_start = filter_var($_POST['event_time_start']);
				$event_date_end = filter_var($_POST['event_date_end']);
				$event_time_end = filter_var($_POST['event_time_end']);
				$event_name_value = filter_var(strtolower($_POST['event_name_value']));
				$event_date_start_value = filter_var($_POST['event_date_start_value']);
				$con = $this->openConnection();

				$stmt = $con->prepare("UPDATE `main_event` SET 
					`main_event_name`= ?,
					`main_event_description`=?,
					`event_date_start`=?,
					`event_time_start`=?,
					`event_date_end`=?,
					`event_time_end`=?
					WHERE main_event_name = ? AND
					 event_date_start = ?
	");

				$stmt->execute(
					[$event_name,
					$event_description,
					$event_date_start,
					$event_time_start,
					$event_date_end,
					$event_time_end,
					$event_name_value,
					$event_date_start_value]);
				
			}
			elseif (isset($_POST['delete_event'])) {
			$con = $this->openConnection();
			$delete_event = $_POST['delete_event'];
			$mainevent = '';
			$stmt = $con->prepare("DELETE FROM main_event WHERE main_event_id = :event_id");
			$stmt->bindParam(':event_id',$delete_event);
			$stmt->execute();

					if ($stmt) {
					    $get_event_id = $con->prepare("SELECT event_id from event WHERE main_event_id = :main_event_id");
					    $get_event_id->bindParam(':main_event_id',$delete_event);
					    $get_event_id->execute();
					    $count = $get_event_id->rowCount();
					    $data = $get_event_id->fetchAll(PDO::FETCH_ASSOC);

					    if ($count>0 && !empty($data[0]['event_id'])) {
					        $mainevent = $data[0]['event_id'];
					        $stmt = $con->prepare("DELETE FROM event WHERE event_id = :event_id");
					        $stmt->bindParam(':event_id',$mainevent);
					        $stmt->execute();

					        $stmt = $con->prepare("DELETE FROM contestant WHERE event_id = :event_id");
					        $stmt->bindParam(':event_id',$mainevent);
					        $stmt->execute();

					        $stmt = $con->prepare("DELETE FROM judge WHERE event_id = :event_id");
					        $stmt->bindParam(':event_id',$mainevent);
					        $stmt->execute();

					        $stmt = $con->prepare("DELETE FROM criteria WHERE event_id = :event_id");
					        $stmt->bindParam(':event_id',$delete_event);
					        $stmt->execute();

					        $stmt = $con->prepare("DELETE FROM score WHERE event_id = :event_id");
					        $stmt->bindParam(':event_id',$mainevent);
					        $stmt->execute();

					        $stmt = $con->prepare("DELETE FROM comment WHERE event_id = :event_id");
					        $stmt->bindParam(':event_id',$mainevent);
					        $stmt->execute();
					    }
					}
				else
				{
				}
			}
		}	

		

		public function criteria()
		{
			if (isset($_POST['submit'])) 
			{
			    if(isset($_POST['criteria_name']) && is_array($_POST['criteria_name']))
    			{
    	 			$conn= $this->openConnection();           
        			foreach($_POST['criteria_name'] as $key=>$value)
        			{
            			$criteria_name = filter_var(strtolower($value), FILTER_SANITIZE_STRING);
            			$event_id = filter_var($_POST['event_id'][$key], FILTER_SANITIZE_NUMBER_INT);
            			$criteria_percent = filter_var($_POST['criteria_percent'][$key], FILTER_SANITIZE_STRING);
            			$criteria_description = filter_var($_POST['criteria_description'][$key], FILTER_SANITIZE_STRING);
            			$stmt = $conn->prepare("INSERT INTO `criteria` (event_id,criteria_name,criteria_percent,criteria_description) VALUES(:event_id,:criteria_name, :criteria_percent, :criteria_description)");
            			$stmt->bindParam(':event_id',$event_id);
            			$stmt->bindParam(':criteria_name', $criteria_name);
            			$stmt->bindParam(':criteria_percent', $criteria_percent);
            			$stmt->bindParam(':criteria_description', $criteria_description);
            			$stmt->execute();
            			if ($stmt) {
            				header("location:../contestant/contestant.php");
            			}
        			}
    			}
			}
		}

		public function judge()
		{
			if (isset($_POST['submit'])) {
				$conn = $this->openConnection();
				foreach($_POST['judge_name'] as $key=>$value)
				{
					$judge_name = filter_var(strtolower($value),FILTER_SANITIZE_STRING);
					$event_id = filter_var($_POST['event_id'][$key],FILTER_SANITIZE_NUMBER_INT);
					$judge_password = filter_var($_POST['judge_password'][$key],FILTER_SANITIZE_NUMBER_INT);
					$stmt = $conn->prepare("INSERT INTO `judge` (event_id,judge_name,judge_password) VALUES (:event_id,:judge_name,:judge_password)");
					$stmt->bindParam(':event_id', $event_id);
					$stmt->bindParam(':judge_name', $judge_name);
					$stmt->bindParam(':judge_password', $judge_password);
					$stmt->execute();
					if ($stmt) {
						header("location:../criteria/criteria.php");
					}
				}
				# code...
			}
		}
public function contestant()
{
    if (isset($_POST['submit'])) 
    {
        if(isset($_POST['lastname']) && isset($_POST['contestant_description']) && is_array($_POST['lastname']))
        {
            $conn= $this->openConnection();           
            foreach($_POST['lastname'] as $key=>$value)
            {
            	$event_id = filter_var($_POST['event_id'][$key],FILTER_SANITIZE_NUMBER_INT);
                $picture = time() . '_' . $_FILES['image']['name'][$key];
            	$target = '../contestant/assets/picture/' . $picture;
                  
           	    $lastname = filter_var(strtolower($value), FILTER_SANITIZE_STRING);
                $firstname = filter_var($_POST['firstname'][$key], FILTER_SANITIZE_STRING);
                $middlename = filter_var($_POST['middlename'][$key], FILTER_SANITIZE_STRING);
                $contestant_name = $firstname.' '.$middlename.' '.$lastname; 
              
                $contestant_age = filter_var($_POST['contestant_age'][$key],FILTER_SANITIZE_NUMBER_INT);
                $contestant_motto = filter_var($_POST['motto'][$key],FILTER_SANITIZE_STRING);
                $contestant_address = filter_var($_POST['contestant_address'][$key],FILTER_SANITIZE_STRING);
                $contestant_no = filter_var($_POST['contestant_no'][$key], FILTER_SANITIZE_NUMBER_INT);
                $contestant_description = filter_var($_POST['contestant_description'][$key], FILTER_SANITIZE_STRING);
                
                if(move_uploaded_file($_FILES['image']['tmp_name'][$key],$target))
                {
                    $stmt = $conn->prepare("INSERT INTO `contestant` (event_id,contestant_picture,contestant_name,age,motto,contestant_no,contestant_description,address) VALUES(:event_id,:contestant_picture,:contestant_name,:contestant_age,:contestant_motto, :contestant_no, :contestant_description,:contestant_address)");
                    $stmt->bindParam(':event_id',$event_id);
                    $stmt->bindParam(':contestant_picture', $picture);
                    $stmt->bindParam(':contestant_name', $contestant_name);
                    $stmt->bindParam(':contestant_age', $contestant_age);
                    $stmt->bindParam(':contestant_motto', $contestant_motto);
                    $stmt->bindParam(':contestant_no', $contestant_no);
                    $stmt->bindParam(':contestant_description', $contestant_description);
                    $stmt->bindParam(':contestant_address', $contestant_address);
                    $stmt->execute();
                   
                }
            }
             			$main_id = $_SESSION['main_event_id'];
                        header("location:../event/event.php?id=$main_id");
                        session_unset($_SESSION['event_id']);
                        session_destroy();
                   
        }
    }
}
		

	public function add_new_judge()
	{
		if (isset($_POST['add_new_judge'])) {
			$event_id = $_POST['event_id'];
			$judgename = filter_var(strtolower($_POST['judge_name']),FILTER_SANITIZE_STRING);
			$password = filter_var($_POST['judge_password'],FILTER_SANITIZE_STRING);
			$con = $this->openConnection();
			$stmt = $con->prepare("INSERT INTO `judge`( event_id, judge_name, judge_password) 
				VALUES(:event_id,:judge_name,:judge_password)");
			$stmt->bindParam(':event_id',$event_id);
			$stmt->bindParam('judge_name',$judgename);
			$stmt->bindParam(':judge_password',$password);
			$stmt->execute();
			
			if($stmt)
			{
				$_SESSION['success']= "successfully added";
			}
		}
	}
		public function add_new_criteria()
	{
		if (isset($_POST['add_new_criteria'])) {
			$event_id = filter_var($_POST['event_id'],FILTER_SANITIZE_NUMBER_INT);
			$criteria_name = filter_var(strtolower($_POST['criteria_name']),FILTER_SANITIZE_STRING);
			$criteria_percent = filter_var($_POST['criteria_percent'],FILTER_SANITIZE_STRING);
			$criteria_description = filter_var($_POST['criteria_description'],FILTER_SANITIZE_STRING);
			$con = $this->openConnection();
			$checkcriteria = $con->prepare("SELECT sum(criteria_percent) as total FROM criteria WHERE event_id = :event_id");
			$checkcriteria->bindParam(':event_id',$event_id);
            $checkcriteria->execute();
            $row = $checkcriteria->fetch(PDO::FETCH_ASSOC);
            if ($row['total'] == 100) {
            	# code...
            	echo "<script>alert('please adjust first the criteria percent before adding new criteria'); </script>";
            }
            else
            {
			$stmt = $con->prepare("INSERT INTO `criteria` (event_id,criteria_name,criteria_percent,criteria_description) VALUES(:event_id,:criteria_name, :criteria_percent, :criteria_description)");
            	$stmt->bindParam(':event_id',$event_id);
            	$stmt->bindParam(':criteria_name', $criteria_name);
           		$stmt->bindParam(':criteria_percent', $criteria_percent);
         		$stmt->bindParam(':criteria_description', $criteria_description);
         		$stmt->execute();
            	if($stmt)
			{
				$_SESSION['success']= "successfully added";
			}
		}
		}
	}
		public function add_new_contestant()
	{
		if (isset($_POST['add_new_contestant'])) {
			$event_id = $_POST['event_id'];
			if ($_FILES["profileimage"]["size"] == 0) {
  			
  			$picture = "black.jpg";
			$contestant_no = filter_var(strtolower($_POST['contestant_no']),FILTER_SANITIZE_STRING);
			$contestant_name = filter_var($_POST['contestant_name'],FILTER_SANITIZE_STRING);
			$contestant_age = filter_var($_POST['contestant_age'],FILTER_SANITIZE_STRING);
			$contestant_description = filter_var($_POST['contestant_description'],FILTER_SANITIZE_STRING);
			$contestant_motto = filter_var($_POST['contestant_motto'],FILTER_SANITIZE_STRING);
			$contestant_address = filter_var($_POST['contestant_address'],FILTER_SANITIZE_STRING);
			$con = $this->openConnection();
			
			$stmt = $con->prepare("INSERT INTO `contestant` (event_id,contestant_picture,contestant_name, age, motto, contestant_no, contestant_description, address) VALUES(:event_id,:picture,:contestant_name, :contestant_age,:contestant_motto,:contestant_no, :contestant_description,:contestant_address)");
            	$stmt->bindParam(':event_id',$event_id);
            	$stmt->bindParam(':picture',$picture);
            	$stmt->bindParam(':contestant_name', $contestant_name);
            	$stmt->bindParam(':contestant_age', $contestant_age);
            	$stmt->bindParam(':contestant_motto', $contestant_motto);
            	$stmt->bindParam(':contestant_no', $contestant_no);
            	$stmt->bindParam(':contestant_description', $contestant_description);
            	$stmt->bindParam(':contestant_address', $contestant_address);
            	$stmt->execute();
            		
			if($stmt)
			{
				$_SESSION['success']= "successfully added";
			}
			
  			}
  			else
  			{
			$picture = time() . '_' . $_FILES['profileimage']['name'];
			$target = '../contestant/assets/picture/' . $picture;
			
			$contestant_no = filter_var(strtolower($_POST['contestant_no']),FILTER_SANITIZE_STRING);
			$contestant_name = filter_var($_POST['contestant_name'],FILTER_SANITIZE_STRING);
			$contestant_age = filter_var($_POST['contestant_age'],FILTER_SANITIZE_STRING);
			$contestant_description = filter_var($_POST['contestant_description'],FILTER_SANITIZE_STRING);
			$contestant_motto = filter_var($_POST['contestant_motto'],FILTER_SANITIZE_STRING);
			$contestant_address = filter_var($_POST['contestant_address'],FILTER_SANITIZE_STRING);
			$con = $this->openConnection();
			if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
			{
			
			$stmt = $con->prepare("INSERT INTO `contestant` (event_id,contestant_picture,contestant_name, age, motto, contestant_no, contestant_description, address) VALUES(:event_id,:picture, :contestant_name, :contestant_age,:contestant_motto,:contestant_no, :contestant_description,:contestant_address)");
            	$stmt->bindParam(':event_id',$event_id);
            	$stmt->bindParam(':picture',$picture);
            	$stmt->bindParam(':contestant_name', $contestant_name);
            	$stmt->bindParam(':contestant_age', $contestant_age);
            	$stmt->bindParam(':contestant_motto', $contestant_motto);
            	$stmt->bindParam(':contestant_no', $contestant_no);
            	$stmt->bindParam(':contestant_description', $contestant_description);
            	$stmt->bindParam(':contestant_address', $contestant_address);
            	$stmt->execute();
            		
			if($stmt)
			{
				$_SESSION['success']= "successfully added";
			}
			}
		}
		}
	}
	//START OF UPDATING DATA
	public function update()
	{
		$con = $this->openConnection();
		if (isset($_POST['update_judge'])) {
			$judge_name_value = $_POST['judge_name_value'];
			$judge_password_value = $_POST['judge_password_value'];
			$judge_name = filter_var($_POST['judge_name'],FILTER_SANITIZE_STRING);
			$judge_password = filter_var($_POST['judge_password'],FILTER_SANITIZE_STRING);
			$stmt = $con->prepare("UPDATE `judge` SET `judge_name`=:judge_name,`judge_password`= :judge_password WHERE judge_name = :judge_name_value and judge_password = :judge_password_value");
			$stmt->bindParam(":judge_name",$judge_name);
			$stmt->bindParam("judge_password",$judge_password);
			$stmt->bindParam(":judge_name_value", $judge_name_value);
			$stmt->bindParam(":judge_password_value", $judge_password_value);
			$stmt->execute();
			if ($stmt) {
				header("location:asda");
			}
			else
			{
				header("location:asda");
			}
		
		}
		else if (isset($_POST['update_criteria'])) {
			$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
		
			$criteria_name_value = filter_var($_POST['criteria_name_value'],FILTER_SANITIZE_STRING);
			$criteria_percent_value = filter_var($_POST['criteria_percent_value'],FILTER_SANITIZE_STRING);
			$criteria_description_value = filter_var($_POST['criteria_description_value'],FILTER_SANITIZE_STRING);
			$criteria_name = filter_var($_POST['criteria_name'],FILTER_SANITIZE_STRING);
			$criteria_percent = filter_var($_POST['criteria_percent'],FILTER_SANITIZE_STRING);
			$criteria_description = filter_var($_POST['criteria_description'],FILTER_SANITIZE_STRING);
			$stmt = $con->prepare("UPDATE criteria SET criteria_name = :criteria_name ,criteria_percent = :criteria_percent,criteria_description = :criteria_description WHERE criteria_name = :criteria_name_value AND event_id = :id");
			$stmt->bindParam(':criteria_name',$criteria_name);
			$stmt->bindParam(':criteria_percent',$criteria_percent);
			$stmt->bindParam(':criteria_description',$criteria_description);
			$stmt->bindParam(':criteria_name_value',$criteria_name_value);
			//$stmt->bindParam(':criteria_percent_value',$criteria_percent_value);
			//$stmt->bindParam(':criteria_description_value',$criteria_description_value);
			$stmt->bindParam(':id',$id);
			$stmt->execute();
		}
		else if (isset($_POST['update_contestant'])) {
				$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
		if ($_FILES["profileimage"]["size"] == 0) {
  				
			$contestant_no_value = filter_var($_POST['contestant_no_value'],FILTER_SANITIZE_STRING);
			$contestant_name_value = filter_var($_POST['contestant_name_value'],FILTER_SANITIZE_STRING);
			$contestant_no = filter_var($_POST['contestant_no'],FILTER_SANITIZE_STRING);
			$contestant_name = filter_var($_POST['contestant_name'],FILTER_SANITIZE_STRING);
			$contestant_age = filter_var($_POST['contestant_age'],FILTER_SANITIZE_STRING);
			$contestant_description = filter_var($_POST['contestant_description'],FILTER_SANITIZE_STRING);
			$contestant_motto = filter_var($_POST['contestant_motto'],FILTER_SANITIZE_STRING);
			$contestant_address = filter_var($_POST['contestant_address'],FILTER_SANITIZE_STRING);

			$stmt = $con->prepare("UPDATE `contestant` SET  `contestant_name`=:contestant_name,`age`= :contestant_age,`motto`=:contestant_motto,`contestant_no`= :contestant_no,`contestant_description`=:contestant_description,`address`=:contestant_address WHERE contestant_no = :contestant_no_value AND contestant_name = :contestant_name_value AND event_id = :id");
			$stmt->bindParam(':contestant_name',$contestant_name);
			$stmt->bindParam(':contestant_age',$contestant_age);
			$stmt->bindParam(':contestant_motto',$contestant_motto);
			$stmt->bindParam(':contestant_no',$contestant_no);
			$stmt->bindParam(':contestant_description',$contestant_description);
			$stmt->bindParam(':contestant_address',$contestant_address);
			$stmt->bindParam(':contestant_no_value',$contestant_no_value);
			$stmt->bindParam(':contestant_name_value',$contestant_name_value);
			$stmt->bindParam(':id',$id);
			$stmt->execute();

  			}
			else
			{
			$picture = time() . '_' . $_FILES['profileimage']['name'];
			$target = '../contestant/assets/picture/' . $picture;
			$contestant_no_value = filter_var($_POST['contestant_no_value'],FILTER_SANITIZE_STRING);
			$contestant_name_value = filter_var($_POST['contestant_name_value'],FILTER_SANITIZE_STRING);
			$contestant_no = filter_var($_POST['contestant_no'],FILTER_SANITIZE_STRING);
			$contestant_name = filter_var($_POST['contestant_name'],FILTER_SANITIZE_STRING);
			$contestant_age = filter_var($_POST['contestant_age'],FILTER_SANITIZE_STRING);
			$contestant_description = filter_var($_POST['contestant_description'],FILTER_SANITIZE_STRING);
			$contestant_motto = filter_var($_POST['contestant_motto'],FILTER_SANITIZE_STRING);
			$contestant_address = filter_var($_POST['contestant_address'],FILTER_SANITIZE_STRING);

				if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
				{
					$stmt = $con->prepare("UPDATE `contestant` SET `contestant_picture` = :picture, `contestant_name`=:contestant_name,`age`= :contestant_age,`motto`=:contestant_motto,`contestant_no`= :contestant_no,`contestant_description`=:contestant_description,`address`=:contestant_address WHERE contestant_no = :contestant_no_value AND contestant_name = :contestant_name_value AND event_id = :id");
					$stmt->bindParam(':picture',$picture);
					$stmt->bindParam(':contestant_name',$contestant_name);
					$stmt->bindParam(':contestant_age',$contestant_age);
					$stmt->bindParam(':contestant_motto',$contestant_motto);
					$stmt->bindParam(':contestant_no',$contestant_no);
					$stmt->bindParam(':contestant_description',$contestant_description);
					$stmt->bindParam(':contestant_address',$contestant_address);
					$stmt->bindParam(':contestant_no_value',$contestant_no_value);
					$stmt->bindParam(':contestant_name_value',$contestant_name_value);
					$stmt->bindParam(':id',$id);
					$stmt->execute();
				}
			}
		}
	
	}

	//START OF DELETE FUNCTION
	
	public function delete()
	{
		$con = $this->openConnection();
		if (isset($_POST['delete_contestant'])) {
			$delete_contestant = $_POST['delete_contestant'];
			$stmt = $con->prepare("DELETE FROM contestant WHERE `id` = :delete_contestant");
			$stmt->bindParam(':delete_contestant',$delete_contestant);
			$stmt->execute();
		}
		else if(isset($_POST['delete_criteria']))
		{
			$delete_criteria = $_POST['delete_criteria'];
			$stmt = $con->prepare("DELETE FROM criteria WHERE id = :delete_criteria");
			$stmt->bindParam(':delete_criteria',$delete_criteria);
			$stmt->execute();
		}
		else if (isset($_POST['delete_judge'])) {
			$delete_judge = $_POST['delete_judge'];
			$stmt = $con->prepare("DELETE FROM judge WHERE id = :delete_judge");
			$stmt->bindParam(':delete_judge',$delete_judge);
			$stmt->execute();
		}
	}
	function delete_event()
	{
			if (isset($_POST['delete_event'])) {
			$con = $this->openConnection();
			$delete_event = $_POST['delete_event'];
			$stmt = $con->prepare("DELETE FROM event WHERE event_id = :event_id");
			$stmt->bindParam(':event_id',$delete_event);
			$stmt->execute();

			$stmt = $con->prepare("DELETE FROM contestant WHERE event_id = :event_id");
			$stmt->bindParam(':event_id',$delete_event);
			$stmt->execute();

			$stmt = $con->prepare("DELETE FROM judge WHERE event_id = :event_id");
			$stmt->bindParam(':event_id',$delete_event);
			$stmt->execute();

			$stmt = $con->prepare("DELETE FROM criteria WHERE event_id = :event_id");
			$stmt->bindParam(':event_id',$delete_event);
			$stmt->execute();

			$stmt = $con->prepare("DELETE FROM score WHERE event_id = :event_id");
			$stmt->bindParam(':event_id',$delete_event);
			$stmt->execute();

			$stmt = $con->prepare("DELETE FROM comment WHERE event_id = :event_id");
			$stmt->bindParam(':event_id',$delete_event);
			$stmt->execute();
		}
							else if (isset($_POST['update_event'])) {
							$event_name = strtolower($_POST['event_name']);
							$event_description = $_POST['event_description'];
							$event_date_start = $_POST['event_date_start'];
							$event_time_start = $_POST['event_time_start'];
							$event_date_end = $_POST['event_date_end'];
							$event_time_end = $_POST['event_time_end'];
							$event_name_value = strtolower($_POST['event_name_value']);
							$event_date_start_value = $_POST['event_date_start_value'];
							$con = $this->openConnection();


				if (empty($_POST['top'])) {
							
							$tops = 0;
							$stmt = $con->prepare("UPDATE `event` SET 
								`event_name`= ?,
								`event_description`=?,
								`event_date_start`=?,
								`event_time_start`=?,
								`event_date_end`=?,
								`event_time_end`=?,
								`top`=?
								WHERE event_name = ? AND
								 event_date_start = ?
				");

							$stmt->execute([$event_name,
								$event_description,
								$event_date_start,
								$event_time_start,
								$event_date_end,
								$event_time_end,
								$tops,
								$event_name_value,
								$event_date_start_value]);
							
				}
				else
				{
					$top = $_POST['top'];
							

							
							$stmt = $con->prepare("UPDATE `event` SET 
								`event_name`= ?,
								`event_description`=?,
								`event_date_start`=?,
								`event_time_start`=?,
								`event_date_end`=?,
								`event_time_end`=?,
								`top`=?
								WHERE event_name = ? AND
								 event_date_start = ?
				");

							$stmt->execute([$event_name,
								$event_description,
								$event_date_start,
								$event_time_start,
								$event_date_end,
								$event_time_end,
								$top,
								$event_name_value,
								$event_date_start_value]);
							
						}
					}
	}
	public function profile()
	{
		$profile = array();
		$username = $_SESSION['username'];
		$con = $this->openConnection();
		$stmt = $con->prepare("SELECT * FROM username WHERE id = :username");
		$stmt->bindParam(":username", $username);
		$stmt->execute();
		if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
		{
		  $profile[] = $row; 
		}

    return $profile;
	}
	public function get_profile()
	{
    	$profile = array();
    	$con = $this->openConnection();
    	$stmt = $con->prepare("SELECT * FROM username");
    	$stmt->execute();
    	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    	if ($rows) {
    	    $profile = $rows;
    	}
    	return $profile;
	}

	public function update_profile()
	{
		if (isset($_POST['submit'])) {

			$name_value = filter_var($_POST['name_value'],FILTER_SANITIZE_STRING);
			$username_value = filter_var($_POST['username_value'],FILTER_SANITIZE_STRING);
			$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
			$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
			$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
			$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING); 
			$address = filter_var($_POST['address'],FILTER_SANITIZE_STRING);

			$con = $this->openConnection();
			$stmt = $con->prepare("UPDATE `username` SET name=:name, email=:email ,username=:username ,password=:password,address = :address WHERE name = :name_value and username=:username_value");
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':username',$username);
			$stmt->bindParam(':password',$password);
			$stmt->bindParam(':address',$address);
			$stmt->bindParam(':name_value',$name_value);
			$stmt->bindParam(':username_value',$username_value);
			$stmt->execute();
		}
	}
	public function add_profile()
	{
		$con = $this->openConnection();

		if (isset($_POST['submit'])) {

			$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
			$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
			$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
			$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING); 
			$address = filter_var($_POST['address'],FILTER_SANITIZE_STRING);
			
			$stmt = $con->prepare("SELECT * FROM username WHERE name = :name or username = :username");
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':username',$username);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {
				$_SESSION['exist'] = 'xsa';
			}
			else
			{
			$stmt = $con->prepare("INSERT INTO `username`(name, email, username, password, address) VALUES (:name,:email,:username,:password,:address)");
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':username',$username);
			$stmt->bindParam(':password',$password);
			$stmt->bindParam(':address',$address);
			$stmt->execute();
			}
		}
		elseif (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $event_id = '';
    $main_event_id = '';
    $stmt = $con->prepare("SELECT main_event_id FROM main_event WHERE user_id = :id");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count>0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $main_event_id = $row['main_event_id'];

        $stmts = $con->prepare('SELECT event_id FROM event WHERE main_event_id = :main_event_id');
        $stmts->bindParam(':main_event_id',$main_event_id);
        $stmts->execute();
        $rowcount = $stmts->rowCount();
        if ($rowcount>0) {
            $res = $stmts->fetch(PDO::FETCH_ASSOC);
            $event_id = $res['event_id'];


            //start of delete

            $stmt = $con->prepare("DELETE FROM username WHERE id = :id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM main_event WHERE user_id = :id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM event WHERE event_id = :event_id");
            $stmt->bindParam(':event_id',$event_id);
            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM contestant WHERE event_id = :event_id");
            $stmt->bindParam(':event_id',$event_id);
            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM judge WHERE event_id = :event_id");
            $stmt->bindParam(':event_id',$event_id);
            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM criteria WHERE event_id = :event_id");
            $stmt->bindParam(':event_id',$event_id);
            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM score WHERE event_id = :event_id");
            $stmt->bindParam(':event_id',$event_id);
            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM comment WHERE event_id = :event_id");
            $stmt->bindParam(':event_id',$event_id);
            $stmt->execute();

        	}
        	else
        	{
        	$stmt = $con->prepare("DELETE FROM username WHERE id = :id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();

            $stmt = $con->prepare("DELETE FROM main_event WHERE user_id = :id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
		    }
	}
   	else
    	 	{
    		$stmt = $con->prepare("DELETE FROM username WHERE id = :id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();

    	}
	}
	
	
}
	public function getprofile()
	{
		
		if (isset($_POST['update'])) {
			$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
			$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
			$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
			$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING); 
			$address = filter_var($_POST['address'],FILTER_SANITIZE_STRING);

			$con = $this->openConnection();
			$stmt = $con->prepare("UPDATE `username` SET name=:name, email=:email ,username=:username ,password=:password,address = :address WHERE name = :name and username=:username");
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':username',$username);
			$stmt->bindParam(':password',$password);
			$stmt->bindParam(':address',$address);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':username',$username);
			$stmt->execute();
		}
	}
}


$con = new Mycon();


?>