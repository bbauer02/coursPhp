<?php 
require_once('DbConnect.php');

class TagManager extends DbConnect {
  

  public function add(Tag $tag) {
    try {
      $sth = $this->bdd->prepare("INSERT INTO `tag`(`id`, `label`) VALUES (0,:label)");
      
      $label = $tag->getLabel();
      
      $sth->bindParam(':label', $label ,PDO::PARAM_STR);
      $sth->execute();
      $tag->setId($this->bdd->lastInsertId());
      return true;
    }
    catch(Exception $e) {
      die("Erreur lors de l'ajout");
    }
  }
  public function edit(Tag $tag) {
    try {
      $sth = $this->bdd->prepare("UPDATE `tag` SET `label` = :label WHERE id = :id");
      $label = $tag->getLabel();
      $sth->bindParam(':label', $label ,PDO::PARAM_STR);
      $sth->execute();
      return true;
    }
    catch(Exception $e) {
      die("Erreur lors de la modification");
    }
  }
  public function delete(Tag $tag) {
    try {
      $sth = $this->bdd->prepare("DELETE FROM `tag` WHERE id = :id ");
      $id = $tag->getId();
      $sth->bindParam(':id', $id ,PDO::PARAM_INT);
      $sth->execute();
    }
    catch(Exception $e) {
      die("Erreur lors de la suppression");
    }	
  }

  public function selectAll() {
    try {
      $sth = $this->bdd->prepare("SELECT id, label FROM `tag` ORDER BY label");
      $sth->execute();
      $tag_list = $sth->fetchAll(PDO::FETCH_ASSOC);
	  
	  
	  $Tag = array();	  
	  
	  foreach($tag_list as $tag) {
				
	    $Tag[] = new Tag($tag['id'], $tag['label']);
	  
	  }
	  
      return $Tag;
    }
    catch(Exception $e) {
      die("Erreur lors de la suppression");
    }	
  }

  public function addNews(Tag $tag,News $news) {
    try {
      $sth = $this->bdd->prepare("INSERT INTO `news_has_tag`(`id`, `news_id`, `tag_id`) VALUES (0,:news_id,:tag_id)");
      $news_id = $news->getId();
      $tag_id = $tag->getId();  
      $sth->bindParam(':news_id', $news_id ,PDO::PARAM_INT);
      $sth->bindParam(':tag_id', $tag_id ,PDO::PARAM_INT);
      $sth->execute();
      $news->setId($this->bdd->lastInsertId());
      return true;
    }
    catch(Exception $e) {
      die("Erreur lors de l'ajout");
    }
  }

  public function removeNews(Tag $tag, News $news ) {
    try {
      $sth = $this->bdd->prepare("DELETE FROM `news_has_tag` WHERE news_id = :news_id AND tag_id = :tag_id ");
      $news_id = $news->getId();
      $tag_id = $tag->getId();  
      $sth->bindParam(':news_id', $news_id ,PDO::PARAM_INT);
      $sth->bindParam(':tag_id', $tag_id ,PDO::PARAM_INT);
      $sth->execute();
    }
    catch(Exception $e) {
      die("Erreur lors de la suppression du tag de l'article");
    }	
  }

  public function removeAllNews(Tag $tag, array $news) {
    try {

      $sth = $this->bdd->prepare("DELETE FROM `news_has_tag` WHERE  tag_id = :tag_id AND news_id IN ( :listOfNewsId ) ");
      $listOfNewsId = implode(',',$news); 
      $tag_id = $tag->getId(); 
      $sth->bindParam(':listOfNewsId', $listOfNewsId ,PDO::PARAM_STR);
      $sth->bindParam(':tag_id', $tag_id ,PDO::PARAM_INT);
      $sth->execute();
    }
    catch(Exception $e) {
      die("Erreur lors de la suppression du tag de l'article");
    }	
  }


}
