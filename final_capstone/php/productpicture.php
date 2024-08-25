
<?php
$db = mysqli_connect("localhost","root","","store");
$image = stripslashes($_REQUEST[productpicture]);
$rs = mysql_query("select * store where productpicture=\"".
addslashes($image).".jpg\"");
$row = mysql_fetch_assoc($rs);
$imagebytes = $row[imgdata];
header("Content-type: image/jpeg");