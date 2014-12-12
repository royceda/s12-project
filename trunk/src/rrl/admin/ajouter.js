try{
var options=document.querySelectorAll(".select option");
for(var i=0; i<options.length ; i++){
	options[i].addEventListener("click",function(e){
		if(e.target.value!="none"){
		for (var j=0; j<divs.length ; j++){
			divs[j].style.display="none";
		}
		try{
		document.querySelector("#body div[id=\""+e.target.value+"\"]").style.display="initial";
		}catch(e){
			alert(e);
		}
		}
	},false);
}
var divs=document.querySelectorAll("#body div");
for (var j=0; j<divs.length ; j++){
	divs[j].style.display="none";
}
}catch(e){
	alert(e);
}