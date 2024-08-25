<?php
//fetch.php
if(isset($_POST["query"]))
{
 $connect = mysqli_connect("localhost", "root", "", "store");
 $request = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = " SELECT * FROM product
  WHERE productcode LIKE '%".$request."%' 
  OR productcolor LIKE '%".$request."%' 
  OR productsize LIKE '%".$request."%'
 ";
 $result = mysqli_query($connect, $query);
 $data =array();
 $html = '';
 $html .= '
  <table class="table table-bordered table-striped">
   <tr>
    <th>productcode</th>
    <th>productcolor</th>
    <th>productsize</th>
   </tr>
  ';
 if(mysqli_num_rows($result) )
 {
  while($row = mysqli_fetch_array($result))
  {
   $data[] = $row["productcode"];
   $data[] = $row["productcolor"];
   $data[] = $row["productsize"];
   $html .= '
   <tr>
    <td>'.$row["productcode"].'</td>
    <td>'.$row["productcolor"].'</td>
    <td>'.$row["productsize"].'</td>
   </tr>
   ';
  }
 }
 else
 {
  $data = 'No Data Found';
  $html .= '
   <tr>
    <td colspan="3">No Data Found</td>
   </tr>
   ';
 }
 $html .= '</table>';
 if(isset($_POST['typehead_search']))
 {
  echo $html;
 }
 else
 {
  $data = array_unique($data);
  echo json_encode($data);
 }
}
header('location:../transaction.php');
?>
