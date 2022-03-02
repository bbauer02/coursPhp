<?php 

class Tag {
  private $id;
  private $label;

  function __construct(int $id = null, string $label=null) {
    $this->setId($id);
    $this->setLabel($label);
  } 
  /*
   GETTERS 
  */
  public function getId() {
    return $this->id;
  }
  public function getLabel() {
    return $this->label;
  }
  /*
   SETTERS 
  */
  public function setId($id) {
    $this->id= $id;
  }
  public function setLabel($label) {
    $this->label= $label;
  }

}