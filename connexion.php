<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>




<body>
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      pseudo <input type="text" name="pseudo" value=""> <br>
     password <input type="password" name="password" value=""> <br>
     <input type="submit" value="Envoyer" name="Envoyer">
     
</form>
<?php
session_start();
if(isset($_POST["Envoyer"])) {
$host = "localhost";
$user = "root";  
$password = "";
$bdd_name = "espace_membre";

try {
    $bdd = new PDO("mysql:host=$host;dbname=$bdd_name", $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}


$pseudo=$_POST['pseudo'];
$password=$_POST['password']; 
if (!empty($pseudo) && !empty($password)) {
    $sql="SELECT * FROM users WHERE pseudo='$pseudo'";
    $query=$bdd->query($sql);
    $resultat=$query->fetch(PDO::FETCH_OBJ);
    
    if ($resultat && $resultat->pseudo == $pseudo && $resultat->password == $password && $resultat->confirme==1) {
        $_SESSION['nomComplet']=$resultat->nom."".$resultat->prenom;
        header("Location:pageClient.php");
       
    } else {
        echo "ce compte n'existe pas <br>";
        echo"<a href='creation_de_compte.php'>Cliquez ici pour creer un compte </a> <br>" ;
        echo"<a href='recuperation_mdp.php'> mot de passe oublié </a>";
    }
} else {
    echo "Veuillez remplir tous les champs";
}
      
   
    
    
    }





?>
    
</body>
</html>