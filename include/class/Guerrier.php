<?php
namespace Studio\Lotr\v1;

require_once('Personnage.php');

class Guerrier extends \Personnage {
  private $force;
  function __construct($nom="default", $pdv=100,$force="25") {
    $this->setForce($force);
    parent::__construct($nom,$pdv);
  }
  public function setForce($force) {
    $this->force = $force;
  }
  public function getForce() {
    return $this->force;
  }
  // Skills
 public function punch(\Personnage $target) {
    $degat = rand(0,$this->getForce());
    $target->setHurt($degat);
    echo $this->getNom() . " donne un coup de poing et inflige <strong> $degat </strong> points de dégats à <strong>". $target->getNom()."</strong> <br>"; 
  } 

  public function lowKick(\Personnage $target) {
    $degat = rand(0,$this->getForce());
    $target->setHurt($degat);
    echo $this->getNom() . " donne un coup de pied et inflige <strong> $degat </strong> points de dégats à <strong>". $target->getNom()."</strong> <br>"; 
  } 
}
