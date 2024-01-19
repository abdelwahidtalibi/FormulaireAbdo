<?php
session_start();
if(isset($_SESSION['cle'])){
 echo"votre compte a ete confirme " ;
 echo"<a href='connexion.php'>vous pouvez vous connecter ici </a>" ;}
 else{
    echo "Votre compte n'a pas été confirme";
 }


?>