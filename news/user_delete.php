<?php
include('class/newsManager.php');
include('class/userManager.php');
include('class/user.php');


$userManager = new UserManager();
$userData = $userManager->userData($_GET['user']);

$userNamecomplet = $userData -> getName().' '.$userData -> getLastname();

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
			
	$userDelete = new UserManager();
	$userDelete->delete($userData);
	
	header('Location: user_list.php');
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
<title>Supprimer l'auteur <?php echo $userNamecomplet;?></title>
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
				<h2>Supprimer l'auteur : <?php echo $userNamecomplet;?></h2>
			</div>
            
            <div id="actions">
            <p class="supprimer"><a href="user_delete.php?user=<?php echo $_GET['user'];?>&action=delete" title="Supprimer l'auteur <?php echo $userNamecomplet;?>">Confirmer la suppression</a></p>
            <p class="retour"><a href="user_list.php" title="Retour à la liste des auteurs">Retour</a></p>			
            </div>
		</div>
        
		<div id="contenu" class="contenu_centre">
            <p class="supprimer">Vous êtes sur le point de supprimer l'auteur suivant : <?php echo '<font class="fonce">'.$userNamecomplet.'</font>';?></p>
        </div>
	</div>
</div>
</body>
</html>