function transactions(pageName,elmnt,color)
{
  document.getElementById("transaction").style.display = "block";
  elmnt.style.backgroundColor = color;
  document.getElementById("expenses").style.display = "none";
  
}

function expensess(pageName,elmnt,color) {
elmnt.style.backgroundColor = color;
  document.getElementById("transaction").style.display = "none";
  document.getElementById("expenses").style.display = "block";
  }
  