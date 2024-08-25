<?php  
$msg = "";
$css_class = "";
$success = "";
if (isset($_POST['submit'])) 
{
$con = mysqli_connect("localhost","root","","store") or die("not connect");
$profileimagename = time() . '_' . $_FILES['profileimage']['name'];
$employeename = $_POST['name'];
$employeeaddress= $_POST['address'];
$employeenumber = $_POST['contact_num'];
$username = $_POST['Username'];
$password = $_POST['password'];

$target = 'image/' . $profileimagename;
if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
{
    $sql = "INSERT INTO `employee`( `picture`, `name`, `address`, `number`, `username`, `password`) VALUES ('$profileimagename','$employeename','$employeeaddress','$employeenumber','$username','password')";
  $result = mysqli_query($con,$sql);
  if ($result) {
    $success = "successfully";
  }

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