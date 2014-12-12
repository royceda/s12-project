var selects=document.querySelectorAll("option");
for (var i=0;i<selects.length;i++){
try{	
	selects[i].addEventListener("click",function(e){
		e.target.parentElement.parentElement.submit();
	},false);
}catch(error){
	alert(error);
}
}