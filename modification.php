<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
       function verifierMotDePasse() {
        var motDepasse = document.getElementById("Mot_de_passe").value;
        var confirmerMotDepasse = document.getElementById("Confirmez_le_mot_de_passe").value;
       

        if (motDepasse !== confirmerMotDepasse) {
           
            document.getElementById("messageErreur").innerHTML = "Les mots de passe ne se correspondent pas";
            document.getElementById("Envoyer").disabled = true;
        } else {
           
            document.getElementById("messageErreur").innerHTML = "";
            document.getElementById("Envoyer").disabled = false;
        }
    }
    </script>
</head>
<body>

<form  action="<?php echo $_SERVER['PHP_SELF'] . '?userId=' . $_GET['userId']; ?>" method="post" onsubmit="return verifierMotDePasse();">
      <label for="Mot_de_passe">
      nouveau mot de passe <input type="password" name="Mot_de_passe" value="" id="Mot_de_passe" oninput="verifierMotDePasse()"> </label><br>
      <label for="Confirmez_le_mot_de_passe">
      confirmation mot de passe <input type="password" name="Confirmez_le_mot_de_passe" value="" id="Confirmez_le_mot_de_passe" oninput="verifierMotDePasse()"> </label><br>
      <button class="btn btn-danger" name="Envoyer" id="Envoyer">Modifier</button>
     
</form>

<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$bdd_name = "espace_membre";

try {
    $bdd = new PDO("mysql:host=$host;dbname=$bdd_name", $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    error_log("Erreur de connexion à la base de données : " . $e->getMessage());
    echo "Erreur de connexion à la base de données. Veuillez réessayer plus tard.";
}  

if (isset($_POST['Mot_de_passe']) && isset($_POST['Confirmez_le_mot_de_passe']) && isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $password = $_POST['Mot_de_passe'];

   
   

   
    $modificationMDP = $bdd->prepare("UPDATE users SET password = :password WHERE userId = :userId");
    $modificationMDP->bindParam(':password', $password);
    $modificationMDP->bindParam(':userId', $userId);

    if ($modificationMDP->execute()) {
        echo "Votre mot de passe a été changé avec succès.";
        header("Location: connexion.php");
        
        
    } else {
        echo "Erreur lors de la modification du mot de passe.";
    }
} else {
    echo "Les champs sont vides.";
}
?>

</body>
</html>
