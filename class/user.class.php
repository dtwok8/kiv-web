<?php
class user{
    private $nick;
    private $jmeno;
    private $prijmeni;
    private $prava;
    private $email;

    private $_getters = array('nick', 'jmeno', 'prijmeni','prava','email');

    public function __construct($nick,$heslo, $userModel) {
        $uzivatel= $userModel->prihlasit($nick,md5($heslo));
        
        $this->nick=$uzivatel['nick'];
        $this->jmeno=$uzivatel['jmeno'];
        $this->prijmeni=$uzivatel['prijmeni'];
        $this->prava=$uzivatel['prava'];
        $this->email=$uzivatel['email']; 
    }
    
    public function __get($nazev) {
        if(in_array($nazev, $this->_getters)){return $this->$nazev;}
        else{return null;}
    }

    public function exist(){
        if($this->nick===NULL){return false;}
        else{return true;}
        } 

    public function isAdmin(){
        if($this->prava==="admin"){return true;}
        else{return false;}
    }

    public function kontrola(){
        if(!empty($_POST['nick']) && !empty($_POST['heslo']) && !empty($_POST['heslo_znovu']) && !empty($_POST['mail'])){
            return true;}
        else{return false;}
    }
    
    public function probehlaUprava($jmeno, $prijmeni, $email){
        $this->jmeno=$jmeno;
        $this->prijmeni=$prijmeni;
        $this->email=$email;
    }
    
    // public function existNick(){
     //   return true;
        //return $this->usermodel->existNick($nick);
    //}
    
    /*
    public function souhlasiHeslo($nick, $heslo){
        return $this->userModel->souhlasiHeslo($nick, $heslo);
    }
   */
      
      /* možno smazat */
      /*
       * 
    function kontrola_prihlasovaciho_formulare(){
        if(isset($_POST['log_nick']) && !isset($_SESSION['user']) && (!empty($_POST['log_nick']) || !empty($_POST['log_heslo']))){
            return true;
        }
          else{return false;}
      }
       */
}