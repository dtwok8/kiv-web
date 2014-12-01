<?php
class user_model extends model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function pridat($nick, $jmeno, $prijmeni, $heslo, $mail){
        $heslo=md5($heslo);
        $stmt = $this->connect->prepare("INSERT INTO users VALUES(:nick, :jmeno, :prijmeni, :heslo, 'uzivatel', :mail)");
        
        $stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
        $stmt->bindParam(":jmeno", $jmeno, PDO::PARAM_STR);
        $stmt->bindParam(":prijmeni", $prijmeni, PDO::PARAM_STR);
        $stmt->bindParam(":heslo", $heslo, PDO::PARAM_STR);
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
        return $stmt->execute();
         //ověřit že nick existuje  
    }
    
    public function existNick($nick){
        $stmt = $this->connect->prepare("SELECT 1 FROM users WHERE nick=:nick ");
        $stmt->bindParam(":nick", $nick, PDO::PARAM_STR);    
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
    
    function prihlasit($nick, $heslo){
        $stmt = $this->connect->prepare("SELECT * FROM users WHERE nick=:nick AND heslo=:heslo ;");
        $stmt->bindParam(":nick", $nick, PDO::PARAM_STR); 
        $stmt->bindParam(":heslo", $heslo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();    
    }
    
    function vyberVsechnyUzivatele(){
        $stmt = $this->connect->prepare("SELECT nick,jmeno, prijmeni,prava, email FROM users;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    function smazUzivatele($uzivateleNaSmazani){       
        $stmt = $this->connect->prepare("DELETE FROM users WHERE nick IN(:uzivateleNaSmazani) AND prava!='admin';");
        $stmt->bindParam(":uzivateleNaSmazani", $uzivateleNaSmazani, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    function isAdmin($nick){
        $stmt = $this->connect->prepare("SELECT prava FROM users WHERE nick=:nick ");
        $stmt->bindParam(":nick", $nick, PDO::PARAM_STR);    
        $stmt->execute();

        if($stmt->fetchColumn(0)=='admin'){
            return true;
        }
        return false;
    }
    
    function upravOsobniUdaje($jmeno, $prijmeni, $email, $nick){
        $stmt = $this->connect->prepare("UPDATE users SET jmeno = :jmeno, prijmeni = :prijmeni, email = :email WHERE nick = :nick ");
        $stmt->bindParam(":jmeno", $jmeno, PDO::PARAM_STR);
        $stmt->bindParam(":prijmeni", $prijmeni, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    function souhlasiHeslo($heslo, $nick){
        $heslo=md5($heslo);
        $stmt = $this->connect->prepare("SELECT 1 FROM users WHERE nick=:nick AND heslo=:heslo ;");
        $stmt->bindParam(":nick", $nick, PDO::PARAM_STR); 
        $stmt->bindParam(":heslo", $heslo, PDO::PARAM_STR);  
        $stmt->execute();
        return $stmt->fetchColumn(0);
      }
     
      
}

