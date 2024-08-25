<?php
$conne = mysqli_connect("localhost","root","","storenewdb");
$get_storename = "SELECT store_name from store_details where id = '1'";
$run_storename = mysqli_query($conne,$get_storename);
if (mysqli_num_rows($run_storename)) {
	while ($getstorename = mysqli_fetch_assoc($run_storename)) {
		$stname = $getstorename['store_name'];
		echo $stname;
	}
}
?>