<?php
include('class/tagManager.php');
include('class/tag.php');


$tagManager = new TagManager();
$tags = $tagManager->selectAll();
$tag_count = count($tags);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
<title>Gestion des Tags</title>
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
				<h2>Gestion des Tags</h2>
			</div>
            
            <div id="actions">
            <p class="ajouter"><a href="tag_add.php" title="Ajouter un tag">Ajouter un tag</a></p>			
            </div>
		</div>
		<div id="contenu">
        
				<table class="liste" cellpadding="0" cellspacing="0" width="98%">                  
                    
                    <tr class="raye">
                        <td class="titre2">Nom</td>
						<td class="titre2 titre2_end ligne_hide3" colspan="2" width="50">Actions</td>
                        <td class="titre2 titre2_end ligne_show"></td>
					</tr>
                    
                    
                    
					<?php
					if($tag_count==0){ echo '
					<tr>
						<td class="titre3" colspan="4" align="center"><strong>Il n\'existe aucun tag</strong></td>
					</tr>';
					} else {
						$j=3;
						foreach($tags as $tag) { 
							echo '
							<tr>	
								<td class="titre_ligne ligne_hide1 titre'.$j.'">'.$tag->getLabel().'</td>					
								<td class="titre_ligne titre'.$j.' titre_b" valign="middle" align="center" width="25px"><a href="tag_edit.php?tag='.$tag->getId().'" title="Modifier le tag '.$tag->getLabel().'"><img class="img" src="img/administration/modifier.png"/></a></td>
								<td class="titre_ligne ligne_hide3 titre'.$j.' titre_b" valign="middle" align="center" width="25px"><a href="tag_delete.php?tag='.$tag->getId().'" title="Supprimer le tag '.$tag->getLabel().'"><img class="img" src="img/administration/supprimer.png"/></a></td>
							</tr>
							';					
							if($j==3){$j++;}else{$j--;}
						}
					}
					?>
				</table>
        
        
		</div>	
	</div>
</div>
</body>
</html>