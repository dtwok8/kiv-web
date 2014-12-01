<?php
session_start();
//připojení do databáze
//require './class/db.class.php';
//$spojeni=new db("localhost", "kosmeticke_sluzby", "root", "");
  $host ="localhost";
  $name = "kosmeticke_sluzby";
  $user = "root";
  $pass ="";
  
  define("HOST", "localhost");
  define("NAME", "kosmeticke_sluzby");
  define("USER", "root");
  define("PASS", "");
  require './db/model.php';
 
  //user
  require './db/user.model.php';
  $userModel=new user_model();
  require './class/user.class.php';
  
  
//potřebujeme dostat objekt uživatel ze sesion
if(isset($_SESSION['user'])){$uzivatel = unserialize(stripslashes($_SESSION['user']));}
else{$uzivatel=false;}

//eskejpovací funkce
function escapovat($text_na_eskejpovani) {
    return $text_na_eskejpovani;
}
?>