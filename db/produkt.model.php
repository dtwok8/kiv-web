<?php

class produkt extends model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function pridejProdukt($nazev, $obrazek, $cena, $popis, $znackaId, $uzivatelId){
        $stmt = $this->connect->prepare("INSERT INTO produkty VALUES(NULL, :nazev, :obrazek, :cena, :popis, :znackaId, :uzivatelId)"); 
        $stmt->bindParam(":nazev", $nazev, PDO::PARAM_STR);
        $stmt->bindParam(":obrazek", $obrazek, PDO::PARAM_STR);
        $stmt->bindParam(":cena", $cena, PDO::PARAM_STR);
        $stmt->bindParam(":popis", $popis, PDO::PARAM_STR);
        $stmt->bindParam(":znackaId", $znackaId, PDO::PARAM_STR);
        $stmt->bindParam(":uzivatelId", $uzivatelId, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function vyberProdukt($id) {
        $stmt = $this->connect->prepare("SELECT * FROM produkty p JOIN znacky z ON p.znacka_id=z.id WHERE id_produktu=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function vyberProdukty($znacka, $seradit){
        $stmt = $this->connect->prepare("SELECT * FROM produkty p JOIN znacky z ON p.znacka_id=z.id ".$znacka.$seradit);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function SmazProdukt($smazId){
        $stmt = $this->connect->prepare("DELETE FROM produkty WHERE id_produktu=:smazId");
        $stmt->bindParam(":smazId", $smazId, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
           
    public function updateProdukt($nazev, $obrazek, $cena, $popis, $znackaId, $idProduktu){
        $stmt = $this->connect->prepare("UPDATE produkty SET nazev = :nazev, obrazek = :obrazek, cena=:cena, popis=:popis, znacka_id=:znackaId WHERE id_produktu= :idProduktu ");
        $stmt->bindParam(":nazev", $nazev, PDO::PARAM_STR);
        $stmt->bindParam(":obrazek", $obrazek, PDO::PARAM_STR);
        $stmt->bindParam(":cena", $cena, PDO::PARAM_STR);
        $stmt->bindParam(":popis", $popis, PDO::PARAM_STR);
        $stmt->bindParam(":idProduktu", $idProduktu, PDO::PARAM_STR);
        $stmt->bindParam(":znackaId", $znackaId, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function updateProduktBezObrazku($nazev, $cena, $popis, $znackaId, $idProduktu){
        $stmt = $this->connect->prepare("UPDATE produkty SET nazev = :nazev, cena=:cena, popis=:popis, znacka_id=:znackaId WHERE id_produktu = :idProduktu ");
        $stmt->bindParam(":nazev", $nazev, PDO::PARAM_STR);
        $stmt->bindParam(":cena", $cena, PDO::PARAM_STR);
        $stmt->bindParam(":popis", $popis, PDO::PARAM_STR);
        $stmt->bindParam(":idProduktu", $idProduktu, PDO::PARAM_STR);
        $stmt->bindParam(":znackaId", $znackaId, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function vyberZnacky(){
        $stmt = $this->connect->prepare("SELECT * FROM znacky;");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function vyberOblibeneProdukt($nick) {
        $stmt = $this->connect->prepare("SELECT z.nazev_znacky,p.nazev,p.cena,p.obrazek, p.popis,op.id FROM produkty p JOIN oblibene_produkty op on p.id_produktu=op.produkt_id JOIN znacky z ON p.znacka_id=z.id WHERE op.uzivatel_id=:nick ");
        $stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();  
    }
    
    public function smazOblibenyProdukt($smazId){
        $stmt = $this->connect->prepare("DELETE FROM oblibene_produkty WHERE id=:smazId");
        $stmt->bindParam(":smazId", $smazId, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function pridatDoOblibenych($uzivatel, $produkt) {
        $id=$produkt."_".$uzivatel;
        $stmt = $this->connect->prepare("SELECT 1 FROM oblibene_produkty WHERE id=:id ;");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->fetchColumn(0)){
            return true;
        }
        
        $stmt = $this->connect->prepare("INSERT INTO oblibene_produkty VALUES(:id,:produkt, :uzivatel)"); 
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":uzivatel", $uzivatel, PDO::PARAM_STR);
        $stmt->bindParam(":produkt", $produkt, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function pridatZnacku($nazev){
        $stmt = $this->connect->prepare("INSERT INTO znacky VALUES(NULL,:nazev)"); 
        $stmt->bindParam(":nazev", $nazev, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function vyberZnacku($nazev){
        $stmt = $this->connect->prepare("SELECT * FROM znacky WHERE nazev_znacky=:nazev;");
        $stmt->bindParam(":nazev", $nazev, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
}

