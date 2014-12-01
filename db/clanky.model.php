<?php

class clanky extends model {

    public function __construct() {
        parent::__construct();
    }

    public function vyberClanky() {
        return $this->connect->query("SELECT * FROM clanky WHERE id!=12 ;")->fetchAll();
    }

    public function vyberObsahClanku($id) {
        $stmt = $this->connect->prepare("SELECT * FROM clanky WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function pridejClanek($titulek, $obsah, $uzivatel_id){
        $stmt = $this->connect->prepare("INSERT INTO clanky VALUES(NULL, :titulek, :obsah, :uzivatel_id)"); 
        $stmt->bindParam(":titulek", $titulek, PDO::PARAM_STR);
        $stmt->bindParam(":obsah", $obsah, PDO::PARAM_STR);
        $stmt->bindParam(":uzivatel_id", $uzivatel_id, PDO::PARAM_STR);
        return $stmt->execute();
    }
       
    public function updateClanek($titulek, $obsah, $idClanku){
        $stmt = $this->connect->prepare("UPDATE clanky SET titulek = :titulek, obsah = :obsah WHERE id = :idClanku ");
        $stmt->bindParam(":titulek", $titulek, PDO::PARAM_STR);
        $stmt->bindParam(":obsah", $obsah, PDO::PARAM_STR);
        $stmt->bindParam(":idClanku", $idClanku, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function smazClanek($smazId){
        $stmt = $this->connect->prepare("DELETE FROM clanky WHERE id=:smazId AND id!=12;");
        $stmt->bindParam(":smazId", $smazId, PDO::PARAM_STR);
        return $stmt->execute();
    }
            
}
