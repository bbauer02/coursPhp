<?php
include('class/newsManager.php');
include('class/userManager.php');
include('class/user.php');


$userManager = new UserManager();
$users = $userManager->selectAll();
$user_count = count($users);


$newsManager = new NewsManager();
$newsData = $newsManager->newsData($_GET['news']);
$var['title'] = $newsData -> getTitle();
$var['date'] = $newsData -> getDate();
$var['content'] = $newsData -> getContent();
$var['author'] = $newsData -> getEmail();


$obligatoire='<font class="obligatoire">*</font>';

$avert1 = ""; $avert2 = ""; $avert3 = ""; $avert4 = ""; 

if(empty($_POST)){
	$_POST['submit_news'] = ""; $title = ''; $date = ''; $content = ''; $author = '';
}
else {
	$title = trim($_POST['title']);
	$date = trim($_POST['date']);
	$content = trim($_POST['content']);
	$author = trim($_POST['author']);
}

if($_POST['submit_news']=='Modifier'){	
	
	
	$var = $_POST;
	
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
	    
		
		$user = new User($_GET['user'], $role, $name, $lastname, $email, $login, $password);
		
		$userEdit = new UserManager();
		$userEdit->edit($user);
		
		header('Location: user_edit.php?user='.$_GET['user'].'&result=valide');
		
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
<title>Modifier l'actualité <?php echo $newsData -> getTitle();?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="css/admin-general.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/user.css" rel="stylesheet" type="text/css" />

<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet"> 

<meta name="viewport" content="width=device-width">

</head>

<body>
<div id="global">
	<div id="menu"><?php include('include/menu.php');?></div>
	<div id="cadre" class="general_content">
		<div id="haut">
			<div id="titre">
				<h2>Modifier l'actualité <?php echo $newsData -> getTitle();?></h2>
			</div>
            
            <div id="actions">
            <p class="retour"><a href="news_list.php" title="Retour à la liste des auteurs">Retour</a></p>			
            </div>
		</div>
        
        <?php if(isset($_GET['result']) && $_GET['result'] == 'valide'){ echo '
				<div id="frm_valide">
					<p class="vert">Données sauvegardées</p>
				</div>';
				}
			?>
        
		<div id="contenu">
        
			<?php 
			if($avert1!='' || $avert2!='' || $avert3!='' || $avert4!='' || $avert5!='' || $avert6!='') { echo '
				<div class="frm_error">'.$avert1.$avert2.$avert3.$avert4.$avert5.$avert6.'</div>';
			}
			?>
			
			
			<div class="frm_ligne">
				<form method="post" id="frm_form" name="frm_form" action="user_edit?user=<?php echo $_GET['user'];?>">
				<?php echo '				
				<div class="formulaire col_100">
					<div class="titre1 col_100">Infos Auteur</div>
					<div class="titre5 col_name">Nom '.$obligatoire.'</div>	
					<div class="titre5 col_value">
					<label><input';if($avert2 != ''){echo ' class="col_error"';} echo ' name="lastname" id="lastname" type="text" value="'.str_replace('"', '' ,$var['lastname']).'"/></label>
					</div>	
					<div class="titre5 col_name">Prénom '.$obligatoire.'</div>							
					<div class="titre5 col_value">
					<label><input';if($avert1 != ''){echo ' class="col_error"';} echo ' name="name" id="name" type="text" value="'.str_replace('"', '' ,$var['name']).'"/></label>
					</div>	
					<div class="titre5 col_name">Role '.$obligatoire.'</div>	
					<div class="titre5 col_value">
					<label><input';if($avert3 != ''){echo ' class="col_error"';} echo ' name="role" id="role" type="text" value="'.str_replace('"', '' ,$var['role']).'"/></label>
					</div>	
					<div class="titre5 col_name">E-mail '.$obligatoire.'</div>							
					<div class="titre5 col_value">
					<label><input';if($avert4 != '' || $avert5 != ''){echo ' class="col_error"';} echo ' name="email" id="email" type="text" value="'.str_replace('"', '' ,$var['email']).'"/></label>
					</div>	
					<div class="titre5 col_name">Login '.$obligatoire.'</div>							
					<div class="titre5 col_value">
					<label><input';if($avert6 != ''){echo ' class="col_error"';} echo ' name="login" id="login" type="text" value="'.str_replace('"', '' ,$var['login']).'"/></label>
					</div>	
					<div class="titre5 col_name">Mot de passe</div>							
					<div class="titre5 col_value">
					<label><input';if($avert7 != ''){echo ' class="col_error"';} echo ' name="password" id="password" type="password" value=""/></label>
					</div>	
					<div class="col_submit col_100"> 
						<input type="submit" name="submit_user" class="bouton_submit" value="Modifier"/>  
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