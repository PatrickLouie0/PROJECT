
    <?php
    $connect = mysqli_connect("localhost", "root", "", "store");
    $output = '';
    if(isset($_POST["query"]))
    {
       $search = mysqli_real_escape_string($connect, $_POST["query"]);
       $query = "SELECT * FROM product WHERE productcode LIKE '%".$search."%' OR productname LIKE '%".$search."%'";
    }
    else
    {
       $query = "
       SELECT * FROM product ORDER BY id";
    }
      $result = mysqli_query($connect, $query);
      if(mysqli_num_rows($result) > 0)
      {
         while($res = mysqli_fetch_array($result))
     {
     $output .= '
     <div  class="card" 
     style="

      margin-bottom: 80px;
      height: 410px;
      width: 330px;
      background-color: green;
     " >
      <h3 >'.$res['productcode'].'</h3>
      <div class="image" >
      <img src=../product/'.$res['productpicture'].' style="width:250px;   height: 130px; margin-left:30px; "
        >
      </div>    
      <div class="row "
     " 
    >
        <h3 class = "col">Name:'.$res['productname'].'</h3>
       <h3 class = "col ">Category:'.$res['productcategory'].'</h3>
       <h3 class = "col">Color:'.$res['productcolor'].'</h3>
       <h3 class = "col">Size:'.$res['productsize'].'</h3>
       <h3 class = "col ">Class:'.$res['productclass'].'</h3>
       <h3 class = "col">Price:'.$res['productnewprice'].'</h3>
       <h3 class = "col">stock:'.$res['productquantity'].'<h3>
      
     
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

