<?php
include_once('../folder/pms.php');
include_once('../header.php');
    $eid=$_SESSION['username'];
if($eid=="")
{
header('location:../login/login.php');
}
?>
<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="assets/css/table.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
     <link  rel = "icon" href ="../background/logo.png" type = "image x-icon">

 	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer=""></script>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  
	<title>PCMS</title>
	<style type="text/css">
		.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
			color: black;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active
		{
			color: black !important;
		}

.dataTables_wrapper .dataTables_filter input {
  color: black !important;
}
.dataTables_wrapper .dataTables_length select
{
	color: black !important;
}
		table,td,th
		{
			border:1px solid black !important;
			color: black !important;
		}
		
table.dataTable tbody tr {
  background-color: transparent;
}
		table
		{
			border-collapse: collapse;
		}
		.navbar-nav {
  			margin-left: auto;
		}
	</style>
</head>
<body style="background: url(../background/PINTEREST/pic4.jfif) center / cover no-repeat;height: 500px;">
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: black;margin-bottom: 10px;width: 100%;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../background/logo.png" style="width: 70px; height:50px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav" style="float: right;margin-right:30px;">
      <ul class="navbar-nav ms-auto" > 
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../main_event/mainevent.php" style="color: white;">Event</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="score.php" style="color: white;">Score</a>
        </li>
         
         <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
          Account
        </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="../profile/profile.php">Profie</a>
          <?php
            $id = $_SESSION['username'];
            

            if ($id == 2) {?><a class="dropdown-item" href="../add_account.php">Create Account</a>
              <?php
            }
            else{
            }
          ?>
          <a class="dropdown-item" href="../login/logout.php">Logout</a>
     </div>
      </li>
      </ul>
    </div>
  </div>
</nav>
<div style="width: 96%;margin-left: 20px;"> 
<table class="table table-bordered mt-1" style="" id="myTable" style="color: black; background-color:black">
	<thead>
		<tr  class="text-center">
			<th colspan="5" >Event Score</th>
		</tr>
		<tr>
			<th style="width: 3%;text-align: center;">No</th>
			<th style="width: 10%">ID</th>
			<th style="width: 10%;">Name</th>
			<th style="width: 10%">Date</th>
			<th style="width: 2%;text-align: center;">Action</th>
		</tr>
	</thead>
	<tbody >
		<?php
			$no = 1;
			$ids = $_SESSION['username'];
			$con = mysqli_connect("localhost","root","","pms") or die();
			$stmt = mysqli_query($con,"SELECT e.event_name,e.event_id,e.event_date_start,e.event_time_start FROM event e
INNER JOIN main_event  
ON e.main_event_id = main_event.main_event_id AND main_event.user_id = '$ids';");
			if (mysqli_num_rows($stmt)>0) {
				while ($res = mysqli_fetch_assoc($stmt)) {
					?>
		<tr>
			<td style="text-align: center;"><?= $no++?></td>
			<td><?=$res['event_id']?></td>
			<td><?=$res['event_name']?></td>
			<td><?=$res['event_date_start'].'/'.$res['event_time_start']?></td>
			<td style="text-align: center;"><a href="allscore.php?event_id=<?=$res['event_id']?>"><i class="fa fa-eye" style="color: black"></i></a>
                    </td>
		</tr>


					<?php
				}
			}
		?>
	</tbody>
</table>
</div>
</body>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
</html>