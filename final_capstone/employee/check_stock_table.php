 <style type="text/css">
   .con{
    width: 100%; background-color: #f5f5f5;  
   }
   @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  .con{
    font-size: 10px;
    width: 100%;
  }
}
@media only screen and (max-width: 668px) {
  /* For mobile phones: */
  th{
    font-size: 9px;
    margin: 0px;
}
}

@media only screen and (max-width: 668px) {
  /* For mobile phones: */
  td{
    font-size: 9px;
    margin: 0px;
    text-align: center;
}
}

@media only screen and (max-width: 668px) {
  /* For mobile phones: */
  td input{
    width: 30px;
}
td input[type="text"]
{
  width: 30px;
}
}
@media only screen and (max-width: 760px) {
  /* For mobile phones: */
  td input{
    width: 30px;
}
td input[type="text"]
{
  width: 30px;
}
}


@media only screen and (max-width: 600px) {
  /* For mobile phones: */
 
td input[type="text"]
{
  width: 30px;
}
}

@media only screen and (max-width: 760px) {
  /* For mobile phones: */
  td input{
    width: 30px;
}
@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  .con{
    width: 100%;
    
  }
}
.con
{
  width: 100%;
  height: 50%;
}
}
td{
 text-align: center;
}
th{
  text-align: center;
}
   .num {
  width: 80px ;
}
 </style>  
 <div class="con">
    <br><br>
   
   <table id="mytable" style="text-align: left;">
    <thead>
      <tr>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>Color</th>
        <th>Size</th>
        <th>Brand</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>check Quantity</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
    $getusername  = $_SESSION['usernames'];  
        
      $db = mysqli_connect("localhost","root","","storenewdb");

        $sqli = "SELECT `id`, `barcode`, `barcode_con`, `product_picture`, `product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `product_cost`, `product_added_price`, `product_new_price`, `check_stock_status`, `date_time` FROM available_product where check_stock_status = '1' AND checkby = '$getusername' ORDER BY id ASC";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            while ($res=mysqli_fetch_assoc($result)) {

              echo "
                <tr>

                <td>".$res['product_code']."</td>
                <td>".$res['product_name']."</td>
                <td>".$res['product_color']."</td>
                <td>".$res['product_size']."</td>
                <td>".$res['product_brand']."</td>
                <td>".$res['product_category']."</td>
                <td>".$res['product_quantity']."</td>
                
                
              "; 
              ?>
              <form action="check_stock_done.php" method="POST">
              <td><input class="num" type='number' name='check_quantity' required="">
                  <input type="text" name="id" value="<?php echo $res['id']; ?>" style="display: none;" >
              </td>

              <td><button type="submit" name="submit">DONE</button></td>
              </form>
              <?php
            }
          }?>

               </tr>
      
    </tbody>
  </table>

</div>