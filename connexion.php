<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>




<body>

<div class="form">
<div class="container mt-5">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo :</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
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