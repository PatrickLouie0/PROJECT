<?php
	include 'processform.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="pictureexpi.php" method="post" enctype="multipart/form-data">
	<img src="image/20210122_173004.jpg" id="profiledisplay" onclick="triggerclick()" style="height: 100px; width: 100px;display: block;">
	<label for="profileimage">image</label>
	<input type="file" name="profileimage" onchange="displayimage(this)" id="profileimage" style="display: none;">
	<br>
	<textarea name="bio" id="bio"></textarea>
	<br>
	<button type="submit" name="submit">submit</button>
</form>
<script type="text/javascript">
	
	function triggerclick()
	{
		document.querySelector('#profileimage').click();
	}
	function displayimage(e)
	{
		if (e.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e)
			{
				document.querySelector('#profiledisplay').setAttribute('src',e.target.result);
			}
			reader.readAsDataURL(e.files[0]);
		}
	}
</script>
</body>
</html>