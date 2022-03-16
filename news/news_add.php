<?php
include('class/newsManager.php');
include('class/userManager.php');
include('class/user.php');
include('class/news.php');


$userManager = new UserManager();
$users = $userManager->selectAll();
$user_count = count($users);

$obligatoire='<font class="obligatoire">*</font>';

$avert1 = ""; $avert2 = ""; $avert3 = ""; $avert4 = "";

if(empty($_POST)){
	$_POST['submit_news'] = ""; $title = ''; $date = ''; $author = ''; $content = '';
}
else {
	$title = trim($_POST['title']);
	$date = trim($_POST['date']);
	$author = trim($_POST['author']);
	$content = trim($_POST['content']);
}

if($_POST['submit_news']=='Ajouter'){	
	

	
	// Etape 1: certains champs obligatoires ne sont pas remplis ou certains champs sont mal remplis
	
	if(
		$title == '' ||
		$date == '' ||
		$author == '' ||
		$content == ''
	){
		
	   	// actions à adopter:
		if($title == ''){
	    	$avert1 = "<p class='erreur-fiche'>Vous n'avez pas renseigné le titre.</p>";
	   	}
		if($date == ''){
	    	$avert2 = "<p class='erreur-fiche'>Vous n'avez pas renseigné la date.</p>";
	   	}
		if($author == ''){
	    	$avert3 = "<p class='erreur-fiche'>Vous n'avez pas sélectionné d'auteur.</p>";
	   	}		
		if($content == ''){
	    	$avert4 = "<p class='erreur-fiche'>Vous n'avez pas renseigné de contenu.</p>";
	   	}
		
	//Etape 2: les informations sont bonnes, on redirige la personne vers une page processor qui enregistrera la client en bdd
	
	} else {
	    
		$userManager = new UserMAnager();
		$user = $userManager->userData($author);
		
		
		$news = new News(0,$title, $content, $date, $user);
		
		$newsAdd = new NewsManager();
		$newsId = $newsAdd->add($news);
		
		header('Location: news_edit.php?news='.$newsId.'&result=valide');
		
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
<title>Ajouter une actualité</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="css/admin-general.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/news.css" rel="stylesheet" type="text/css" />

<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet"> 

<meta name="viewport" content="width=device-width">

</head>

<body>
<div id="global">
	<div id="menu"><?php include('include/menu.php');?></div>
	<div id="cadre" class="general_content">
		<div id="haut">
			<div id="titre">
				<h2>Ajouter une actualité</h2>
			</div>
            
            <div id="actions">
            <p class="retour"><a href="news_list.php" title="Retour à la liste des actualités">Retour</a></p>			
            </div>
		</div>
        
        
		<div id="contenu">
        
			<?php 
			if($avert1!='' || $avert2!='' || $avert3!='' || $avert4!='') { echo '
				<div class="frm_error">'.$avert1.$avert2.$avert3.$avert4.'</div>';
			}
			?>
			
			
			<div class="frm_ligne">
                <form method="post" id="frm_form" name="frm_form" action="news_add.php">
                <?php echo '				
                <div class="formulaire col_100">
                    <div class="titre1 col_100">Infos Actualité</div>
                    <div class="titre5 col_name">Titre '.$obligatoire.'</div>	
                    <div class="titre5 col_value">
                    <label><input';if($avert1 != ''){echo ' class="col_error"';} echo ' name="title" id="title" type="text" value="'.str_replace('"', '' ,$title).'"/></label>
                    </div>	
                    <div class="titre5 col_name">Date '.$obligatoire.'</div>							
                    <div class="titre5 col_value">
                    <label><input';if($avert2 != ''){echo ' class="col_error"';} echo ' name="date" id="date" type="text" value="'.str_replace('"', '' ,$date).'"/></label>
                    </div>	
                    <div class="titre5 col_name">Auteur '.$obligatoire.'</div>	
                    <div class="titre5 col_value';if($avert3 != ''){ echo ' select_error';} echo '" >
					<select name="author" id="author">
					<option value=""';if($author == ''){ echo ' selected="selected"';} echo '>Choisir un auteur</option>';
                    foreach($users as $user) {
					echo '
					<option value="'.$user->getId().'"';if($author == $user->getId()){ echo ' selected="selected"';} echo '>'.$user->getName().' '.$user->getLastname().'</option>';
					} echo '
					</select>
                    </div>	
                    <div class="titre5 col_name">Contenu '.$obligatoire.'</div>							
                    <div class="titre5 col_value">
                    <textarea';if($avert4 != ''){echo ' class="col_error"';} echo ' rows="2" name="content" id="content">'.$content.'</textarea>
                    </div>	
                    <div class="col_submit col_100"> 
                        <input type="submit" name="submit_news" class="bouton_submit" value="Ajouter"/>  
                    </div> 
                </div> 
                </form>';	
                ?>
			</div>
		</div>	
	</div>
</div>
</body>
</html>