function buyQuestion(qid) {
if(qid)
{
  var x=confirm("Are You sure that you want to purchase?");
  if(x==true)
  {
	 $.ajax({
   type: "GET",
   url: "buy.php",
data: {
		  q:qid
},
   success: function(html){  
if(html==1)    {
  alert("successfully purchased");
window.location="#user";
}
else if(html==2)   {
alert("insufficient balance");
}

else if(html==3)   {
alert("Too slow. Someone already purchased it");
window.location="#shop";
}
else {
alert("error");
alert(html);
window.location="#shop";
}
   }
  });
return false; 
  }
}
}


