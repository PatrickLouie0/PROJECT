<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
	<style type="text/css">
		*
		{
			text-decoration: none;
		}
		.card
		{
			margin-left: 20px;
		}
    footer
    {
    width: 1100px;
    opacity: 50%;
    }
    .a
    {
     color: green;
    font-size: 30px;
    font-weight: bold;

    }
    .filters
    {
      position: fixed;
      height: 300px;
      width: 300px;
      left: 53%;
      top: 10%;
      background-color: red;
    }
    .cl
    {
      width: 80px;
      transition: 2s
    }
    .cl:focus
    {
      width: 77px;
      background-color: black;
      color:white;
    }
    .cls:focus
    {
      width: 77px;
      background-color: black;
      color:white;
    }
	</style>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<title>Product</title>

</head>
<body>
  
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid ">
    <a class=" navbar-brand fs-2 fw-bold " href="#">Product</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>

    
    <ul class="nav fw-bold">
    	<form class="d-flex ">
        <input class="form-control me-2 text-dark" id = "search_text" name="search_text" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-dark" type="filter" onclick="openform()">filter</button>
          </form>
        

        <div class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          </div>
        </div>
      </form>
  <li class="nav-item">
    <a class="nav-link active text-success" aria-current="page" href="#">Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-dark" href="location.php">Location</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-dark" href="#">Contact</a>
  </li>
</ul>
  </div>
</nav>
	
	<form>
		<div class="container" >
	 
	 <div id="result" class="row row-cols-3">
	
      
     <div  class="card text-dark bg-light mb-3
     ">
	 </div>		
  </div>
	</form>
<form class="card-body">
  <?php
$con = mysqli_connect("localhost","root","","store");
$brandquery = "SELECT * FROM product";
$brandqueryrun = mysqli_query($con,$brandquery);
if (mysqli_num_rows($brandqueryrun)> 0) {
  foreach ($brandqueryrun as $brandlist) {
    ?>
    <input type="checkbox" name="brands[]" value="<?= $brandlist['id'];?>">
    <?=$brandlist['productcategory'];?>
    <?php
  }
  # code...
}
else
{
  echo "no category found";
}

?>
<input type="submit" name="submit">          
</form>


  <!--footer-->
  <footer class="bg-light ">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    
    <a class="a" href="https://mdbootstrap.com/">CONTACT OUR FACEBOOK ACCOUNT</a>
  </div>
  <!-- Copyright -->
</footer>
  <!--end of footer-->
  <script src="javascript/cus_popupform.js"></script>
	<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"viewproduct.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>
<script type="text/javascript">
  $('.btn').modal('toggle')
</script>
<script src="javascript/prevent_resub.js"></script>


</body>
</html>