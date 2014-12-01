<?php
if(isset($_GET['stranka'])){
    $clanky = $clankyModel->vyberClanky();
    
    //davame clanky do pole aby jsme zabránili, dotazu na stránku která neexistuje
    $stranky=array('registrace', 'kontakt', 'vypis_produktu', 'pridejClanek','spravaUzivatelu','upravClanek','smazClanek','pridejProdukt','vypisProduktu','smazProdukt','upravProdukt','reference','upravitOsobniUdaje','zmenitHeslo','oblibeneProdukty');
    foreach($clanky as $clanek){
        $stranky[]=$clanek['id'];
    }

    if(!in_array($_GET['stranka'],$stranky)){
        //stranka neexistuje, nemáme jí ve výpisu stránek
        $view_obsah="Litujeme požadovaná stránka neexistuje";
    }
    else{
        //už víme že stránka existuje
        
        if($_GET['stranka'] === "registrace"){
            require 'registrace.php';
            $template_params["hlavicka"]=$template_params["hlavicka"]."<script type='text/javascript' src='js/kontrola_formulare.js'></script>";
            $template_params["obsah_include"]="registrace.html";
        }
        elseif($_GET['stranka'] === "spravaUzivatelu"){
            require 'spravaUzivatelu.php';
        }
        elseif($_GET['stranka'] === "reference"){
            require 'reference.php';
        }
        elseif($_GET['stranka'] === "kontakt"){
            //přidání administračních tlačítek 
            if($uzivatel!==false && $uzivatel->isAdmin()){
                $view_obsah=$view_obsah."<a href=index.php?stranka=upravClanek&id=12>Uprav</a>";
            }
            $clanek = $clankyModel->vyberObsahClanku(12);
            $view_obsah=$view_obsah."<p>".$clanek['obsah']."</p>";
        }
        /* uzivatel */
         elseif($_GET['stranka'] === "upravitOsobniUdaje"){
            require 'upravitOsobniUdaje.php';
        }
        elseif($_GET['stranka'] === "zmenitHeslo"){
            require 'zmenitHeslo.php';
        }
        /* produkty */
        elseif($_GET['stranka'] === "upravProdukt"){
            require 'upravProdukt.php';
        }
        elseif($_GET['stranka'] === "vypisProduktu"){
            require 'vypisProduktu.php';
        }
        elseif($_GET['stranka'] === "smazProdukt"){
            require 'smazProdukt.php';
        }
        elseif($_GET['stranka'] === "pridejProdukt"){
            require 'pridejProdukt.php';
        }
        elseif($_GET['stranka'] === "oblibeneProdukty"){
            require 'oblibeneProdukty.php';
        }
        /* články */
        elseif ($_GET['stranka'] === "pridejClanek") {
            require 'pridejClanek.php'; 
        }
        elseif($_GET['stranka'] === "upravClanek"){
            require 'upravClanek.php';
        }
        elseif($_GET['stranka'] === "smazClanek"){
            require 'smazClanek.php';
        }
        else {           
            $clanek = $clankyModel->vyberObsahClanku($_GET['stranka']);
            
            //přidání administračních tlačítek 
            if($uzivatel!==false && $uzivatel->isAdmin()){
                $view_obsah=$view_obsah."<a href=index.php?stranka=upravClanek&id=".$clanek['id'].">Uprav</a>";
                $view_obsah=$view_obsah." &nbsp;&nbsp;";
                $view_obsah=$view_obsah."<a href=index.php?stranka=smazClanek&id=".$clanek['id'].">Smaz</a>";
            }
            
            $view_obsah=$view_obsah."<p>".$clanek['obsah']."</p>";
        }
    }    
}




