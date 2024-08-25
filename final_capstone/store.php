 
 <?php 
//connection to database
	class MyStore
	{
		private $server = "mysql:host=localhost;dbname=store_member";
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
	
//login
	public function login_member()
	{
		session_start();
		if (isset($_POST['submit'])) 
		{
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars(md5($_POST['password']));
			$status = '0';
			$connection = $this->openConnection();
			$stmt = $connection->prepare("SELECT * FROM  employee WHERE username = ? AND password = ?");
			$stmt->execute([$username,$password]);

			$sttm = $connection->prepare("INSERT INTO `employee_info`( `picture`, `username`, `password`, `lastname`, `firstname`, `middlename`, `number`, `email`, `address`,`status`) 
                    SELECT  `picture`, `username`, `password`, `lastname`, `firstname`, `middlename`, `number`, `email`, `address`,'$status' FROM `employee` WHERE username= ? AND password = ?");
			$sttm->execute([$username,$password]);
			$user = $stmt->fetch();
			$total = $stmt->rowCount();
			if($total > 0)
			{
				$_SESSION['usernames']=$username;  
				header("location:viewproduct.php");
				echo "success";
			}
			else
			{
				$_SESSION['username_not_correct']= 'username or password is incorrect';  
			}
		
			
		}
	}						
	public function login_manager()
	{
		session_start();
		if (isset($_POST['submits'])) 
		{
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);
			$status_manager = '1';
			
			$connection = $this->openConnection();
			$stmt = $connection->prepare("SELECT * FROM  manager WHERE username = ? AND password = ?");
			$stmt->execute([$username,$password]);
			$sttm = $connection->prepare("INSERT INTO `employee_info`( `picture`, `username`, `password`, `lastname`, `firstname`, `middlename`, `number`, `email`, `address`,`status`) 
                    SELECT  `picture`, `username`, `password`, `lastname`, `firstname`, `middlename`, `number`, `email`, `address`,'$status_manager' FROM `manager` WHERE username= ? AND password = ?");
			$sttm->execute([$username,$password]);
			$user = $stmt->fetch();
			$total = $stmt->rowCount();
			if($total > 0)
			{
				$_SESSION['user-manager']=$username;  
				header("location:dashboard.php");
			}
			else
			{
				$_SESSION['username_not_correct']= 'incorrect username and password';  
			}
		
			
		}
	}						
		//this is a parameter
	public function set_userdata($array)
	{
		if (!isset($_SESSION))
		{
			session_start();
		}
		$_SESSION['userdata'] = array("fullname" => $array['firstname']."".$array['middlename']."".$array['lastname'],"access" => $array['access']);
		return $_SESSION['userdata'];

	}
	public function get_userdata()
	{
		if (!isset($_SESSION)) 
		{
			session_start(); 
		}
		if (isset($_SESSION['userdata'])) 
		{
			return $_SESSION['userdata'];
		}
		else
			return null;
	}
	//for logout
	public function logout()
	{
		if (!isset($_SESSION)) 
		{
			session_start();
			$username = $_SESSION['user-manager'];
			$connection = $this->openConnection();
			$sttm = $connection->prepare("DELETE FROM employee_info  WHERE username = '$username'");
				
						$sttm->execute();
		
		}
		$_SESSION['userdata'] = null;
		unset($_SESSION['userdata']);
		session_destroy();  
	}
	public function employee_logout()
	{
		if (!isset($_SESSION)) 
		{
			session_start();
			error_reporting(1);
			$username = $_SESSION['usernames'];
			error_reporting(1);

			session_start();
			$connection = $this->openConnection();
			$sttm = $connection->prepare("DELETE FROM `employee_info` WHERE username = '$username'");
			$sttm->execute();
		
		}
		$_SESSION['userdata'] = null;
		unset($_SESSION['userdata']);
	}
	
	//check if account exist
	public function employee_account_checker($username,$lastname,$firstname,$middlename)
	{
			$username = $_POST['username'];
			$lastname = $_POST['lname'];
			$firstname = md5($_POST['fname']);
			$middlename = md5($_POST['mname']);
			$password = md5($_POST['password']);

			$connection = $this->openConnection($username,$lastname,$firstname,$middlename);
			$stmt = $connection->prepare("SELECT * FROM  manager WHERE username = ?");
			$stmt->execute([$username,$lastname,$firstname,$middlename]);
			$total = $stmt->rowCount();
			return $total;

	}
	
//add new manager
	public function manager()
	{
		if (empty($_POST['username']) AND empty($_POST['las']) AND empty($_POST['firstname']) AND empty($_POST['middlename']) AND empty($_POST['number']) AND empty($_POST['email']) AND empty($_POST['address']) AND empty($_POST['password']))
		{
			$_SESSION['msg'] = "Please fill all empty box..";
			$_SESSION['alert'] = "alert alert-danger"; 
		
		}
		else
		{
			if(isset($_POST['add_employee']))
			{
				$profileimagename = time() . '_' . $_FILES['profileimage']['name'];
				$username = $_POST['username'];
				$lastname = strtoupper($_POST['lname']);
				$firstname = strtoupper($_POST['fname']);
				$middlename = strtoupper($_POST['mname']);
				$number = $_POST['number'];
				$email = $_POST['email'];
				$address = strtoupper($_POST['address']);
				$password = md5($_POST['password']);
				$status = 'manager';
				$target = 'employee_picture/' . $profileimagename;
					if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
					{

						$connection = $this->openConnection();
						$stmt = $connection->prepare("INSERT INTO manager(`picture`,`username`,`password`,`lastname`,`firstname`,`middlename`,`number`,`email`,`address`,`manager`) VALUES(?,?,?,?,?,?,?,?,?,?)");
						$run =$stmt->execute([$profileimagename,$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$status]);
						if ($run) {
							$_SESSION['msg'] = "Successfully Added..";
						
						}
					}
					else
					{
						$picture = 'user.png';
						$connection = $this->openConnection();
						$stmt = $connection->prepare("INSERT INTO manager(`picture`,`username`,`password`,`lastname`,`firstname`,`middlename`,`number`,`email`,`address`,`status`) VALUES(?,?,?,?,?,?,?,?,?,?)");
						$run =$stmt->execute([$picture,$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$status]);
						if ($run) {
							$_SESSION['msg'] = "Successfully Added..";
						
						}
					}

			}

		}
	}
	public function employee()
	{
		if (empty($_POST['username']) AND empty($_POST['las']) AND empty($_POST['firstname']) AND empty($_POST['middlename']) AND empty($_POST['number']) AND empty($_POST['email']) AND empty($_POST['address']) AND empty($_POST['password']))
		{
			$_SESSION['msg'] = "Please fill all empty box..";
			$_SESSION['alert'] = "alert alert-danger"; 
		
		}
		else
		{
			if(isset($_POST['add_employee']))
			{
				$profileimagename = time() . '_' . $_FILES['profileimage']['name'];
				$username = $_POST['username'];
				$lastname = strtoupper($_POST['lname']);
				$firstname = strtoupper($_POST['fname']);
				$middlename = strtoupper($_POST['mname']);
				$number = $_POST['number'];
				$email = $_POST['email'];
				$address = strtoupper($_POST['address']);
				$password = md5($_POST['password']);
				$status = 'employee';
				$target = 'employee_picture/' . $profileimagename;
					if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
					{

						$connection = $this->openConnection();
						$stmt = $connection->prepare("INSERT INTO employee(`picture`,`username`,`password`,`lastname`,`firstname`,`middlename`,`number`,`email`,`address`,`status`) VALUES(?,?,?,?,?,?,?,?,?,?)");
						$run =$stmt->execute([$profileimagename,$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$status]);
						if ($run) {
							$_SESSION['msg'] = "Successfully Added..";
						
						}
					}
					else
					{
						$picture = 'user.png';
						$connection = $this->openConnection();
						$stmt = $connection->prepare("INSERT INTO employee(`picture`,`username`,`password`,`lastname`,`firstname`,`middlename`,`number`,`email`,`address`,`status`) VALUES(?,?,?,?,?,?,?,?,?,?)");
						$run =$stmt->execute([$picture,$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$status]);
						if ($run) {
							$_SESSION['msg'] = "Successfully Added..";
						
						}
					}

			}

		}
	}	

		public function getuser()
		{
			$connection = $this->openConnection();
			$stmt = $connection->prepare("SELECT * FROM manager");
			$stmt->execute();
			$users = $stmt->fetchAll();
			$userCount = $stmt->rowCount();
			if ($userCount > 0)
			{
				return $users;
			}
			else
			{
				return 0;
			}
		}

//employee table
	public function manager_table()
	{
		$connection = $this->openConnection();
		$stmt = $connection->prepare("SELECT * FROM `employee`");
		$stmt->execute();
						
		while($fetch = $stmt->fetch())
		{
?>
 
			<tr>
			<td><?php echo "<img class='png' src='fonts/".$fetch['picture']."' >"?></td>
			<td><?php echo $fetch['username']?></td>
			<td><?php echo $fetch['lastname']?></td>
			<td><?php echo $fetch['firstname']?></td>
			<td><?php echo $fetch['middlename']?></td>
			<td><?php echo $fetch['number']?></td>
			<td><?php echo $fetch['email']?></td>
			<td><?php echo $fetch['address']?></td>
			<td><?php echo $fetch['password']?></td>
			<td><button>edit</button><button>delete</button></td>
		</tr>
 
<?php	
		}

	}
	//add new manager
	public function add_manager()
	{
		if(isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$lastname = $_POST['lname'];
			$firstname = $_POST['fname'];
			$middlename = $_POST['mname'];
			$number = $_POST['number'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$address = $_POST['address'];
			$status = 'manager';
			$connection = $this->openConnection();
			$stmt = $connection->prepare("INSERT INTO manager(`username`,`password`,`lastname`,`firstname`,`middlename`,`number`,`email`,`address`,`manager`) VALUES(?,?,?,?,?,?,?,?)");
			$stmt->execute([$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$status]);
		}
	}
	public function add_employee()
	{
		if(isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$lastname = $_POST['lname'];
			$firstname = $_POST['fname'];
			$middlename = $_POST['mname'];
			$number = $_POST['number'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$address = $_POST['address'];
			$connection = $this->openConnection();
			$stmt = $connection->prepare("INSERT INTO manager(`username`,`password`,`lastname`,`firstname`,`middlename`,`number`,`email`,address) VALUES(?,?,?,?,?,?,?,?)");
			$stmt->execute([$username,$password,$lastname,$firstname,$middlename,$number,$email,$address]);
		}
	}
	
	public function delete_manager_data()
	{
		if (isset($_POST['delete'])) 
		{
			$connection = $this->openConnection();
			$id = $_POST['delete'];
			$dquery = "DELETE FROM employee WHERE id =?";
			$stmt = $connection->prepare($dquery);
			if ($stmt->execute([$id])) 
			{
				$_SESSION['message'] = "Selected record is Successfully Deleted..";
				$_SESSION['alerts'] = "alert alert-danger"; 
			}
		}
	}
	public function delete_employee_data()
	{
		if (isset($_POST['delete'])) 
		{
			$connection = $this->openConnection();
			$id = $_POST['delete'];
			$dquery = "DELETE FROM employee WHERE id =?";
			$stmt = $connection->prepare($dquery);
			if ($stmt->execute([$id])) 
			{
				$_SESSION['message'] = "Selected record is Successfully Deleted..";
				$_SESSION['alerts'] = "alert alert-danger"; 
			}
		}
	}
	
		public function update_user_data()
		{
		if (isset($_POST['update_user_info'])) 
		{
			$employee_id = $_POST['id'];
			$picture = time() . '_' . $_FILES['profileimage']['name'];
			$username = $_POST['username'];
		    $lastname = strtoupper($_POST['lname']);
		    $firstname = strtoupper($_POST['fname']);
		    $middlename = strtoupper($_POST['mname']);
		    $number = $_POST['number'];
		    $email = $_POST['email'];
		    $address = strtoupper($_POST['address']);
		    $password = md5($_POST['password']);
	     	$target = 'employee_picture/' . $picture;
	    
		    if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
			{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `employee` SET picture=?,username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?,access='employee'  WHERE id = ?");
		 	   $run= $stmt->execute([$picture,$username,$lastname,$firstname,$middlename,$number,$email,$address,$password,$employee_id]);
		    	if ($run) 
		    	{
		    		$_SESSION['message'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
				}
		  	}
		  	else
		  	{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `employee` SET username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?  WHERE id = ?");
		 	   $run= $stmt->execute([$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$employee_id]);
		    	if ($run) 
		    	{
		    		$_SESSION['message'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
				}			  
		  	}
		}
	}

		public function update_manager_data()
		{

		if (isset($_POST['update_manager'])) 
		{
			$employee_id = $_POST['id'];
			$picture = time() . '_' . $_FILES['profileimage']['name'];
			$username = $_POST['username'];
		    $lastname = strtoupper($_POST['lname']);
		    $firstname = strtoupper($_POST['fname']);
		    $middlename = strtoupper($_POST['mname']);
		    $number = $_POST['number'];
		    $email = $_POST['email'];
		    $address = strtoupper($_POST['address']);
		    $password = md5($_POST['password']);
	     	$target = 'employee_picture/' . $picture;
	    
		    if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
			{
				$connection = $this->openConnection();

			    $stmt = $connection->prepare("UPDATE `manager` SET picture=?,username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?  WHERE id = ?");
		 	   $run= $stmt->execute([$picture,$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$employee_id]);
		    	if ($run) 
		    	{
		    		$_SESSION['employee_updated'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
					header("location:manager.php");
		    		
				}
		  	}
		  	else
		  	{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `manager` SET username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?  WHERE id = ?");
		 	   $run= $stmt->execute([$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$employee_id]);
		    	if ($run) 
		    	{

		    		$_SESSION['employee_updated'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
					header("location:manager.php");
		    		
				}			  
		  	}
		}
	}

	public function update_manager_datas()
		{

		if (isset($_POST['update_manager'])) 
		{
			$employee_id = $_POST['id'];
			$picture = time() . '_' . $_FILES['profileimage']['name'];
			$username = $_POST['username'];
		    $lastname = strtoupper($_POST['lname']);
		    $firstname = strtoupper($_POST['fname']);
		    $middlename = strtoupper($_POST['mname']);
		    $number = $_POST['number'];
		    $email = $_POST['email'];
		    $address = strtoupper($_POST['address']);
		    $password = md5($_POST['password']);
	     	$target = '../employee_picture/' . $picture;
	    
		    if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
			{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `manager` SET picture=?,username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?,access='employee'  WHERE id = ?");
		 	   $run= $stmt->execute([$picture,$username,$lastname,$firstname,$middlename,$number,$email,$address,$password,$employee_id]);
		    	if ($run) 
		    	{
		    		$_SESSION['employee_updated'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
					header("location:employee.php");
		    		
				}
		  	}
		  	else
		  	{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `manager` SET username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?  WHERE id = ?");
		 	   $run= $stmt->execute([$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$employee_id]);
		    	if ($run) 
		    	{

		    		$_SESSION['employee_updated'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
					header("location:employee.php");
		    		
				}			  
		  	}
		}
	}
	
	public function update_employee_data()
		{

		if (isset($_POST['update_employee'])) 
		{
			$employee_id = $_POST['id'];
			$picture = time() . '_' . $_FILES['profileimage']['name'];
			$username = $_POST['username'];
		    $lastname = strtoupper($_POST['lname']);
		    $firstname = strtoupper($_POST['fname']);
		    $middlename = strtoupper($_POST['mname']);
		    $number = $_POST['number'];
		    $email = $_POST['email'];
		    $address = strtoupper($_POST['address']);
		    $password = md5($_POST['password']);
	     	$target = '../employee_picture/' . $picture;
	    
		    if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
			{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `employee` SET picture=?,username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?,access='employee'  WHERE id = ?");
		 	   $run= $stmt->execute([$picture,$username,$lastname,$firstname,$middlename,$number,$email,$address,$password,$employee_id]);
		    	if ($run) 
		    	{
		    		$_SESSION['employee_updated'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
					header("location:employee.php");
		    		
				}
		  	}
		  	else
		  	{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `employee` SET username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?  WHERE id = ?");
		 	   $run= $stmt->execute([$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$employee_id]);
		    	if ($run) 
		    	{

		    		$_SESSION['employee_updated'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
					header("location:employee.php");
		    		
				}			  
		  	}
		}
	}

	public function update_employee_profile()
		{

		if (isset($_POST['update_employee'])) 
		{
			$employee_id = $_POST['id'];
			$picture = time() . '_' . $_FILES['profileimage']['name'];
			$username = $_POST['username'];
		    $lastname = strtoupper($_POST['lname']);
		    $firstname = strtoupper($_POST['fname']);
		    $middlename = strtoupper($_POST['mname']);
		    $number = $_POST['number'];
		    $email = $_POST['email'];
		    $address = strtoupper($_POST['address']);
		    $password = md5($_POST['password']);
	     	$target = '../employee_picture/' . $picture;
	    
		    if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
			{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `employee` SET picture=?,username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?  WHERE id = ?");
		 	   $run= $stmt->execute([$picture,$username,$lastname,$firstname,$middlename,$number,$email,$address,$password,$employee_id]);
		    	if ($run) 
		    	{
		    		$_SESSION['employee_updated'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
					header("location:user_profile.php");
		    		
				}
		  	}
		  	else
		  	{
				$connection = $this->openConnection();
			    $stmt = $connection->prepare("UPDATE `employee` SET username=?,password=?,lastname=?,firstname=?,middlename=?,`number`=?,email=?,address=?  WHERE id = ?");
		 	   $run= $stmt->execute([$username,$password,$lastname,$firstname,$middlename,$number,$email,$address,$employee_id]);
		    	if ($run) 
		    	{

		    		$_SESSION['employee_updated'] = "Selected record is Successfully Updated..";
					$_SESSION['alerts'] = "alert alert-danger"; 
					header("location:user_profile.php");
		    		
				}			  
		  	}
		}
	}


	public function update_store_data()
		{

		if (isset($_POST['update_store_info'])) 
		{
			$id = $_POST['id'];
			$storename = strtoupper($_POST['store_name']);
			$street = strtoupper($_POST['street']);
			$barangay = strtoupper($_POST['barangay']);
			$municipality = strtoupper($_POST['municipality']);
			$province = strtoupper($_POST['province']);
			$near = strtoupper($_POST['near']);
			$connection = mysqli_connect("localhost","root","","storenewdb");
  
                $stmt = $connection->prepare("UPDATE `store_details` SET `store_name`=?,`store_street`=?,`store_brgy`=?,`store_municipality`=?,`store_province`=?,`near_to`=?  WHERE id = ?");
		 	   $run= $stmt->execute([$storename,$street,$barangay,$municipality,$province,$near,$id]);
		    	if ($run) 
		    	{
		    	
						$_SESSION['messages'] = "Product Added Successfully!";

				}
				else
				{
					echo "update failed";
				}
		  	
		  }
	}
}


$store = new MyStore();


?>