<?php
if($uzivatel!==false && $uzivatel->isAdmin()){
    if(isset($_POST['titulek']) && isset($_POST['obsah']) && !empty($_POST['titulek']) && !empty($_POST['obsah'])){
        if($clankyModel->pridejClanek($_POST['titulek'],$_POST['obsah'], $uzivatel->nick)){
            $view_obsah=$view_obsah."<div id='spravne'>Článek byl přidán.</div>";
        }else{
            $view_obsah=$view_obsah."<div id='chyba'>Připojení s databází selhalo. Zkuste to za chvíli nebo kontaktujte administrátora.</div>";
        }
    }
    else{
        $template_params["hlavicka"]=$template_params["hlavicka"]."<script type='text/javascript' src='./ckeditor/ckeditor.js'></script>";

        $template_params['clanek']=array('titulek'=>' ', 'obsah' => ' ');
        $template_params["obsah_include"]="formularClanky.twig";
    }
}
else{
    $view_obsah=$view_obsah."<div id='chyba'>Pro přístup nemáte dostatečné oprávnění.</div>";
}