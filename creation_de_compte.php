<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
     nom <input type="text" name="nom" value=""> <br>
     prenom <input type="text" name="prenom" value=""> <br>
     email <input type="email" name="email" value=""> <br>
     pseudo <input type="text" name="pseudo" value=""> <br>
     password <input type="password" name="password" value=""> <br>
     info <input type="text" name="info" value=""> <br>
    <label for="niveau">Choisissez un niveau :</label>
    <select id="niveau" name="niveau">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    date_ins <input type="date" name="date_ins" value=""> <br>
    date_log <input type="date" name="date_log" value=""> <br>
    <label for="active">active:</label>
    <select id="active" name="active">
        <option value="0">0</option>
        <option value="1">1</option>
        
    </select>
    <input type="submit" value="Envoyer" name="Envoyer">
</form>

<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require  'phpmailer/src/SMTP.php' ;

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
    // initialisation 
    $nom=$prenom=$email=$pseudo=$password=$info=$niveau=$date_ins=$date_log=$active=$cle="";
         if(isset($_POST['nom']) &&!empty($_POST['nom']))
          $nom=$_POST['nom'];
        if(isset($_POST['prenom']) &&!empty($_POST['prenom']))
          $prenom=$_POST['prenom'];
        
        if(isset($_POST['pseudo']) &&!empty($_POST['pseudo']))
          $pseudo=$_POST['pseudo'];
        if(isset($_POST['password']) &&!empty($_POST['password']))
          $password=$_POST['password'];
        if(isset($_POST['info']) &&!empty($_POST['info']))
          $info=$_POST['info'];
          if(isset($_POST['niveau']) &&!empty($_POST['niveau']))
          $niveau=$_POST['niveau'];
          if(isset($_POST['date_ins']) &&!empty($_POST['date_ins']))
          $date_ins=$_POST['date_ins'];
          if(isset($_POST['date_log']) &&!empty($_POST['date_log']))
          $date_log=$_POST['date_log'];
          if(isset($_POST['active']) &&!empty($_POST['active']))
          $active=$_POST['active'];

          if(isset($_POST['email']) &&!empty($_POST['email'])){
            $email=$_POST['email'];
            $cle=rand(1000000,9000000);
            $insererUser=$bdd->prepare('INSERT INTO users(nom,prenom,email,pseudo,password,info,niveau,date_ins,date_log,active,cle)VALUES(?,?,?,?,?,?,?,?,?,?,?)');
            $insererUser->execute(array($nom,$prenom,$email,$pseudo,$password,$info,$niveau,$date_ins,$date_log,$active,$cle));

            $recupUser=$bdd->prepare('SELECT * FROM users WHERE email=?');
            $recupUser->execute(array($email));

            if($recupUser->rowCount()>0){
              $userInfos=$recupUser->fetch();
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
    $mail->Subject ="validation du compte";
    $mail->Body ="http://localhost/site%20client/send%20mail/lien.php?userId=".$_SESSION['userId']."&cle=".$cle;

    $mail->send();
    echo "

   bien joué  frerot

    " ;


            }
  
  
          }

         



}



?>
    
</body>
</html>