<?php 

class DbConnect {

  protected $bdd;

  function __construct() {
    try {
      $this->bdd = new PDO('mysql:host=localhost;dbname=formationphp;charset=utf8', 'root', '');
    }
    catch (Exception $e) {
      die('Erreur connexion à la BDD');
    }
  }

}