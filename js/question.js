$(document).ready(function() {

history.pushState(null, null, document.URL);
window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
});

});
//Add Market
function addToMarket() {
var price = $("#price").val();
//var level=$("#level").val();
var cp=$("#cp").val();
var qid=$("#qid").val();
var x = cp-price;
if ( price === '') {
alert("Please enter a price to sell");
} 
else if (x<0) {
alert("Sale price cannot be greater than cost price");
}
else if (price<0) {
alert("invalid sale price");
}
else {

  $.ajax({
   type: "GET",
   url: "addmarket.php",
data: {
	     qid:qid,
		 price:price
},
   success: function market(html){  
if(html==1)   
	{
  alert("successfully placed in market");
window.location="#user";
}
else if(html==2)   {
alert("failed to add to market");
}
else if(html==3)   {
alert("this question cannot be sold");
}
else {
alert("error");
}
   }
  });
return false;
}
}
//Submit answer
function submitAnswer() {
var ans = $('input[name=option]:checked').val();
var qid=$("#qid").val();
if (!ans) {
alert("Please select an option");
} 

else {
var x=confirm("Are You sure that you want to submit?");
  if(x==true)
  {
  $.ajax({
   type: "GET",
   url: "submit.php",
data: {
	    qid:qid,
		  option:ans
},
   success: function solve(html){ 
if(html==1)   
	{
  alert("correct answer");
  window.location="#user";
}
else if(html==2)   {
  alert("wrong answer");
  window.location="#user";
}
else if(html==3)   {
alert("question already solved");
}
else {
alert("error");
}
   }
  });
return false;
}
}
}