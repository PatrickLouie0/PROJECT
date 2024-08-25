	function update() {
				var clas = document.getElementById('class');
				if (clas == "A") 
			{
				var a = 2;
				var option = a.options[a.selectedIndex];		
				document.getElementById('productaddedprice').value = option.value;
			update();
			}
			}
		