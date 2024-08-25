<?php
$id = '';
//fetch.php
$connect = new PDO("mysql:host=localhost;dbname=storenewdb", "root", "");

$column = array('product_code', 'product_name', 'product_color', 'product_size', 'product_category', 'product_class');

$query = "SELECT * FROM available_product ";

if(isset($_POST['search']['value']))
{
 $query .= '
 WHERE product_code LIKE "%'.$_POST['search']['value'].'%" 
 OR product_name LIKE "%'.$_POST['search']['value'].'%" 
 OR product_color LIKE "%'.$_POST['search']['value'].'%" 
 OR product_size LIKE "%'.$_POST['search']['value'].'%" 
 OR product_category LIKE "%'.$_POST['search']['value'].'%" 
 OR product_class LIKE "%'.$_POST['search']['value'].'%" 
 ';
}

if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST['length'] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $id = $row['id'];
 $sub_array = array();
 $sub_array[] = $row['product_code'];
 $sub_array[] = $row['product_name'];
 $sub_array[] = $row['product_color'];
 $sub_array[] = $row['product_size'];
 $sub_array[] = $row['product_category'];
 $sub_array[] = $row['product_class'];
 $sub_array[] = $row['product_cost'];
 $sub_array[] = $row['product_quantity'];
 $sub_array[] = $row['product_new_price'];
             ;
             
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM available_product";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'    => intval($_POST['draw']),
 'recordsTotal'  => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'    => $data
);

echo json_encode($output);

?>