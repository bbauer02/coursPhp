<?php 

class News {
  private $id;
  private $title;
  private $content;
  private $date;
  private $author;

  function __construct(int $id = null, string $title=null, $content=null, $date=null, User $author=null) {
    $this->setId($id);
    $this->setTitle($title);
    $this->setContent($content);
    $this->setDate($date);
    $this->setAuthor($author);
  } 
  /*
   GETTERS 
  */
  public function getId() {
    return $this->id;
  }
  public function getTitle() {
    return $this->title;
  }
  public function getContent() {
    return $this->content;
  }
  public function getDate() {
    return $this->date;
  }
  public function getAuthor() {
    return $this->author;
  }
  /*
   SETTERS 
  */
  public function setId($id) {
    $this->id= $id;
  }
  public function setTitle($title) {
    $this->title= $title;
  }
  public function setContent($content) {
    $this->content= $content;
  }
  public function setDate($date) {
    $this->date= $date;
  }
  public function setAuthor($author) {
    $this->author= $author;
  }

}