<?php 
include('class/newsManager.php');
include('class/userManager.php');
include('class/user.php');


$userManager = new UserManager();
$users = $userManager->selectAll();

echo "<ul>";
foreach($users as $user) {
  echo "<li>";
    echo $user->getName(). " " . $user->getLastname();
  echo "</li>";
} 
echo "</ul>";

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

