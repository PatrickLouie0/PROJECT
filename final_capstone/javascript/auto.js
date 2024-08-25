
function calculate() {   
 if(isNaN(document.forms["myf"]["qty"].value) || document.forms["myf"]["qty"].value=="") {   
 var text1 = 0;   
 } else {   
 var text1 = parseInt(document.forms["myf"]["qty"].value);   
 }   
 if(isNaN(document.forms["myf"]["Cost"].value) || document.forms["myf"]["Cost"].value=="") {   
 var text2 = 0;   
 } else {   
 var text2 = parseFloat(document.forms["myf"]["Cost"].value);   
 }   
 document.forms["myf"]["box"].value = (text1*text2);   
 }  

 function calculates() {   
 if(isNaN(document.forms["myf"]["box"].value) || document.forms["myf"]["box"].value=="") {   
 var text4 = 0;   
 } else {   
 var text4 = parseFloat(document.forms["myf"]["box"].value);   
 } 
 
 if(isNaN(document.forms["myf"]["payment"].value) || document.forms["myf"]["payment"].value=="") {   
 var text3 = 0;   
 } else {   
 var text3 = parseFloat(document.forms["myf"]["payment"].value);   
 } 

 document.forms["myf"]["totals"].value = (  text4 -text3);

 }
