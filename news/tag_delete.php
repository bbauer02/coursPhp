<?php
include('class/tagManager.php');
include('class/tag.php');


$tagManager = new TagManager();
$tagData = $tagManager->tagData($_GET['tag']);

$tagLabel = $tagData -> getLabel();

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
			
	$tagDelete = new TagManager();
	$tagDelete->delete($tagData);
	
	header('Location: tag_list.php');
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
<title>Supprimer le tag <?php echo $tagLabel;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="css/admin-general.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/tag.css" rel="stylesheet" type="text/css" />

<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet"> 

<meta name="viewport" content="width=device-width">

</head>

<body>
<div id="global">
	<div id="menu"><?php include('include/menu.php');?></div>
	<div id="cadre" class="general_content">
		<div id="haut">
			<div id="titre">
				<h2>Supprimer le tag : <?php echo $tagLabel;?></h2>
			</div>
            
            <div id="actions">
            <p class="supprimer"><a href="tag_delete.php?tag=<?php echo $_GET['tag'];?>&action=delete" title="Supprimer le tag <?php echo $tagLabel;?>">Confirmer la suppression</a></p>
            <p class="retour"><a href="tag_list.php" title="Retour à la liste des Tags">Retour</a></p>			
            </div>
		</div>
        
		<div id="contenu" class="contenu_centre">
            <p class="supprimer">Vous êtes sur le point de supprimer le tag suivant : <?php echo '<font class="fonce">'.$tagLabel.'</font>';?></p>
        </div>
	</div>
</div>
</body>
</html>