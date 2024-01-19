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

if(isset($_GET['userId']) && !empty($_GET['userId'])){
    $getUser=$_GET['userId'];
    header('Location: modification.php?userId='.$getUser);



} else{
    echo"erreur";
}






?>