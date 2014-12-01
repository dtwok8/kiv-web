<?php
if(isset($_GET['smaz']) && $uzivatel!==false && $uzivatel->isAdmin()){
    $referenceModel-> smazReferenci($_GET['smaz']);
}

// přidávání příspěvků + kontrola formuláře
if(isset($_POST['obsah']) && $uzivatel!==FALSE){
    if(empty($_POST['titulek']) || empty($_POST['obsah'])){
        $view_obsah=$view_obsah."<div id='chyba'>Všechny položky musí být vyplněny!</div>";
    }
    else{
        if($referenceModel->pridejReferenci($_POST['titulek'],$_POST['obsah'], $uzivatel->nick)){
            $view_obsah=$view_obsah."<div id='spravne'>Reference byla úspěšně přidána do databáze!</div>";
        }else{$view_obsah=$view_obsah."<div id='chyba'>Spojení s databází selhalo!</div>";}
    }
}

$reference=$referenceModel->vyberReference();

if($uzivatel!==FALSE){
    $template_params["obsah_include"]="reference.html";
}

foreach($reference as $radek){

    $view_obsah=$view_obsah."<table class='tabulka_reference'>"
            . "<tr><td colspan='2'><h3>".$radek['titulek']."</h3></td></tr>"
            . "<tr><td><b>".$radek['nick']."</b></td><td>";
    if($uzivatel!==false && $uzivatel->isAdmin()){
        $view_obsah=$view_obsah."<a href='index.php?stranka=reference&smaz=".$radek['id']."' onClick='return window.confirm(\"Opravdu chcete příspěvek smazat?\");' style='float:right;'>Smaž!</a>";
    }       
    $view_obsah=$view_obsah."</td>"
            . "<td></td></tr><tr><td colspan='2'>".$radek['obsah']."</td><td></td></tr></table>";
}
