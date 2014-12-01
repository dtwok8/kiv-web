<?php
if($uzivatel!==false && $uzivatel->isAdmin()){
    if(isset($_POST['titulek']) && isset($_POST['obsah']) && !empty($_POST['titulek']) && !empty($_POST['obsah'])){
        
        if($clankyModel->updateClanek($_POST['titulek'],$_POST['obsah'],$_GET['id'])){
            $view_obsah=$view_obsah."<div id='spravne'>Článek byl upraven. Pro projevení změn zmáčkněte f5.</div>";
        }else{
            $view_obsah=$view_obsah."<div id='chyba'>Připojení s databází selhalo. Zkuste to za chvíli nebo kontaktujte administrátora.</div>";
        }
    }
    else{

        $template_params["hlavicka"]=$template_params["hlavicka"]."<script type='text/javascript' src='./ckeditor/ckeditor.js'></script>";

        $template_params['clanek']=$clankyModel->vyberObsahClanku($_GET['id']);//array('titulek'=>'clanek1', 'obsah' => 'obsah clanku');
        $template_params["obsah_include"]="formularClanky.twig";
    }
}
else{
    $view_obsah=$view_obsah."<div id='chyba'>Pro přístup nemáte dostatečné oprávnění.</div>";
}