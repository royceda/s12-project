var confirmer=document.querySelector("#body .confirmer");
confirmer.addEventListener("click",Options,false);
var confirmer_a=document.querySelector("#body .confirmer a");
confirmer_a.addEventListener("click",Options,false);

var Options=function(e){
	if (document.querySelector("#body table form select").value=="none"){
		try{
		e.preventDefault();
		e.stopPropagation();
		}
		catch(ev){
			alert(ev);
		}
	}
	else{
		var form=document.querySelector("#body table form");
		form.action+='&taille='+document.querySelector("table form select").value;
		form.submit();
	}
};