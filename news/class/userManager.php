<?php 
require_once('DbConnect.php');


class UserManager extends DbConnect {
  

  public function add( User $user ) {
    try {
      $sth = $this->bdd->prepare("INSERT INTO `user`(`id`, `role`, `name`, `lastname`, `email`, `login`, `password`) VALUES (0,:role,:name,:lastname,:email,:login, :password)");
      
      $role = $user->getRole();
      $name = $user->getName();
      $lastname = $user->getLastname();
      $email = $user->getEmail();
      $login = $user->getLogin();
      $password = $user->getPassword();
      
      $sth->bindParam(':role', $role ,\PDO::PARAM_INT);
      $sth->bindParam(':name', $name ,\PDO::PARAM_STR);
      $sth->bindParam(':lastname', $lastname ,\PDO::PARAM_STR);
      $sth->bindParam(':email', $email ,\PDO::PARAM_STR);
      $sth->bindParam(':login', $login ,\PDO::PARAM_STR);
      $sth->bindParam(':password', SHA1($password) ,\PDO::PARAM_STR);
      $sth->execute();
      $userId = $this->bdd->lastInsertId();
      return $userId;
    }
    catch(\Exception $e) {
      die("Erreur lors de l'ajout d'un auteur");
    }
  }
  public function edit(User $user) {
    try {
      $sth = $this->bdd->prepare("UPDATE `user` SET `role` = :role, `name` = :name, `lastname` = :lastname, `email` = :email, `login` = :login, `password` = :password WHERE id = :id");
      $id = $user->getId();
	  $role = $user->getRole();
      $name = $user->getName();
      $lastname = $user->getLastname();
      $email = $user->getEmail();
      $login = $user->getLogin();
      $password = $user->getPassword();
      $sth->bindParam(':role', $role ,\PDO::PARAM_INT);
      $sth->bindParam(':name', $name ,\PDO::PARAM_STR);
      $sth->bindParam(':lastname', $lastname ,\PDO::PARAM_STR);
      $sth->bindParam(':email', $email ,\PDO::PARAM_STR);
      $sth->bindParam(':login', $login ,\PDO::PARAM_STR);
      $sth->bindParam(':password', SHA1($password) ,\PDO::PARAM_STR);
      $sth->bindParam(':id', $id ,\PDO::PARAM_INT);
      $sth->execute();
      return true;
    }
    catch(\Exception $e) {
      die("Erreur lors de la modification d'un auteur");
    }
  }
  public function delete(User $user) {
    try {
      $sth = $this->bdd->prepare("DELETE FROM `user` WHERE id = :id ");
      $id = $user->getId();
      $sth->bindParam(':id', $id ,\PDO::PARAM_INT);
      $sth->execute();
    }
    catch(\Exception $e) {
      die("Erreur lors de la suppression d'un auteur");
    }	
  }

  public function selectAll() {
    try {
      $sth = $this->bdd->prepare("SELECT id,role, name, lastname, email,login  FROM `user` ORDER BY lastname, name");
      $sth->execute();
      $users = $sth->fetchAll(\PDO::FETCH_ASSOC);
      $Users = [];
      foreach($users as $user) {
        $Users[] = new \User($user['id'],$user['role'],$user['name'], $user['lastname'],$user['email'], $user['login'] );
      }
      return $Users;
    }
    catch(\Exception $e) {
      die("Erreur lors de la récupération de l'ensemble des auteurs");
    }	
  }
  
  public function userData(int $idUser) {
    try {
      $sth = $this->bdd->prepare("SELECT id, role, name, lastname, email, login FROM `user` WHERE id = :id ");
	  $sth->bindParam(':id', $idUser ,\PDO::PARAM_INT);
	  $sth->execute();
      $user = $sth->fetch(\PDO::FETCH_ASSOC);
      $dataUser = new \User($user['id'], $user['role'], $user['name'], $user['lastname'], $user['email'], $user['login'] );
      
      return $dataUser;
    }
    catch(\Exception $e) {
      die("Erreur lors de la récupération des données de l'auteur");
    }	
  }
  
}
