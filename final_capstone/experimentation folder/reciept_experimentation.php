<?php
$con = mysqli_connect("localhost","root","","storenewdb");
  $gettransactionid = mysqli_query($con,"SELECT transaction_id as get_transaction_id FROM transaction_total group by transaction_id asc ");
          if (mysqli_num_rows($gettransactionid)) {
            while ($get_transactionid = mysqli_fetch_assoc($gettransactionid)) 
            {
             $retrieve_transaction_id = $get_transactionid['get_transaction_id'];
            }
          }

 echo "<table>";
        echo "<thead>";
        echo  "<tr>";
        echo "<th>id</th>
        
        <th>Code</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
       </tr>";
        echo "</thead>";
        echo "<tbody>";
          $gettransactionproduct = mysqli_query($con,"SELECT `transaction_id`, `product_name`, `product_code`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `product_price`, `sub_total`, `discount`, `total` FROM success_transaction where transaction_id = '$retrieve_transaction_id'  ");
          if (mysqli_num_rows($gettransactionproduct)) {
            while($gettransaction_product = mysqli_fetch_assoc($gettransactionproduct))
            {
          
           
        
        echo "<tr>";
        echo "<td>".$gettransaction_product['transaction_id']."</td>";
        echo "<td>".$gettransaction_product['product_code']."</td>";
        echo "<td>".$gettransaction_product['product_name']."</td>";
        echo "<td>".$gettransaction_product['product_price']."</td>";
        echo "<td>".$gettransaction_product['product_quantity']."</td>";
        echo "<td>".$gettransaction_product['total']."</td>";
        echo "</tr>";
         }
          }
        echo "</tbody>";
        echo "</table";