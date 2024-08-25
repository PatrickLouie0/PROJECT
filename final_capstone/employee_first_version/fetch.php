    <?php
    $connect = mysqli_connect("localhost", "root", "", "storenewdb");
    $output = '';
    $stocks = '';
    $check_stock = '';
    if(isset($_POST["query"]))
    {
       $search = mysqli_real_escape_string($connect, $_POST["query"]);
       $query = "SELECT * FROM available_product WHERE product_code LIKE '%".$search."%' OR product_name LIKE '%".$search."%' OR product_category LIKE '%".$search."% OR product_brand LIKE '%".$search."%'";
    }
    else
    {
       $query = "
       SELECT * FROM available_product ORDER BY product_category";
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
          margin-left:1px;
          margin-bottom: 80px;
          height: 360px;
          width: 350px;
          background-color: white;
          " > 
          <h3 >'.$res['product_code'].'
          </h3>

      '.$stocks.'
          <br>

          <div class="image" >
          <img src=../product_picture/'.$res['product_picture'].' style="width:160px; border-radius:2px; margin-bottom:10px; height: 150px; margin-left:10px; "
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
          <h3>Class:'.$res['product_brand'].'</h3>
          <h3>Category:<br>'.$res['product_category'].'</h3>
          <h3>Price:'.$res['product_new_price'].'</h3>
      </div>
    
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
