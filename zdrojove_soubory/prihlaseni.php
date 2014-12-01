<?php
$view_login="";
$template_params['chyba']="";

//Odhlášení uživatele//

if(isset($_GET['odhlasit'])){
    session_destroy();
    unset($_SESSION);
    $uzivatel=false; 
}
            
//Upravení adresy kvůli get-odeslat //    
    //nefunguje musela bych udělat do formuláře action        
unset($_GET['odhlasit']);
$adresa="index.php?".http_build_query($_GET);


if(isset($_POST['log_nick']) && !isset($_SESSION['user']) && (!empty($_POST['log_nick']) || !empty($_POST['log_heslo']))){
    $uzivatel=new user($_POST['log_nick'],$_POST['log_pw'], $userModel);
    if($uzivatel->exist()){
        $_SESSION['user'] = serialize($uzivatel); 
         
        $view_login=$view_login."<span class='prihlaseni'><p>Vítejte ".$uzivatel->nick."<br /><a href='index.php?odhlasit'>Odhlásit</a></p></span>";
    }else{
        $template_params['chyba']="Nesprávné jméno nebo heslo";
        $template_params['login_include']="prihlaseni.html";
    }
}else if(isset($_SESSION['user'])){
    $uzivatel = unserialize($_SESSION['user']);
    $view_login=$view_login."<span class='prihlaseni'><p>Přihlášen: ".$uzivatel->nick."<br /><a href='index.php?odhlasit'>Odhlásit</a></p></span>";
}else{
    $template_params['login_include']="prihlaseni.html";
}