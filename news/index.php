<?php 

include('class/userManager.php');
include('class/user.php');

$userManager = new UserManager();
$users = $userManager->selectAll();
foreach($users as $user) {
  var_dump($user);
}

/*
if(isset($_GET["action"]) && $_GET["action"] == "subscribe") 
{
  $user = new User(null ,1, $_POST['name'], $_POST['lastname'], $_POST['email'], $_POST['login'], $_POST['password']);
  $userManager = new UserManager();
  $userManager->add($user);
  echo "Inscription reussie !!";
}*/
?>


<form action="index.php?action=subscribe" method="POST">
  Name<br>
  <input type="text" name="name" value="" />
  <br>
  Lastname<br>
  <input type="text" name="lastname" value="" />
  <br>
  Email<br>
  <input type="text" name="email" value="" />
  <br>
  Login<br>
  <input type="text" name="login" value="" />
  <br>
  Password<br>
  <input type="password" name="password" value="" />
  <br>
  <br>
  <button type="submit" > Submit </button>
</form>

