<?php
if($uzivatel!==false){
    if(isset($_GET['smazid'])){
        if($produktModel->smazOblibenyProdukt($_GET['smazid'])){
            $view_obsah=$view_obsah."<div id='spravne'>Produkty byl odebrán z oblíbených.</div>";
        }else{
            $view_obsah=$view_obsah."<div id='chyba'>Připojení s databází selhalo. Zkuste to za chvíli nebo kontaktujte administrátora.</div>";
        }
    }

    $view_obsah=$view_obsah."<h1>Oblíbene produkty</h1>";

    $produkty=$produktModel->vyberOblibeneProdukt($uzivatel->nick);

    $view_obsah=$view_obsah."<table border='1' class='tabulka_vypis_produktu'><tr>";
    $i=0;

    foreach ($produkty as $produkt){
        $view_obsah=$view_obsah. "<td><table style='width:295px;height:250px;'>";
            $view_obsah=$view_obsah. "<tr><td colspan='2'></td><td rowspan='2' style='width:30px;'>";
                    $view_obsah=$view_obsah. "<a href='index.php?stranka=oblibeneProdukty&amp;smazid=".$produkt['id']."' onClick='return window.confirm(\"Opravdu chcete produkt vyřadit z oblíbených?\");' style='float:right;'>Smaž!</a> <br />";

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
}
else{
    $view_obsah=$view_obsah."<div id='chyba'>Pro přístup nemáte dostatečné oprávnění.</div>";
}
