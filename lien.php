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

if(isset($_GET['userId']) && !empty($_GET['userId']) && isset($_GET['cle']) && !empty($_GET['cle'])) {
    $getuserId = $_GET['userId'];
    $getCle = $_GET['cle'];

    try {
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE userId=? AND cle=?');
        $recupUser->execute(array($getuserId, $getCle));

        if($recupUser->rowCount() > 0) {
            $userInfo = $recupUser->fetch();
            
            if($userInfo['confirme'] != 1) {
                $updateConfirmation = $bdd->prepare('UPDATE users SET confirme=? WHERE userId=?');
                $updateConfirmation->execute(array(1, $getuserId));

                $_SESSION['cle'] = $getCle;
                header('Location: rediriction.php');
            } else {
                $_SESSION['cle'] = $getCle;
                header('Location: connexion.php');
            }
        } else {
            echo "Votre clé ou identifiant est incorrecte";
        }
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des données de l'utilisateur : " . $e->getMessage());
        echo "Erreur lors de la récupération des données de l'utilisateur. Veuillez réessayer plus tard.";
    }
} else {
    echo "Aucun utilisateur trouvé";
}
?>
