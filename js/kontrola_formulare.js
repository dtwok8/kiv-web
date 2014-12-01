function over(form){
    var hlasky="";
    var chyby=false;
    
    if(form.nick.value==""){hlasky= hlasky+"Zadejte svůj Nick!<br />"; chyby=true;}
    if(form.heslo.value==""){hlasky= hlasky+"Zadejte heslo!<br />";chyby=true;}
    if(form.heslo.value.length<5){hlasky = hlasky+"Heslo musí mít alespoň 5 znaků!<br />";chyby=true;}
    if(form.heslo_znovu.value==""){hlasky = hlasky+"Pro kontrolu musí být heslo zadané dvakrát!<br />";chyby=true;}
    if(form.heslo.value!=form.heslo_znovu.value){hlasky =hlasky+"Hesla se neschodují!<br />";chyby=true;}
    if(form.mail.value.indexOf('@')==-1 || form.mail.value.indexOf('.')==-1){hlasky = hlasky+"Zadejte svůj E-mail ve správném formátu!<br />";chyby=true;}  
          
    
    if(chyby){
        document.getElementById("informace").innerHTML="<div id='chyba'>"+hlasky+"</div>";
        return false;
    }
    else{return true;}
}


