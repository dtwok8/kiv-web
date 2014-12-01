<?php
if(isset($_GET['oblibene']) && $uzivatel!=false){
        if($produktModel->pridatDoOblibenych($uzivatel->nick, $_GET['oblibene'])){
            $view_obsah=$view_obsah."<div id='spravne'>Produkt byl přidán mezi oblíbené.</div>";
        }else{
            $view_obsah=$view_obsah."<div id='chyba'>Připojení s databází selhalo. Zkuste to za chvíli nebo kontaktujte administrátora.</div>";
        }
}

$znackadb="";
$seradit="";
$znacky=$produktModel->vyberZnacky();
$znackyPorovnani;

foreach ($znacky as $znacka) {
   $znackyPorovnani[]=$znacka['id'];
}

if(isset($_POST['vyber_znacku'])){
    if(in_array($_POST['vyber_znacku'],$znackyPorovnani)){
        $znackadb="WHERE z.id = ".$_POST['vyber_znacku'];
    }
}
if(isset($_POST['seradit'])){
    if(in_array($_POST['seradit'],array('nazev','cena'))){
        $seradit="ORDER BY ".$_POST['seradit'];
    }
}



$produkty=$produktModel->vyberProdukty($znackadb, $seradit);
$template_params["obsah_include"]="filtrVypisProduktu.twig";
$template_params['znacky']=$znacky;


$view_obsah=$view_obsah."<table border='1' class='tabulka_vypis_produktu'><tr>";
$i=0;
foreach ($produkty as $produkt){
    $view_obsah=$view_obsah. "<td><table style='width:295px;height:250px;'>";
        $view_obsah=$view_obsah. "<tr><td colspan='2'></td><td rowspan='2' style='width:30px;'>";
                if($uzivatel!==false){
                    $view_obsah=$view_obsah. "<a href='index.php?stranka=vypisProduktu&amp;oblibene=".$produkt['id_produktu']."' style='float:right;'> ♥ </a>";
                    if($uzivatel->isAdmin()){
                        $view_obsah=$view_obsah. "<a href='index.php?stranka=smazProdukt&amp;smazid=".$produkt['id_produktu']."' onClick='return window.confirm(\"Opravdu chcete produkt smazat?\");' style='float:right;'>Smaž!</a> <br />";
                        $view_obsah=$view_obsah. "<a href='index.php?stranka=upravProdukt&amp;upravid=".$produkt['id_produktu']."' style='float:right;'>Uprav!</a>";
                    }
                                                            
                }
        $view_obsah=$view_obsah. "</td></tr>";
        $view_obsah=$view_obsah. "<tr><td colspan='2'>".$produkt['nazev_znacky']." - <b>".$produkt['nazev']."</b></td></tr>";

        $view_obsah=$view_obsah. "<tr><td rowspan='2' style='width:101px;'>";
        if(file_exists("./upload_images/".$produkt['obrazek']) && $produkt['obrazek']!==NULL){    
                $view_obsah=$view_obsah. "<img src='./upload_images/".$produkt['obrazek']."' style='width:100px;' alt='obrazek produktu' />";}
        else{$view_obsah=$view_obsah. "<img src='./layout_img/notfound.png' alt='Not found' style='width:100px;'>"; }
            $view_obsah=$view_obsah. "</td><td colspan='2'>".$produkt['popis']."...</td></tr>";
        $view_obsah=$view_obsah. "<tr><td colspan='2' style='vertical-align:bottom;text-align:right;' ><b>Cena: ".$produkt['cena']." Kč </b> </td></tr>";
    $view_obsah=$view_obsah."</table></td>" ;
    $i++;
    if($i===3){$view_obsah=$view_obsah."</tr><tr>";$i=0;}
    }
    for($i;$i===3;$i++){
            $view_obsah=$view_obsah. "<tr> <td> &nbsp; </td> </tr>";
    }
    $view_obsah=$view_obsah. "</tr></table>";


