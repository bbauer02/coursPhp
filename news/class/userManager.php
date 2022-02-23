<?php 
require_once('DbConnect.php');

class UserManager extends DbConnect {
  

  public function add(User $user) {
    try {
      $sth = $this->bdd->prepare("INSERT INTO `user`(`id`, `role`, `name`, `lastname`, `email`, `login`, `password`) VALUES (0,:role,:name,:lastname,:email,:login, :password)");
      
      $role = $user->getRole();
      $name = $user->getName();
      $lastname = $user->getLastname();
      $email = $user->getEmail();
      $login = $user->getLogin();
      $password = $user->getPassword();
      
      $sth->bindParam(':role', $role ,PDO::PARAM_INT);
      $sth->bindParam(':name', $name ,PDO::PARAM_STR);
      $sth->bindParam(':lastname', $lastname ,PDO::PARAM_STR);
      $sth->bindParam(':email', $email ,PDO::PARAM_STR);
      $sth->bindParam(':login', $login ,PDO::PARAM_STR);
      $sth->bindParam(':password', $password ,PDO::PARAM_STR);
      $sth->execute();
      $user->setId($this->bdd->lastInsertId());
      return true;
    }
    catch(Exception $e) {
      die("Erreur lors de l'ajout");
    }
  }
  public function edit(User $user) {
    try {
      $sth = $this->bdd->prepare("UPDATE `user` SET `role` = :role, `name` = :name, `lastname` = :lastname, `email` = :email, `login` = :login, `password` = :password WHERE id = :id");
      $role = $user->getRole();
      $name = $user->getName();
      $lastname = $user->getLastname();
      $email = $user->getEmail();
      $login = $user->getLogin();
      $password = $user->getPassword();
      $sth->bindParam(':role', $role ,PDO::PARAM_INT);
      $sth->bindParam(':name', $name ,PDO::PARAM_STR);
      $sth->bindParam(':lastname', $lastname ,PDO::PARAM_STR);
      $sth->bindParam(':email', $email ,PDO::PARAM_STR);
      $sth->bindParam(':login', $login ,PDO::PARAM_STR);
      $sth->bindParam(':password', $password ,PDO::PARAM_STR);
      $sth->execute();
      return true;
    }
    catch(Exception $e) {
      die("Erreur lors de la modification");
    }
  }
  public function delete(User $user) {
    try {
      $sth = $this->bdd->prepare("DELETE FROM `user` WHERE id = :id ");
      $id = $user->getId();
      $sth->bindParam(':id', $id ,PDO::PARAM_INT);
      $sth->execute();
    }
    catch(Exception $e) {
      die("Erreur lors de la suppression");
    }	
  }

  public function selectAll() {
    try {
      $sth = $this->bdd->prepare("SELECT id,role, name, lastname, email,login  FROM `user` ORDER BY lastname, name");
      $sth->execute();
      $users = $sth->fetchAll();
      return $users;
    }
    catch(Exception $e) {
      die("Erreur lors de la suppression");
    }	
  }

}
