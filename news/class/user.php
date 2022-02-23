<?php 

class User {
  private $id;
  private $role;
  private $name;
  private $lastname;
  private $email;
  private $login;
  private $password;

  function __construct(int $id = null, int $role =null,string $name=null, $lastname=null, $email=null, $login=null, $password=null) {
    $this->setId($id);
    $this->setRole($role);
    $this->setName($name);
    $this->setLastname($lastname);
    $this->setEmail($email);
    $this->setLogin($login);
    $this->setPassword($password);
  } 
  /*
   GETTERS 
  */
  public function getId() {
    return $this->id;
  }
  public function getRole() {
    return $this->role;
  }
  public function getName() {
    return $this->name;
  }
  public function getLastname() {
    return $this->lastname;
  }
  public function getEmail() {
    return $this->email;
  }
  public function getLogin() {
    return $this->login;
  }
  public function getPassword() {
    return $this->password;
  }
  /*
   SETTERS 
  */
  public function setId($id) {
    $this->id= $id;
  }
  public function setRole($role) {
    $this->role= $role;
  }
  public function setName($name) {
    $this->name= $name;
  }
  public function setLastname($lastname) {
    $this->lastname= $lastname;
  }
  public function setEmail($email) {
    $this->email= $email;
  }
  public function setLogin($login) {
    $this->login= $login;
  }
  public function setPassword($password) {
    $this->password= $password;
  }

}