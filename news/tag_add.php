<?php
include('class/tagManager.php');
include('class/tag.php');


$obligatoire='<font class="obligatoire">*</font>';


$avert1 = "";

if(empty($_POST)){
	$_POST['submit_tag'] = ""; $label = '';
}
else {
	$label = trim($_POST['label']);
}

if($_POST['submit_tag']=='Ajouter'){	
	

	
	// Etape 1: certains champs obligatoires ne sont pas remplis ou certains champs sont mal remplis
	
	if(
		$label == ''
	){
		
	   	// actions à adopter:
		if($label == ''){
	    	$avert1 = "<p class='erreur-fiche'>Vous n'avez pas renseigné le label.</p>";
	   	}
		
	//Etape 2: les informations sont bonnes, on redirige la personne vers une page processor qui enregistrera la client en bdd
	
	} else {
	    
		
		$tag = new Tag(0,$label);
		
		$tagAdd = new TagManager();
		$tagId = $tagAdd->add($tag);
		
		header('Location: tag_edit.php?tag='.$tagId.'&result=valide');
		
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
<title>Ajouter un tag</title>
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
				<h2>Ajouter un tag</h2>
			</div>
            
            <div id="actions">
            <p class="retour"><a href="tag_list.php" title="Retour à la liste des tags">Retour</a></p>			
            </div>
		</div>
        
        
		<div id="contenu">
        
			<?php 
			if($avert1!='') { echo '
				<div class="frm_error">'.$avert1.'</div>';
			}
			?>
			
			
			<div class="frm_ligne">
                <form method="post" id="frm_form" name="frm_form" action="tag_add.php">
                <?php echo '				
                <div class="formulaire col_100">
                    <div class="titre1 col_100">Infos Tag</div>
                    <div class="titre5 col_name">Nom '.$obligatoire.'</div>	
                    <div class="titre5 col_value">
                    <label><input';if($avert1 != ''){echo ' class="col_error"';} echo ' name="label" id="label" type="text" value="'.str_replace('"', '' ,$label).'"/></label>
                    </div>
                    <div class="col_submit col_100"> 
                        <input type="submit" name="submit_tag" class="bouton_submit" value="Ajouter"/>  
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