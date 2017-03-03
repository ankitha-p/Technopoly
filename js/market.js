function marketBuy(qid) {
if(qid)
{
  var x=confirm("Are You sure that you want to purchase?");
  if(x==true)
  {
	 $.ajax({
   type: "GET",
   url: "buymarket.php?q="+qid,
data: {
		 qid:qid
},
   success: function(html){  
if(html==1)    {
//$("#add_err").html("right username or password");
  alert("successfully purchased");
window.location="#user";
}
else if(html==2)   {
alert("insufficient balance");
}
else if(html==3)   {
alert("you cannot purchase your own question");
}
else if(html==4)   {
alert("Too slow. Someone already purchased it");
}
else {
alert("error");
window.location="#market";
}
   }
  });
return false; 
  }
}
}