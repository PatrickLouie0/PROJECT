   <!DOCTYPE html>
   <html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style type="text/css">
         
         img{
            width:160px;
             border-radius:2px;
              margin-bottom:10px;
               height: 150px;
                margin-left:10px; 
         }
         .info{
         columns: 2 ;
          font-size: 10px;
          margin-left:10px;
          }

 @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  .info{
   columns: 2;
font-size: 5px; 
margin-right: 20px; 
  }
}
  @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  img{
  width:90px;
  border-radius:2px;
  margin-bottom:10px;
  height: 90px;
  margin-left:10px; 
  
  }
}
      </style>
   </head>
   <body>
   
  
    <?php
    $connect = mysqli_connect("localhost", "root", "", "storenewdb");
    $output = '';
    $stocks = '';
    $check_stock = '';
    if(isset($_POST["query"]))
    {
       $search = mysqli_real_escape_string($connect, $_POST["query"]);
       $query = "SELECT * FROM available_product WHERE product_code LIKE '%".$search."%' OR product_name LIKE '%".$search."%' OR product_category LIKE '%".$search."%' OR product_brand LIKE '%".$search."%'";
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

          <div  class="card"> 
          <h3 >'.$res['product_code'].'
          </h3>

      '.$stocks.'
          <br>

          <div class="image" >
          <center><img src=../product_picture/'.$res['product_picture'].'>
          </div>    

          <div class="info">
        
          <h3>Name:'.$res['product_name'].'</h3>
          <h3>Category:'.$res['product_category'].'</h3>    
          <h3>Color:'.$res['product_color'].'</h3>
          <h3>Size:'.$res['product_size'].'</h3>
          <h3>Quantity:'.$res['product_quantity'].'<h3>
          <h3>Class:'.$res['product_brand'].'</h3>
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
 </body>
   </html>
