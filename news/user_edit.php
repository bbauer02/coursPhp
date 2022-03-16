<?php
include('class/newsManager.php');
include('class/userManager.php');
include('class/user.php');


$userManager = new UserManager();
$userData = $userManager->selectById($_GET['user']);
$var['name'] = $userData -> getName();
$var['lastname'] = $userData -> getLastname();
$var['role'] = $userData -> getRole();
$var['email'] = $userData -> getEmail();
$var['login'] = $userData -> getLogin();

$obligatoire='<font class="obligatoire">*</font>';
$check_mail = "#[a-z0-9-_\.]+[^-_\.]@[a-z0-9-_\.]+[^-_\.]\.([a-z]{2,})$#";

$avert1 = ""; $avert2 = ""; $avert3 = ""; $avert4 = ""; $avert5 = ""; $avert6 = ""; $avert7 = ""; 

if(empty($_POST)){
	$_POST['submit_user'] = ""; $name = ''; $lastname = ''; $role = ''; $email = ''; $login = ''; $password = '';
}
else {
	$name = trim($_POST['name']);
	$lastname = trim($_POST['lastname']);
	$role = trim($_POST['role']);
	$email = trim($_POST['email']);
	$login = trim($_POST['login']);
	$password = trim($_POST['password']);
}

if($_POST['submit_user']=='Modifier'){	
	
	
	$var = $_POST;
	
	// Etape 1: certains champs obligatoires ne sont pas remplis ou certains champs sont mal remplis
	
	if(
		$name == '' ||
		$lastname == '' ||
		$role == '' ||
		($email == '' || ($email != '' && !preg_match($check_mail,$email))) ||
		$login == ''  
	){
		
	   	// actions à adopter:
		if($name == ''){
	    	$avert1 = "<p class='erreur-fiche'>Vous n'avez pas renseigné le prénom.</p>";
	   	}
		if($lastname == ''){
	    	$avert2 = "<p class='erreur-fiche'>Vous n'avez pas renseigné le nom.</p>";
	   	}
		if($role == ''){
	    	$avert3 = "<p class='erreur-fiche'>Vous n'avez pas précisé le role.</p>";
	   	}		
		if($email == ''){
	    	$avert4 = "<p class='erreur-fiche'>Vous n'avez pas renseigné l'e-mail.</p>";
	   	}	
		if($email != '' && !preg_match($check_mail,$email)){
	    	$avert5 = "<p class='erreur-fiche'>L'e-mail n'est pas au bon format.</p>";
	   	}
		if($login == ''){
	    	$avert6 = "<p class='erreur-fiche'>Vous n'avez pas renseigné le login.</p>";
	   	}
		
	//Etape 2: les informations sont bonnes, on redirige la personne vers une page processor qui enregistrera la client en bdd
	
	} else {
	    
		if($password == ''){ $password = $userData -> getPassword();}
		
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
<title>Modifier l'auteur <?php echo $userData -> getName().' '.$userData -> getLastname();?></title>
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
				<h2>Modifier l'auteur : <?php echo $userData -> getName().' '.$userData -> getLastname();?></h2>
			</div>
            
            <div id="actions">
            <p class="retour"><a href="user_list.php" title="Retour à la liste des auteurs">Retour</a></p>			
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