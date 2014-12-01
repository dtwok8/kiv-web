<?php

$clanky = $clankyModel->vyberClanky();

$view_menu="<ul>";

    $view_menu=$view_menu."<li><span class='kategorie'>Ošetření</span><ul>"; 
        foreach($clanky as $clanek){
            $view_menu=$view_menu."<li><a href='index.php?stranka=".$clanek['id']."'>".$clanek['titulek']."</a></li>";  
        }
    $view_menu=$view_menu."</ul></li>";
    
    $view_menu=$view_menu."<li><span class='kategorie'>Ostatní</span><ul>";
        $view_menu=$view_menu."<li><a href='index.php?stranka=kontakt'>Kontakt</a></li>";
        $view_menu=$view_menu."<li><a href='index.php?stranka=reference'>Reference</a></li>";
        $view_menu=$view_menu."<li><a href='index.php?stranka=vypisProduktu'>VypisProduktu</a></li>";
    $view_menu=$view_menu."</ul></li>";
    
    
    if($uzivatel!==false){
        $view_menu=$view_menu."<li><span class='kategorie'>Můj účet</span><ul>"; 
            $view_menu=$view_menu."<li><a href='index.php?stranka=upravitOsobniUdaje'>Upravit osobní údaje</a></li>";
            $view_menu=$view_menu."<li><a href='index.php?stranka=oblibeneProdukty'>Oblibene produkty</a></li>";
            //$view_menu=$view_menu."<li><a href='index.php?stranka=zmenitHeslo'>Změnit heslo</a></li>";
        $view_menu=$view_menu."</ul></li>";
        
        if($uzivatel->isAdmin()){
            $view_menu=$view_menu."<li><span class='kategorie'>Administrace</span><ul>"; 
                $view_menu=$view_menu."<li><a href='index.php?stranka=pridejClanek'>Přidej článek</a></li>";
                $view_menu=$view_menu."<li><a href='index.php?stranka=pridejProdukt'>Přidej produkt</a></li>";
                $view_menu=$view_menu."<li><a href='index.php?stranka=spravaUzivatelu'>Sprava uživatelu</a></li>";
            $view_menu=$view_menu."</ul></li>";
        }
    }


$view_menu=$view_menu."</ul>";