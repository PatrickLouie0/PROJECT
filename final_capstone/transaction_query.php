
<?php
class MyStore
{
    private $server = "mysql:host=localhost;dbname=storenewdb";
    private $user = "root";
    private $pass= "";
    //PDO CONFIGURATION
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC);
    protected $con;
    public function openConnection()
    {
          try
          {
               $this->con = new PDO($this->server,$this->user,$this->pass,$this->options);
               return $this->con; 
          }
          catch(PDOException $e)
          {
               echo "There is some problem in the connection:".$e->getMessage();
          }
    }
     public function closeConnection()
     {
      $this->con = null;
     }
     public function add_in_transaction_total()
     {

     /* stotal
      discount
      total
      payment
      change*/
      $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "storedb";
        $connection = mysqli_connect($servername,$username,$password,$dbname);

      if (isset($_POST['submitpayment'])) 
      {
        $subtotal = $_POST['stotal'];
        $discount = $_POST['discount'];
        $total = $_POST['total'];
        $payment = $_POST['payment'];
        $change = $_POST['change'];   

        $stmt = ("INSERT INTO transaction_total(transaction_id,discount,total,payment,changes) VALUES($subtotal,$discount,$total,$payment,$change)");
        if(mysqli_query($connection,$stmt))
        {
            $query = "SELECT transaction_id FROM transaction_total ORDER BY transaction_id DESC";
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($result);
            $lastid = $row['transaction_id'];

            if(empty($lastid))
            {
                $number = "Customer-00000001";
            }
            else
            {
                $idd = str_replace("Customer-", "", $lastid);
                $id = str_pad($idd + 1, 7, 0, STR_PAD_RIGHT);
                $number = 'Customer-'.$id;
            }

        }
        else
        {
          echo "need input";
        }
      }
      else
      {
        echo "Record Faileddd";
      }
    

      }

     
     public function add_product_transaction()
     {
      $productquan='';

          if(isset($_POST['submit_product']))
          {
            if (empty($_POST['productname'])) {
                   $_SESSION['empty'] = "Product Required!";
           
            }
            else
            {
            $prod_id = $_POST['prod_id'];
            $transaction_id = $_POST['transaction_id'];
             $productcode = strtoupper($_POST['productcode']);
             $productname = strtoupper($_POST['productname']);
             $productcolor = strtoupper($_POST['productcolor']);
             $productsize = strtoupper($_POST['productsize']);
             $productclass = strtoupper($_POST['productclass']);
             $productcategory = strtoupper($_POST['productcategory']);
             $productquantity = $_POST['productquantity'];
             $productprice = $_POST['productprice'];
             $productquantity = $_POST['productquantity'];
             $productdiscount = $_POST['discount'];
             $subtotal = $_POST['productsubtotal'];
             $total = $_POST['totals'];
             $connection = $this->openConnection();
             $con = mysqli_connect("localhost","root","","storenewdb");
             $query = "SELECT * FROM available_product WHERE product_code = 'product_code' AND product_color = 'product_color' AND product_size = '$productsize';";
             $sql_run = mysqli_query($con,$query);
             while ($run = mysqli_fetch_assoc($sql_run)) {
                $productquan = $run['product_quantity'];
             }
             if ($productquantity>= $productquan) {
               # code...
             
               $stmt = $connection->prepare("INSERT INTO transaction(`product_id`,`transaction_id`,`product_code`,`product_name`,`product_color`,`product_size`,`product_price`,`product_quantity`,`sub_total`,`discount`,`total`,`product_brand`,`product_category`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
             $run =$stmt->execute([$prod_id,$transaction_id,$productcode,$productname,$productcolor,$productsize,$productprice,$productquantity,$subtotal,$productdiscount,$total,$productclass,$productcategory]);
             if ($run) 
             {
                $_SESSION['add_product'] = "Item Added Successfully";
             }
             else
             {
               echo "failed";
             }
           }
           else
           {
            $_SESSION['low_quantity'] = "low quantity";
           }
          }
        }
     }
     public function update_product_transaction()
     {
          if(isset($_POST['edits']))
          {
            $id = $_POST['id'];
             $productcode = $_POST['productcode'];
             $productname = $_POST['productname'];
             $productcolor = $_POST['productcolor'];
             $productsize = $_POST['productsize'];
             $productclass = $_POST['productclass'];
             $productcategory = $_POST['productcategory'];
             $productquantity = $_POST['productquantity'];
             $productprice = $_POST['productprice'];
             $productdiscount = $_POST['discount'];
             $subtotal = $_POST['productsubtotal'];
             $total = $_POST['totals'];
             $connection = $this->openConnection();
               $sql = "UPDATE transaction SET `product_code`=?,`product_name`=?,`product_color`=?,`product_size`=?,`product_price`=?,`product_quantity`=?,`sub_total`=?,`discount`=?,`total`=?,`product_brand`=?,`product_category`=? WHERE id=?";
              $stmt= $connection->prepare($sql);
              $stmt->execute([$productcode,$productname,$productcolor,$productsize,$productprice,$productquantity,$subtotal,$productdiscount,$total,$productclass,$productcategory, $id]);

             if ($stmt) {
                  # code...
                $_SESSION['update_item'] = "Item was Updated";
             }
             else
             {
               echo "failed";
             }
          }
     }
     
     public function end_of_transaction()
     {
               $success = "";
          if (isset($_POST['submitpayment'])) 
          {
            if ($_POST['total']> $_POST['payment']) {
          $_SESSION['payment-not-enough'] = "payment-not-enough";
          }
          else
          {

           //    $total = $_POST['total'];
           //    $payment = $_POST['discount'];
           //    $change = $_POST['change'];
               $connection = $this->openConnection();
               $stmt = $connection->prepare("INSERT INTO success_transaction( `product_id`,`transaction_id`,`product_name`, `product_code`, `product_color`, `product_size`, `product_brand`, `product_category`,  `product_price`,`product_quantity`,`sub_total`, `discount`, `total`) 
                    SELECT `product_id`,`transaction_id`,`product_name`,`product_code`,`product_color`,`product_size`,`product_brand`,`product_category`,`product_price`,`product_quantity`,`sub_total`,`discount`,`total`FROM transaction");
               $run = $stmt->execute();

                if ($run)
              {
                 $transac_id = $_POST['id'];
                 $prodcode = '';
                 $prodcolor = '';
                 $prodsize = '';
                $connect = mysqli_connect("localhost","root","","storenewdb");
                # code...
                $query = ( "SELECT product_code,product_color,product_size,SUM(product_quantity) as productquantity FROM `transaction` WHERE `transaction_id` = '$transac_id' group by product_code,product_color,product_size");
                $query_run = mysqli_query($connect,$query);
                if(mysqli_num_rows($query_run) > 0)
                {
                 while ($res = mysqli_fetch_array($query_run))
                  {    
                    $prodcode = $res['product_code'];
                    $prodquantity = $res['productquantity'];
                    $prodsize = $res['product_size'];
                    $prodcolor = $res['product_color'];
                  
                  $query_update = $connection->prepare("UPDATE available_product SET `product_quantity` = (product_quantity- $prodquantity) where (`product_code` = '$prodcode') AND ( `product_color` = '$prodcolor')AND( `product_size` = '$prodsize')"); 
                  $query_update_run = $query_update->execute();
                  }
                    if ($query_update_run)
                    {
                    $connection = $this->openConnection();
                    $stmt = $connection->prepare("TRUNCATE `transaction`");
                    $run = $stmt->execute();
                    if ($run) 
                    {
                      $_SESSION['complete'] = "transaction complete";
                    }
                    else
                    {
                      echo "failed";
                    }
                }
                  else
                  {
                    echo "failed ";
                  }
              }
              }
        }
       }
     }
   
  
     
 }
$store = new MyStore();
   
