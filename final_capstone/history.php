<!DOCTYPE html>
<html>
<head>
<!--
     <link  rel = "icon" href ="image/Product (2).png" type = "image x-icon">
-->   
  <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  user-select: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.btn{
  height: 45px;
  width: 45px;
  font-size: 15px;
  text-align: left;
  border-radius: 3px;
  cursor: pointer;
  transition: left 0.4s ease;
  margin-top: 10px;
  margin-left: 5px;
}
.btn i{
  color: white;
  font-size: 28px;
  line-height: 30px;
}
.btn.click span:before{
  content: '\f00d';
}
.sidebar{
  -ms-overflow-style:none;
  scroll-width:none;
  overflow-y: scroll;
  position: fixed;
  width: 250px;
  height: 100%;
  left: -250px;
  background: #1b1b1b;
  transition: left 0.4s ease;
}
.sidebar.show{
  left: 0px;
}
.sidebar .text{
  color: white;
  font-size: 25px;
  font-weight: 600;
  line-height: 65px;
  text-align: center;
  background: #1e1e1e;
  letter-spacing: 1px;
}
nav ul{
  background: #1b1b1b;
  height: 100%;
  width: 100%;
  list-style: none;
}
nav ul li{
  line-height: 60px;
  border-top: 1px solid rgba(255,255,255,0.1);
}
nav ul li:last-child{
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
nav ul li a{
  position: relative;
  color: white;
  text-decoration: none;
  font-size: 18px;
  padding-left: 40px;
  font-weight: 500;
  display: block;
  width: 100%;
  border-left: 3px solid transparent;
}
nav ul li.active a{
  color: cyan;
  background: #1e1e1e;
  border-left-color: cyan;
}
nav ul li a:hover{
  background: #1e1e1e;
}
nav ul ul{
  position: static;
  display: none;
}
nav ul .feat-show.show{
  display: block;
}
nav ul .serv-show.show1{
  display: block;
}
nav ul .sale-show.show2{
  display: block;
}
nav ul ul li{
  line-height: 42px;
  border-top: none;
}
nav ul ul li a{
  font-size: 17px;
  color: #e6e6e6;
  padding-left: 80px;
}
nav ul li.active ul li a{
  color: #e6e6e6;
  background: #1b1b1b;
  border-left-color: transparent;
}
nav ul ul li a:hover{
  color: cyan!important;
  background: #1e1e1e!important;
}
nav ul li a span{
  position: absolute;
  top: 50%;
  right: 20px;
  transform: translateY(-50%);
  font-size: 22px;
  transition: transform 0.4s;
}
nav ul li a span.rotate{
  transform: translateY(-50%) rotate(-180deg);
}
/*sidebar css*/
header
{
   display: flex;
   align-content: center;
   background-color: #034f84;
   height: 50px;
   width: 100%;
}
/*start of transaction graph*/
or: white;

.graph
{
  margin-top: 5px;
  margin-left: 3px;
  background-color: red;
  height: 160px;
  width: 1255px;
}
/*end transaction css graph*/
/*start css table*/

table
{
  text-align: center;
  padding-top: 30px;
  margin-bottom: 10px;
  border-style: solid;
  border-width: 2px;
  border-color: gray;
  width: 97%;
  height: 400px;
  margin-left: 20px;
}
/*end of transaction graph*/
/*start of responsive*/
@media screen and (max-width: 800px) {
 .card, .table {
    width: 370px;
  }
  .graph
  {
    width: 360px;
  }
  table
  {
    width: 360px;
  }
}
.dataTables_wrapper {
  position: static;
  clear: both;
  *zoom: 1;
  zoom: 1;
}
  </style>
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/data_table.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

<body>
  <table class="table table-fluid" id="myTable">
    <thead>
        <tr>
        <th>No</th>
        <th>Transaction ID</th>
        <th>Cashier</th>
        <th>Customer Name</th>
        <th>Sub Total</th>
        <th>Discount</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Change</th>
        <th>Date Time</th>
        <th>View</th>
  </thead>
   <?php 

      $db = mysqli_connect("localhost","root","","storenewdb");
        $sqli = "SELECT *  FROM transaction_total ORDER BY date_time desc";
        $result =mysqli_query($db,$sqli);
          $num = mysqli_num_rows($result);
          if($num>0){
            while ($res=mysqli_fetch_assoc($result)) {
              echo "
                <tr>
                <td>".$res['id']."</td>
                <td>".$res['transaction_id']."</td>
                <td>".$res['casher']."</td>
                <td>".$res['customer_name']."</td>
                <td>".$res['sub_total']."</td>
               
                "; ?>
         <?php
            }
          }
       ?>

       </tbody>
  
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>


<!--end of js sidebar-->
</div>
</body>
</html>