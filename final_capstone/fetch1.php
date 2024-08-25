  <?php
  $connect = mysqli_connect("localhost", "root", "", "storedb");
    if (isset($_POST['edit'])) 
    {
        $mysql = "INSERT INTO request_product (`id`, `productpicture`, `productcode`, `productname`, `productcolor`, `productsize`, `productclass`, `productcategory`, `productquantity`, `productprice`, `productaddedprice`, `productnewprice`, `date`)
        SELECT column1, column2, column3, ...
        FROM table1
        WHERE condition";
    }

     ?>
    <?php
    $connect = mysqli_connect("localhost", "root", "", "storedb");
    $output = '';
    if(isset($_POST["query"]))
    {
       $search = mysqli_real_escape_string($connect, $_POST["query"]);
       $query = "SELECT * FROM available_product WHERE product_code LIKE '%".$search."%' OR product_name LIKE '%".$search."%'";
    }
    else
    {
       $query = "
       SELECT * FROM available_product ORDER BY id";
    }
      $querys = "SELECT product_quantity from available_product";

      $result = mysqli_query($connect, $query);
      $results = mysqli_query($connect, $querys);
      $row = mysqli_fetch_array($results);
      $quantity = $row['product_quantity'];
      


      if(mysqli_num_rows($result) > 0)
      { 
         while($res = mysqli_fetch_array($result))
        {

         $output .= '
          <div  class="card" 
          style=" 
          margin-left:20px;
          margin-bottom: 80px;
          height: 310px;
          width: 240px;
          background-color: white;
          " > 
          <form method="POST" action="viewproduct1.php">
          <h3 >'.$res['product_code'].'
          <Button type="submit" name = "request" value="'.$res['id'].'" style="width: 60px;height: 20px;
          background-color: #4CAF50;
          color: white;
          border: none;
          border-radius: 4px;">Request</button>
          </h3>

          <br>

          </form>
          <div class="image" >
          <img src=product_picture/'.$res['product_picture'].' style="width:200px;   height: 130px; margin-left:10px; "
          >
          </div>    
          <div class="info"
          style="columns: 2 ;
          font-size: 10px;
          margin-left:20px;
          " >
        
          <h3>Name:<br>'.$res['product_name'].'</h3>
          <h3>Color:'.$res['product_color'].'</h3>
          <h3>Size:'.$res['product_size'].'</h3>
          <h3>Quantity:'.$res['product_quantity'].'<h3>
          <h3>Class:'.$res['product_class'].'</h3>
          <h3>Category:<br>'.$res['product_category'].'</h3>
          <h3>Price:'.$res['product_new_price'].'</h3>
      </div>
       </div>
  </div>
   ';
  
}
echo $output;
}

else
{
 echo 'Data Not Found';
}

?>           
