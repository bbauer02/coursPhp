<?php 
require_once('DbConnect.php');

class PersonnageManager extends DbConnect {

  public function save($personne) {
    $sth = $this->bdd->prepare("INSERT INTO `personnage`(`id`, `nom`, `pdv`, `force`, `magie`, `classe`) VALUES (0,:nom,:pdv,:force,:magie,:classe)");
    $nom = $personne->getNom();
    $pdv = $personne->getPdv();

    $magie = null;
    if(method_exists($personne, 'getMagie')) $magie = $personne->getMagie();

    $force = null;
    if(method_exists($personne, 'getForce')) $force = $personne->getForce();

    $classe = get_class($personne);
    
    $sth->bindParam(':nom', $nom ,PDO::PARAM_STR);
    $sth->bindParam(':pdv', $pdv ,PDO::PARAM_INT);
    $sth->bindParam(':magie', $magie,PDO::PARAM_INT);
    $sth->bindParam(':force', $force,PDO::PARAM_INT);
    $sth->bindParam(':classe', $classe ,PDO::PARAM_STR);
    $sth->execute();
	
  }
  
  
  public function edit($personne) {
    $sth = $this->bdd->prepare("UPDATE `personnage` SET `pdv` = :pdv, `force` = :force, `magie` = :magie, `classe` = :classe WHERE nom = :nom");
    $nom = $personne->getNom();
    $pdv = $personne->getPdv();

    $magie = null;
    if(method_exists($personne, 'getMagie')) $magie = $personne->getMagie();

    $force = null;
    if(method_exists($personne, 'getForce')) $force = $personne->getForce();

    $classe = get_class($personne);
    
    $sth->bindParam(':nom', $nom ,PDO::PARAM_STR);
    $sth->bindParam(':pdv', $pdv ,PDO::PARAM_INT);
    $sth->bindParam(':magie', $magie,PDO::PARAM_INT);
    $sth->bindParam(':force', $force,PDO::PARAM_INT);
    $sth->bindParam(':classe', $classe ,PDO::PARAM_STR);
    $sth->execute();
	
  }
  
  public function delete($personne) {
    $sth = $this->bdd->prepare("DELETE FROM `personnage` WHERE nom = :nom ");
    $nom = $personne->getNom();
    
    $sth->bindParam(':nom', $nom ,PDO::PARAM_STR);
    $sth->execute();
	
	var_dump($sth);
  }
  
}
