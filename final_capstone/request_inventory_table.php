 <div class="table-request">
  <br>

  <h1>Latest Product Stock Check</h1>
   <?php
      $db = mysqli_connect("localhost","root","","storenewdb");
        $sqli = "SELECT username,product_category FROM `check_stock` where cast(DATE(date_time) as date) = cast(curdate() as date) GROUP BY username,product_category";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            while ($get=mysqli_fetch_assoc($result)) {
    echo "<p style='margin-left:20px;margin-right:30px;color:blue;font-weight:bold'>Checked By ".$get['username']."</p>";
       }
     }
?> 
   <table id="mytable" >
    <thead>
      <tr>
        <th>Time</th>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>Color</th>
        <th>Size</th>
        <th>Brand</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Stock Count</th>
        <th>Missing</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $db = mysqli_connect("localhost","root","","storenewdb");
        $sqli = "SELECT `id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `check_quantity`, `date_time` as date_time,`date_time` as timess FROM `check_stock` where cast(DATE(date_time) as date) = cast(curdate() as date)  ORDER BY product_category DESC";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            while ($res=mysqli_fetch_assoc($result)) {
            $ts = $res['timess'];
            $ntimes = date('h:i:A',strtotime($ts));
       
              echo "
                <tr>
                <td>".$ntimes."</td>
                <td>".$res['product_code']."</td>
                <td>".$res['product_name']."</td>
                <td>".$res['product_color']."</td>
                <td>".$res['product_size']."</td>
                <td>".$res['product_brand']."</td>
                <td>".$res['product_category']."</td>
                <td>".$res['product_quantity']."</td>
                <td>".$res['check_quantity']."</td>
                <td>".$res['check_quantity']-$res['product_quantity']."</td>
              "; 
              ?>
              <?php
            }
          }
          else
          {
          }
          ?>

               </tr>
      
    </tbody>
  </table>
</div>

<div class="view_older">
<?php
   $db = mysqli_connect("localhost","root","","storenewdb");
     
$query = "SELECT `id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `check_quantity`,`username`, date(date_time) AS date_time FROM `check_stock` GROUP BY date(date_time),username,product_category ORDER BY date_time DESC;";    
  $result =$db->query($query);
  $result->fetch_All(MYSQLI_ASSOC);

  foreach ($result as $row) 
  {

   
      echo "<table style='margin-left:20px;margin-right:40px;margin-bottom:100px;color:black;font-weight:bold'>";

      echo "<thead>";
      echo "<tr>";
      echo "
         <tr>
        <th>Check</th>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>Color</th>
        <th>Size</th>
        <th>Brand</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Stock Count</th>
        <th>Missing</th>
      </tr>
    </thead>
    
      ";
      echo "</tr>";
            
            echo "<h2>Date:".$row['date_time']."</h2>";
      //  echo "<p>".$row['username']." is assign to check the category of </p>";
   
        $sql = "SELECT `id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `check_quantity`,username, date(date_time) AS date_times,date(date_time) AS date_time,time(date_time) as timi FROM `check_stock` GROUP BY time(date_time),username,product_category ORDER BY date_time DESC;";
          $results = mysqli_query($db,$sql);

  



    echo "<p style='margin-left:20px;color:blue;font-weight:bold'>Checked by:".$row['username']."-->".$row['product_category']."</p>";
              
   
               
          while ($res=mysqli_fetch_assoc($results)) 
          {



           $t = $res['timi'];
          $ntime = date('h:i:A',strtotime($t));
            if ( $res['date_time'] == $row['date_time'] && $res['username'] == $row['username'] && $res['product_category'] == $row['product_category'] ) 
            {
        # code...
       
              echo "  <tr>";
               echo "
               <tbody>
                <tr>
                <td>".$ntime."</td>
                <td>".$res['product_code']."</td>
                <td>".$res['product_name']."</td>
                <td>".$res['product_color']."</td>
                <td>".$res['product_size']."</td>
                <td>".$res['product_brand']."</td>
                <td>".$res['product_category']."</td>
                <td>".$res['product_quantity']."</td>
                <td>".$res['check_quantity']."</td>
                <td>".$res['check_quantity']-$res['product_quantity']."</td>
                </tbody>
              "; 
                  }


                } 

 
         
  } 
              echo "</table>";

                    
?>
</div>
