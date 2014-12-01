<?php
$userModel=new user_model();

$dopln=false;
if(isset($_POST['nick'])){
   $dopln=true;
   if( /*user::kontrola()===true && */ $userModel->existNick($_POST['nick'])===false && $_POST['heslo']===$_POST['heslo_znovu'] && preg_match( "~@~",$_POST['mail']) && strlen($_POST['heslo'])>=5 && preg_match("/^[\w\.]{3,50}$/", $_POST['nick']) && preg_match("/^[\w\.]{3,50}$/", $_POST['heslo'])) {
       
            if($userModel->pridat($_POST['nick'], $_POST['jmeno'], $_POST['prijmeni'], $_POST['heslo'], $_POST['mail'])){ $view_obsah=$view_obsah."<div id='spravne'>Uživatel byl přidán!</div>"; $dopln=false;}
            else{ $view_obsah=$view_obsah."<div id='chyba'>Spojení s databází selhalo!</div>";}
   }    
   else{
       //Chybové hlášky
        $view_obsah=$view_obsah."<table id='chyba'> <tr><td><b>Formulář obsahuje chyby:</b></td>";
        if(strlen($_POST['heslo'])<5){$view_obsah=$view_obsah. "<td>- Heslo musí mít alespoň pět znaků! </td></tr><tr><td>";}
       // if(user::kontrola()===false){$view_obsah=$view_obsah. "</td><td>- Všechny položky s hvězdičkou musí být vyplněny! </td></tr><tr><td>";}
        if($userModel->existNick($_POST['nick'])){$view_obsah=$view_obsah. "</td><td>- Nick již v naší databázi existuje! </td></tr><tr><td>";}
        if(!preg_match("/^[\w\.]{3,50}$/", $_POST['nick'])) {$view_obsah=$view_obsah."</td><td>- Nick obsahuje zakázané znaky!</td></tr><tr><td>";}
        if(!preg_match("/^[\w\.]{3,50}$/", $_POST['heslo'])) {$view_obsah=$view_obsah. "</td><td>- Heslo obsahuje zakázané znaky!</td></tr><tr><td>";}
        if($_POST['heslo']!==$_POST['heslo_znovu']){$view_obsah=$view_obsah. "</td><td>- Hesla se neschodují! </td></tr><tr><td>";}
        if(!preg_match( "~@~",$_POST['mail'])){$view_obsah=$view_obsah. "</td><td>- Zadejte e-mail ve správném formátu! </td></tr><tr><td>";}
        $view_obsah=$view_obsah. "</td><td></td></tr>";
     $view_obsah=$view_obsah. "</table>";
   }  
}

