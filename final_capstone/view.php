<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
    
        button{
        width: 90px;
        margin: 10px;
        }
        table{
            text-align: center;
            margin: 40px;
        }
       th{
        padding: 20px;
        font-size: 30px;
       }
       header
{
  display: flex;
  align-content: center;
  background-color: #034f84;
  height: 50px;
  width: 100%;
}
    </style>
    <title></title>
</head>

<header>
  </header>
<body>
<center><h1>Notifications</h1>

<?php
 define('DBINFO', 'mysql:host=localhost;dbname=storedb');
    define('DBUSER','root');
    define('DBPASS','');

    function fetchAll($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }
    function performQuery($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
     
    $id = abs($_GET['id']);
    $stock = '';
    $productcode = '';
    $productcolor = '';
    $productsize = '';
    $storename = '';
    $query ="UPDATE `request_of_other_store` SET `status` = '1' WHERE `id` = $id;";
    performQuery($query);

    $query = "SELECT * from `request_of_other_store` where `id` = '$id';";
    if(count(fetchAll($query))>0){
        foreach(fetchAll($query) as $res){
            $stock = $res['product_quantity'];
            $productcode = $res['product_code'];
            $productcolor = $res['product_color'];
            $productsize = $res['product_size'];
            $storename = $res['store_name'];
            if($res['store_name']=='PLP DRYGOODS'){
                echo ucfirst($res['store_name'])." has requested a product. <br/>".$res['date_time']."<br>";

                
                echo "<table>

      <tr>
        <th>code</th>
        <th>name</th>
        <th>color</th>
        <th>size</th>
        <th>quantity</th>
        <th>price</th>
         <th>Action</th>
      </tr>
                <tr>
                <td>".$res['product_code']."</td>
                <td>".$res['product_name']."</td>
                   <td>".$res['product_color']."</td>
                <td>".$res['product_size']."</td>
                <td>".$res['product_quantity']."</td>
                <td>".$res['product_price']."</td>
                <form method='POST'>
                <td><button name ='approve'>APPROVE</button><button name='decline'>DECLINE</button></td>
                </form
      </table>"
  ;
            }else{
            }
        }
    }
    if (isset($_POST['approve'])) {
         $conn = mysqli_connect("localhost","root","","storedb");
         $conns = mysqli_connect("localhost","root","","storedb");
         $querys="UPDATE available_product SET `product_quantity` = (product_quantity+$stock) where (`product_code` = $productcode)AND( `product_color` = '$productcolor')"; 
         $runs = mysqli_query($conn,$querys);   
        if($runs)
        {
            echo "successfully transfered to $storename";
            $quer="UPDATE available_product SET `product_quantity` = (product_quantity-$stock) where (`product_code` = $productcode)AND( `product_color` = '$productcolor')"; 


            $que = "INSERT INTO `successfully_transfer_to_other_store`( `product_code`, `product_name`, `product_color`, `product_size`, `product_quantity`) SELECT `product_code`, `product_name`, `product_color`, `product_size`, `product_quantity` FROM request_of_other_store limit 1";
             mysqli_query($conns,$que);
             mysqli_query($conns,$quer);
            
        }  

    }
    else
    {
        echo "data doest exist anymore";
    }

?><br/>
<a href="viewproduct.php">Back</a>
</body>
</html>
