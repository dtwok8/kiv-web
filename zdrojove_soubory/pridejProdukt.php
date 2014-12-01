<?php
if($uzivatel!==false && $uzivatel->isAdmin()){  
    if(isset($_POST['nazev_produktu']) && !empty($_POST['nazev_produktu']) && !empty($_POST['cena'])&& !empty($_POST['popis']) && (($_POST['znacka_radio']==="znacka_inputu" && !empty($_POST['pridat_znacku'])) || $_POST['znacka']!=="nic")){ 
        
        //přidání nové značky
        if($_POST['znacka_radio']==="znacka_inputu"){          
              $produktModel->pridatZnacku($_POST['pridat_znacku']);
              $znacka_z_databaze=$produktModel->vyberZnacku($_POST['pridat_znacku']);
              $_POST['znacka']=$znacka_z_databaze['id'];
       }
        
        
        ////Nahrávání obrázku///////
        if(!empty($_FILES['soubor']['name'])){ 
        $file = $_FILES['soubor']['name'];
        $tmp = explode('.', $file);
        $pripona=".".end($tmp);
        //$pripona=".".end(explode(".", $file));
        $nazev=date('Y-m-d_H-i-s');
        
            //teprve když se obrázek podaří nahrát provedeme sql dotaz
            if(is_uploaded_file($_FILES['soubor']['tmp_name']) && move_uploaded_file($_FILES['soubor']['tmp_name'],"./upload_images/".$nazev.$pripona)){

                if($produktModel->pridejProdukt($_POST['nazev_produktu'], $nazev.$pripona,$_POST['cena'],$_POST['popis'],$_POST['znacka'], $uzivatel->nick)){
                        $view_obsah=$view_obsah."<div id='spravne'>Soubor " .$_FILES['soubor']['name']. " byl úspěšně nahrán!<br />Produkt byl úspěšně přidán!</div>";}
                else{$view_obsah=$view_obsah."<div id='chyba'>Soubor " .$_FILES['soubor']['name']. "se nepodařilo nahrát!</div>";}  
            }
        }

    }
    else{
        $template_params["obsah_include"]="formularprodukty.twig";
        $template_params['produkt']=array('nazev'=>' ', 'cena'=>' ', 'popis'=>' ','znacka'=>' ' );
        $template_params['znacky']=$produktModel->vyberZnacky();
    }
}
else{
    $view_obsah=$view_obsah."<div id='chyba'>Pro přístup nemáte dostatečné oprávnění.</div>";
}