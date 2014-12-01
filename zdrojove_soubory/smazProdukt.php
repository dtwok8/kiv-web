<?php
if($uzivatel!==false && $uzivatel->isAdmin()){

    if($produktModel->SmazProdukt($_GET['smazid'])){
            $view_obsah=$view_obsah."<div id='spravne'>Produkt byl smazán. </div>";
        }else{
            $view_obsah=$view_obsah."<div id='chyba'>Připojení s databází selhalo. Zkuste to za chvíli nebo kontaktujte administrátora.</div>";
    }
    
}   
else{
    $view_obsah=$view_obsah."<div id='chyba'>Pro přístup nemáte dostatečné oprávnění.</div>";
}



