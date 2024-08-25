    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "store";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    ?>
 
    <?php
        $query2 = "select * from customer order by cus_id desc limit 1";
        $result2 = mysqli_query($conn,$query2);
        $row = mysqli_fetch_array($result2);
        $last_id = $row['cus_id'];
        if ($last_id == "")
        {
            $customer_ID = "CUSTOMER1";
        }
        else
        {
            $customer_ID = substr($last_id, 3);
            $customer_ID = intval($customer_ID);
            $customer_ID = "CUSTOMER" . ($customer_ID +1);
        }
    ?>