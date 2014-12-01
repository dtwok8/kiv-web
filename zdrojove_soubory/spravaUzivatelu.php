<?php   
if($uzivatel!==false && $uzivatel->isAdmin()){

    if(isset($_GET['id']) && !empty($_GET['id'])){

        if($userModel->isAdmin($_GET['id'])){
            $view_obsah=$view_obsah."<div id='chyba'>Pro smazání položky ".$_GET['id']." nemáte dostatečné oprávnění</div>";
        }
        else{   
            if($userModel->smazUzivatele($_GET['id'])){
                 $view_obsah=$view_obsah."<div id='spravne'>Uživatelé byli úspěšně smazány!</div>";
            }else{$view_obsah=$view_obsah."<div id='chyba'>Spojení s databází selhalo</div>";}
        }  
    }
    $sprava_uzivatelu=$userModel->vyberVsechnyUzivatele();

    $view_obsah=$view_obsah."<form action='index.php?stranka=spravaUzivatelu' method='post'><table border='1' class='tabulka_sprava_uzivatelu'>";
    $view_obsah=$view_obsah."<tr><th>Nick</th><th>Jméno</th><th>Příjmení</th><th>Práva</th><th>E-mail</th><th>Označit pro<br />smazání</th></tr>";
        foreach($sprava_uzivatelu AS $radek){
            $view_obsah=$view_obsah."<tr>";
            foreach($radek AS $polozka){
                $view_obsah=$view_obsah."<td>".$polozka."</td>";
            }
            if($radek['prava']!=='admin'){
                $view_obsah=$view_obsah."<td><a href='index.php?stranka=spravaUzivatelu&id=".$radek['nick']."' >Smazat</a></td></tr>";
            }
            else{
                $view_obsah=$view_obsah."<td></td></tr>";
            }
        }
        $view_obsah=$view_obsah."<tr><td colspan='5'></td><td><input type='submit' value='Smazat'></td></tr>
           </table></form>";
} else{$view_obsah=$view_obsah."Přístup odepřen!";}
?>
