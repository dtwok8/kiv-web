<?php
if($uzivatel!==false && $uzivatel->isAdmin()){ 
if(isset($_POST['nazev_produktu']) && !empty($_POST['nazev_produktu']) && !empty($_POST['cena'])&& !empty($_POST['popis']) && (($_POST['znacka_radio']==="znacka_inputu" && !empty($_POST['pridat_znacku'])) || $_POST['znacka']!=="nic")){ 
        
        ////Nahrávání obrázku///////
        if(!empty($_FILES['soubor']['name'])){ 
            $file = $_FILES['soubor']['name'];
            $tmp = explode('.', $file);
            $pripona=".".end($tmp);
            //$pripona=".".end(explode(".", $file));
            $nazev=date('Y-m-d_H-i-s');

            //teprve když se obrázek podaří nahrát provedeme sql dotaz
            if(is_uploaded_file($_FILES['soubor']['tmp_name']) && move_uploaded_file($_FILES['soubor']['tmp_name'],"./upload_images/".$nazev.$pripona)){

                if($produktModel->updateProdukt($_POST['nazev_produktu'], $nazev.$pripona,$_POST['cena'],$_POST['popis'],$_POST['znacka'],$_GET['upravid'])){
                        $view_obsah=$view_obsah."<div id='spravne'>Soubor " .$_FILES['soubor']['name']. " byl úspěšně nahrán!<br />Produkt byl úspěšně upraven!</div>";}
                else{$view_obsah=$view_obsah."<div id='chyba'>Soubor " .$_FILES['soubor']['name']. "se nepodařilo nahrát!</div>";}  

                }
        }
        
        if($produktModel->updateProduktBezObrazku($_POST['nazev_produktu'],$_POST['cena'],$_POST['popis'],$_POST['znacka'],$_GET['upravid'])){
                    $view_obsah=$view_obsah."<div id='spravne'>Produkt byl úspěšně upraven!</div>";}
        else{$view_obsah=$view_obsah."<div id='chyba'>Spojení s databází selhalo. </div>";}  
            
        

    }
    else{
        $template_params["obsah_include"]="formularprodukty.twig";
        $template_params['produkt']=$produktModel->vyberProdukt($_GET['upravid']);
        $template_params['znacky']=$produktModel->vyberZnacky();
    }
}
else{
    $view_obsah=$view_obsah."<div id='chyba'>Pro přístup nemáte dostatečné oprávnění.</div>";
}

    
