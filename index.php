<?php 
require_once('./include/class/Magicien.php');
require_once('./include/class/Guerrier.php');
require_once('./include/class/PersonnageManager.php');

use \Studio\Lotr\v1\Magicien as MagicienV1;
use \Studio\Lotr\v1\Guerrier;
use \Studio\Lotr\v2\Magicien as MagicienV2;
?>

<h1>Street Fighter PHP ^^</h1>

<?php 

// 2 personnages qui s'affrontent chacun leur tour 
// 1 classe d'objet : Personnage
// Caracteristiques : 
/* 
  Nom - classe - pdv - force - magie  
*/
// Compétences : 
/*
  Coup de poing, coup de pied , boule de feu, éclair de foudre
*/
$Gandalf = new MagicienV1("Gandalf", 200, 150);
$Aragorn = new Guerrier("Aragorn", 200, 150);
$Gandalfv2 = new MagicienV2("Gandalf le Blanc", 200, 150);

$manager = new PersonnageManager();
var_dump($manager);
$manager->save($Aragorn );



/*
$Gandalf = new Personnage("Gandalf", 200, "Magicien", 50, 150);
$Aragorn = new Personnage("Aragorn",300, "Guerrier",150,50 );
$Gandalf->punch($Aragorn);
*/



// unset($Gandalf);
// $Aragorn = new Personnage("Aragorn",300, "Guerrier",150,50 );
// var_dump($Gandalf);
// var_dump($Aragorn);