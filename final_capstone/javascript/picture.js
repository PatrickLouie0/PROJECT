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


	function trigger()
	{
		document.querySelector('#productpicture').click();
	}
	function displayproduct(e)
	{
		if (e.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e)
			{
				document.querySelector('#productdisplay').setAttribute('src',e.target.result);
			}
			reader.readAsDataURL(e.files[0]);
		}
	}
