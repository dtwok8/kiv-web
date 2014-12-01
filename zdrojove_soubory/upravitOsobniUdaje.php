<?php




if($uzivatel!==false){
    if(isset($_POST['jmeno'])){
        if(!empty($_POST['heslo']) && !empty($_POST['email'])){
            if($userModel->souhlasiHeslo($_POST['heslo'], $uzivatel->nick)){
                if($userModel->upravOsobniUdaje($_POST['jmeno'], $_POST['prijmeni'], $_POST['email'],$uzivatel->nick )){
                    $view_obsah=$view_obsah."<div id='spravne'>Osobní informace byly upraveny!</div>";
                    $uzivatel->probehlaUprava($_POST['jmeno'], $_POST['prijmeni'], $_POST['email']);
                    $_SESSION['user'] = serialize($uzivatel); 
                }
                else{
                    $view_obsah=$view_obsah."<div id='chyba'>Spojení s databází selhalo!</div>";
                }
            }else{
                $view_obsah=$view_obsah."<div id='chyba'>Zadali jste špatné heslo!</div>";
            }
        }
    }
    $view_obsah=$view_obsah."<h1>Uprava osobních udajů</h1>";
    $template_params['data']=array('jmeno' => $uzivatel->jmeno, 'prijmeni'=> $uzivatel->prijmeni, 'email'=> $uzivatel->email);
    $template_params["obsah_include"]="formularUpravaOsobnichUdaju.twig";
}
else{
    $view_obsah=$view_obsah."<div id='chyba'>Pro přístup nemáte dostatečné oprávnění.</div>";
}
