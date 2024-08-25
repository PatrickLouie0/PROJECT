<?php  
$msg = "";
$css_class = "";
if (isset($_POST['submit'])) 
{
echo "<pre>",print_r($_FILES['profileimage']['name']),"</pre>";
$bio = $_POST['bio'];
$profileimagename = time() . '_' . $_FILES['profileimage']['name'];

$target = 'image/' . $profileimagename;
if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
{

$msg = "image uploaded";
$css_class = "alert-success";
}
else
{
$msg = "failed to upload";
$css_class = "alert-danger";
}
}
?>