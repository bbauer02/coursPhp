<?php 
require_once('Personnage.php');

abstract class Personnage {

  private $nom;
  private $pdv; 

  function __construct($nom="default", $pdv=100,$force="25") {
    $this->setNom($nom);
    $this->setPdv($pdv);
  } 
    // Getters
    public function getNom() {
      return $this->nom;
    }
  // Setters
  public function setNom($nom) {
    $this->nom = ucfirst($nom);
  }
  public function setPdv($pdv) {
    $this->pdv = $pdv;
  }
  public function getPdv() {
    return $this->pdv;
  }

  public function setHurt($hit) {
    $newPdv = $this->getPdv() - $hit;
    $this->setPdv($newPdv);
  }

  public function jump() {
    echo "$this->nom  saute haut ! [CLASSE Personnage] <br>";
  }

  abstract public function walk();

}