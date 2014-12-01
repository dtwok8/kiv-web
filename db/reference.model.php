<?php

class reference extends model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function vyberReference() {
        return $this->connect->query("SELECT id,titulek, obsah, nick FROM reference r JOIN users u ON r.uzivatel_id= u.nick;")->fetchAll();
    }
    
    public function pridejReferenci($titulek, $obsah, $uzivatel_id){
        $stmt = $this->connect->prepare("INSERT INTO reference VALUES(NULL, :titulek, :obsah, :uzivatel_id)"); 
        $stmt->bindParam(":titulek", $titulek, PDO::PARAM_STR);
        $stmt->bindParam(":obsah", $obsah, PDO::PARAM_STR);
        $stmt->bindParam(":uzivatel_id", $uzivatel_id, PDO::PARAM_STR);
        return $stmt->execute();
    }
 
    public function smazReferenci($smazId){
        $stmt = $this->connect->prepare("DELETE FROM reference WHERE id=:smazId");
        $stmt->bindParam(":smazId", $smazId, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
}

