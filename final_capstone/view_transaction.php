<?php
$date = '';
$name = '';
$casher_name = '';
$store_name = '';
$store_street = '';
$store_brgy = '';
$store_municipality = '';
$store_province = '';
$store_near_to = '';
$transaction_total = '';
$transaction_discount = '';
$transaction_sub_total = '';
$db = mysqli_connect("localhost","root","","storenewdb");
 $transaction_id = mysqli_real_escape_string ( $db, $_GET['id']);

        $sqli = "SELECT DATE(transaction_total.date_time) AS date_time,transaction_total.total,transaction_total.discount,transaction_total.sub_total,transaction_total.customer_name,transaction_total.casher,
        store_details.store_name,
        store_details.store_street,
        store_details.store_brgy,
        store_details.store_municipality,
        store_details.store_province,
        store_details.near_to 
        FROM transaction_total,store_details WHERE transaction_total.transaction_id='$transaction_id'";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
            while ($res=mysqli_fetch_assoc($result)) {
            $date = $res['date_time'];
            $name = $res['customer_name'];
            $casher_name = $res['casher'];
            $store_name = $res['store_name'];
            $store_street = $res['store_street'];
            $store_brgy = $res['store_brgy'];
            $store_municipality = $res['store_municipality'];
            $store_province = $res['store_province'];
            $store_near_to = $res['near_to'];
            $transaction_total = $res['total'];
            $transaction_discount = $res['discount'];
            $transaction_sub_total = $res['sub_total'];
          }
             ?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     
  <script src="javascript/pdf-kendo.js"></script>
<style type="text/css">
  .customers {
  text-align: center;
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 90%;
  margin-left: 65px;
}

.customers td, .customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

.customers tr:nth-child(even){background-color: #f2f2f2;}


.customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color:#034f84;
  color: white;
}
 .btn {
    padding: 1em 2.1em 1.1em;
    border-radius: 3px;
    color: #fbdedb;
    display: inline-block;
    background: #45a049;
    -webkit-transition: 0.3s;
    -moz-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 1.3s;
    font-family: sans-serif;
    font-size: .85em;
    text-transform: uppercase;
    text-align: center;
    text-decoration: none;
    -webkit-box-shadow: 0em -0.3rem 0em rgba(0, 0, 0, 0.1) inset;
    -moz-box-shadow: 0em -0.3rem 0em rgba(0, 0, 0, 0.1) inset;
    box-shadow: 0em -0.3rem 0em rgba(0, 0, 0, 0.1) inset;
    position: relative;
}
.btn:hover, .btn:focus {
    opacity: 0.8;
}
.btn:active {
    -webkit-transform: scale(0.80);
    -moz-transform: scale(0.80);
    -ms-transform: scale(0.80);
    -o-transform: scale(0.80);
    transform: scale(0.80);
}

 .right{
      position: absolute;
    right: 50px;
    top: 180px;
    font-size:20px;
  }
img{
  position:absolute;
  padding-top: 2px;
  float: left;
  width: 250px;
  height: 250px;
}
.head-wrapper 
{
    height: 300px;
}
.left
{
      position: absolute;
    top: 180px;
    left: 260px;
    font-size:20px;
}
.store_name
{
  position: absolute;
  left: 250px;
}
</style>
</head>
<body>
  <div id="invoice" style="width: 1260px;">
  <div class="head-wrapper">
    <div class="store_name">
      <h1><?php echo $store_name;?>
        <br>
        <h2>location:<?php echo $store_street.','.$store_brgy.','.$store_municipality.','.$store_province.'<br>Near To:'.$store_near_to; ?>
      </h2>
      </h1>
    </div>
 <div class="mid-top">
  <img src="image/Product (2).png"> 
  </div>

<div class="left">
  <h5>Cashier:<?php echo $casher_name;?></h5>
  <h5>Sold To: <?php echo $name;?></h5>
</div>
<div class="right">
<h5>date: <?php echo $date;?></h5>
<h5>Invoice #:<?php 
 $db = mysqli_connect("localhost","root","","storenewdb");

$transaction_id = mysqli_real_escape_string ( $db, $_GET['id']);
echo $transaction_id;?>

</h5>
</div>
</div>
  <div class="table">
    <table class="customers">

      <tr>
        <th>code</th>
        <th>name</th>
        <th>color</th>
        <th>size</th>
        <th>quantity</th>
        <th>price</th>
        <th>subtotal</th>
        <th>discount</th>
        <th>Total</th>
      </tr>

  <?php
   $db = mysqli_connect("localhost","root","","storenewdb");
                        {
                            $transaction_id = mysqli_real_escape_string ( $db, $_GET['id']);
                            
                            $sqli = "SELECT `id`, `transaction_id`, `product_name`, `product_code`, `product_color`, `product_size`, `product_brand`, `product_category`, SUM(product_quantity) AS product_quantity, product_price, `sub_total`, `discount`, SUM(total) AS total, `date_time` FROM `success_transaction` WHERE transaction_id = '$transaction_id' group by product_code ";
                            $result =mysqli_query($db,$sqli);
                    $num = mysqli_num_rows($result);
                    if($num>0)
                    {
                    while ($res=mysqli_fetch_assoc($result)) 
                    {
                      echo "
                      <tr>
                      
                      <td>".$res['product_code']."</td>
                      <td>".$res['product_name']."</td>
                      <td>".$res['product_color']."</td>
                      <td>".$res['product_size']."</td>
                      <td>".$res['product_quantity']."</td>
                      <td>".$res['product_price']."</td>
                       <td>".$res['sub_total']."</td>
                      <td>".$res['discount']."</td>
                      <td>".$res['total']."</td>

                      "; ?>
                      </tr>
                      <?php
              


                    }
                  }
                  else
                  {
                    echo "No Data Available....Please Try Again";
                  }
                        }
                        ?>
                  <tr>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td>SUB-TOTAL:</td>
                    <td><?php echo $transaction_sub_total; ?></td>
                  </tr>
                  <tr>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td>DISCOUNT:</td>
                    <td><?php echo $transaction_discount; ?></td>
                  </tr>
                  <tr>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td style="border:0;background-color: #ffffff;"></td>
                    <td>TOTAL:</td>
                    <td><?php echo $transaction_total; ?></td>
                  </tr>

    </table>  
 
  <div class="bot">
    <center><h3>THANK YOU FOR YOUR LOYALTY! <br>  </h3>
  </div>

  </div>
  </div>
  <br><br><br>
  <div class="button">
        <a href="history.php" class="btn teal block">Back</a>

      </div>
      <div>
        <h3></h3>
         <button onclick="PdfDownload('store transaction')">DOWNLOAD AS PDF</button>
  </div>
      
<script type="text/javascript">
function PdfDownload(filename)
{
  kendo.drawing.drawDOM($("#invoice")).then(function(group){
    return kendo.drawing.exportPDF(
      group,{
        paperSize:"auto",
        margin:{
          left:"1cm",
          right:"1cm",
          top:"1cm",
          botton:"1cm",

        }
      })
  })
  .done(function(data){
    kendo.saveAs({
      dataURI:data,
      fileName:filename
    })
  });
}
</script>

</body>
</html>