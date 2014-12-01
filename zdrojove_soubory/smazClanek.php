<?php
if($uzivatel!==false && $uzivatel->isAdmin()){  
        if($clankyModel->smazClanek($_GET['id'])){
            $view_obsah=$view_obsah."<div id='spravne'>Článek byl smazán. Pro projevení změn zmáčkněte f5.</div>";
        }else{
            $view_obsah=$view_obsah."<div id='chyba'>Připojení s databází selhalo. Zkuste to za chvíli nebo kontaktujte administrátora.</div>";
        }
}
else{
    $view_obsah=$view_obsah."<div id='chyba'>Pro přístup nemáte dostatečné oprávnění.</div>";
}