<?php 
require_once('DbConnect.php');

class TagManager extends DbConnect {
  

  public function add(Tag $tag) {
    try {
      $sth = $this->bdd->prepare("INSERT INTO `tag`(`id`, `label`) VALUES (0,:label)");
      
      $label = $tag->getLabel();
      
      $sth->bindParam(':label', $label ,PDO::PARAM_STR);
      $sth->execute();
      
      $tagId = $this->bdd->lastInsertId();
      return $tagId;
    }
    catch(Exception $e) {
      die("Erreur lors de l'ajout du tag");
    }
  }
  public function edit(Tag $tag) {
    try {
      $sth = $this->bdd->prepare("UPDATE `tag` SET `label` = :label WHERE id = :id");
      $label = $tag->getLabel();
	  $id = $tag->getId();
      $sth->bindParam(':label', $label ,PDO::PARAM_STR);
      $sth->bindParam(':id', $id ,PDO::PARAM_INT);
      $sth->execute();
      return true;
    }
    catch(Exception $e) {
      die("Erreur lors de la modification du tag");
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
      die("Erreur lors de la suppression du tag");
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
      die("Erreur lors de la récupération de la liste des tags");
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
      die("Erreur lors de l'affectation du tag à l'actualité");
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
      die("Erreur lors de la suppression du tag associé à l'article");
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
      die("Erreur lors de la suppression de l'ensemble des tags associés à l'article");
    }	
  }

  public function tagData(int $idTag) {
    try {
      $sth = $this->bdd->prepare("SELECT id, label FROM `tag` WHERE id = :id ");
	  $sth->bindParam(':id', $idTag ,\PDO::PARAM_INT);
	  $sth->execute();
      $tag = $sth->fetch(\PDO::FETCH_ASSOC);
      $dataTag = new \Tag($tag['id'], $tag['label']);
      
      return $dataTag;
    }
    catch(\Exception $e) {
      die("Erreur lors de la récupération des données du tag");
    }	
  }

}
