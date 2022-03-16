<?php 
require_once('DbConnect.php');

class NewsManager extends DbConnect {
  

  public function add(News $news) {
    try {
      $sth = $this->bdd->prepare("INSERT INTO `news`(`id`, `title`, `content`, `date`, `author`) VALUES (0,:title,:content,:date,:author)");
      
      $title = $news->getTitle();
      $content = $news->getContent();
      $date = $news->getDate();
      $author = $news->getAuthor();
      
      $sth->bindParam(':title', $title ,PDO::PARAM_STR);
      $sth->bindParam(':content', $content ,PDO::PARAM_STR);
      $sth->bindParam(':date', $date ,PDO::PARAM_STR);
      $sth->bindParam(':author', $author ,PDO::PARAM_INT);
      $sth->execute();
      $newsId = $this->bdd->lastInsertId();
      return $newsId;
    }
    catch(Exception $e) {
      die("Erreur lors de l'ajout d'une actualité");
    }
  }
  public function edit(News $news) {
    try {
      $sth = $this->bdd->prepare("UPDATE `news` SET `title` = :title, `content` = :content, `date` = :date, `author` = :author WHERE id = :id");
      $title = $news->getTitle();
      $content = $news->getContent();
      $date = $news->getDate();
      $author = $news->getAuthor();
      $id = $news->getId();
	  $sth->bindParam(':title', $title ,PDO::PARAM_STR);
      $sth->bindParam(':content', $content ,PDO::PARAM_STR);
      $sth->bindParam(':date', $date ,PDO::PARAM_STR);
      $sth->bindParam(':author', $author ,PDO::PARAM_INT);
      $sth->bindParam(':id', $id ,PDO::PARAM_INT);
      $sth->execute();
      return true;
    }
    catch(Exception $e) {
      die("Erreur lors de la modification d'une actualité");
    }
  }
  public function delete(News $news) {
    try {
      $sth = $this->bdd->prepare("DELETE FROM `news` WHERE id = :id ");
      $id = $news->getId();
      $sth->bindParam(':id', $id ,PDO::PARAM_INT);
      $sth->execute();
    }
    catch(Exception $e) {
      die("Erreur lors de la suppression d'une actualité");
    }	
  }

  public function selectAll() {
    try {
      $sth = $this->bdd->prepare("SELECT news.id, title, content, date, user.id as user_id, role, name, lastname, email, login FROM `news` LEFT JOIN user ON news.author = user.id ORDER BY date");
      $sth->execute();
      $news_list = $sth->fetchAll(PDO::FETCH_ASSOC);
	  
	  
	  $News = array();	  
	  
	  foreach($news_list as $news) {
		
		$author = new User($news['user_id'], $news['role'], $news['name'], $news['lastname'], $news['email'], $news['login']);
		
	    $News[] = new News($news['id'], $news['title'], $news['content'], $news['date'], $author);
	  
	  }
  
      return $News;
    }
    catch(Exception $e) {
      die("Erreur lors de la récupération de la liste des actualités");
    }	
  }
  
  public function newsData(int $idNews) {
    try {
      $sth = $this->bdd->prepare("SELECT news.id, title, content, date, user.id as user_id, role, name, lastname, email, login FROM `news` LEFT JOIN user ON news.author = user.id WHERE id = :id ");
	  $sth->bindParam(':id', $idNews ,\PDO::PARAM_INT);
	  $sth->execute();
      $news = $sth->fetch(\PDO::FETCH_ASSOC);
      
	  $author = new User($news['user_id'], $news['role'], $news['name'], $news['lastname'], $news['email'], $news['login']);
	  
	  $dataNews = new News($news['id'], $news['title'], $news['content'], $news['date'], $author);
      
      return $dataNews;
    }
    catch(\Exception $e) {
      die("Erreur lors de la récupération des données de l'actualité");
    }	
  }
  
  public function addTag(News $news, Tag $tag) {
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
      die("Erreur lors de l'ajout du tag");
    }
  }

  public function removeTag(News $news, Tag $tag) {
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

  public function removeAllTags(News $news, array $tags) {
    try {

      $sth = $this->bdd->prepare("DELETE FROM `news_has_tag` WHERE news_id = :news_id AND tag_id IN ( :listOfTagsId ) ");
      $listOfTagsId = implode(',',$tags); 
      $news_id = $news->getId(); 
      $sth->bindParam(':listOfTagsId', $listOfTagsId ,PDO::PARAM_STR);
      $sth->bindParam(':news_id', $news_id ,PDO::PARAM_INT);
      $sth->execute();
    }
    catch(Exception $e) {
      die("Erreur lors de la suppression de l'ensemble des tags associés à l'article");
    }	
  }

}
