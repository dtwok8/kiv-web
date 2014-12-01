<?php 
        require 'config.php';
       //require './class/user.class.php';

	// Twig stahnout z githubu - klidne staci zip a dat do slozky twig-master
	// kontrolu provedete dle umisteni souboru Autoloader.php, ktery prikladam pro kontrolu
	
	// nacist twig - kopie z dokumentace
	require_once 'twig-master/lib/Twig/Autoloader.php';
	Twig_Autoloader::register();
	// cesta k adresari se sablonama - od index.php
	$loader = new Twig_Loader_Filesystem('sablony');
	$twig = new Twig_Environment($loader); // takhle je to bez cache
	// nacist danou sablonu z adresare
	$template = $twig->loadTemplate('default.twig');
	
	// render vrati data pro vypis nebo display je vypise
	// v poli jsou data pro vlozeni do sablony
        
        $template_params = array();
        $template_params["hlavicka"] = "";
        
        //databaze
        require './db/clanky.model.php';
        $clankyModel = new clanky();
        require './db/produkt.model.php';
        $produktModel = new produkt();
        require './db/reference.model.php';
        $referenceModel = new reference();
   
        $view_login="";
        $template_params['login_include']="empty.html";
        require './zdrojove_soubory/prihlaseni.php';
        $template_params['login']=$view_login;
        
        
        require './zdrojove_soubory/menu.php';
        $template_params["menu"] = $view_menu;
        
        $view_obsah="";
        $template_params["obsah_include"]="empty.html"; 
        require './zdrojove_soubory/obsah.php';
	$template_params["obsah"] = $view_obsah;
        
	$template_params["nadpis1"] = "Nadpis 1";
        

	echo $template->render($template_params);
?>