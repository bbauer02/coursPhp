<?php 
namespace Studio\Lotr\v1;

require_once('Personnage.php');

class Magicien extends \Personnage {
  private $magie;

  function __construct($nom="default", $pdv=100, $magie=50) {
    $this->setMagie($magie);
    parent::__construct($nom,$pdv);
  }

  public function fireBall(\Personnage $target) {
    $degat = rand(0,$this->getMagie());
    echo $this->getNom() . " lance une boule de feu et inflige <strong>" . $degat . "</strong> points de dégats à <strong>". $target->getNom()."</strong> <br>"; 
    return $degat;
  } 
  public function thunderBolt($target) {
    $degat = rand(0,$this->getMagie());
    echo $this->getNom() . " lance un éclair et inflige <strong>" . $degat . "</strong> points de dégats à <strong>". $target->getNom()."</strong> <br>"; 
    return $degat;
  } 
  public function setMagie($magie) {
    $this->magie = $magie;
  }
  public function getMagie() {
    return $this->magie;
  }
}

namespace Studio\Lotr\v2;
require_once('Personnage.php');

class Magicien extends \Personnage {
  private $magie;

  function __construct($nom="default", $pdv=100, $magie=50) {
    $this->setMagie($magie);
    parent::__construct($nom,$pdv);
  }

  public function fireBall(\Personnage $target) {
    $degat = rand(0,$this->getMagie());
    echo $this->getNom() . " lance une boule de feu et inflige <strong>" . $degat . "</strong> points de dégats à <strong>". $target->getNom()."</strong> <br>"; 
    return $degat;
  } 
  public function thunderBolt($target) {
    $degat = rand(0,$this->getMagie());
    echo $this->getNom() . " lance un éclair et inflige <strong>" . $degat . "</strong> points de dégats à <strong>". $target->getNom()."</strong> <br>"; 
    return $degat;
  } 
  public function frostBolt($target) {
    $degat = rand(0,$this->getMagie());
    echo $this->getNom() . " lance de la glace et inflige <strong>" . $degat . "</strong> points de dégats à <strong>". $target->getNom()."</strong> <br>"; 
    return $degat;
  } 

  public function setMagie($magie) {
    $this->magie = $magie;
  }
  public function getMagie() {
    return $this->magie;
  }
}