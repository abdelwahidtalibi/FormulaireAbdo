


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
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="">
        </div>
        <button type="submit" class="btn btn-primary" name="Envoyer">Envoyer</button>
    </form>
</div>

    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require  'phpmailer/src/SMTP.php' ;
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


$email="";

if(isset($_POST['email']) && !empty($_POST['email'])){
$email=$_POST['email'];

$existance_utilisateur=$bdd->prepare("SELECT * FROM users WHERE email=?");
$existance_utilisateur->execute(array($email));

if($existance_utilisateur->rowCount()>0)
{   
    $userInfos=$existance_utilisateur->fetch();
    $_SESSION['userId']=$userInfos['userId'];

    $mail=new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth= true ;
    $mail->Username='abdelwahidtalibi089@gmail.com';
    $mail->Password='ntli rvyz vqvo ynlv';
    $mail->Port=465;
    $mail->SMTPSecure='ssl';
     

    

    $mail->setFrom('abdelwahidtalibi089@gmail.com');

    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject ="recuperer mot de passe";
    $mail->Body ="http://localhost/site%20client/send%20mail/lienmdp.php?userId=".$_SESSION['userId'];

    $mail->send();
    echo " message de recuperation envoyer sur votre boite mail" ;


} }





?>
    
</body>
</html>