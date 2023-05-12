<?php

$host = 'localhost';
$dbname = 'onthefluss';
$username = 'root';
$password = 'root';

if(isset($_POST['insert'])){

  try {
  // se connecter à mysql
  $pdo = new PDO("mysql:host=$host;dbname=$dbname","$username","$password");
  } catch (PDOException $exc) {
    echo $exc->getMessage();
    exit();
  }

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }


  // récupérer les valeurs 
  $email = valid_donnees($_POST['email']);
  $today = date("y-m-d"); 


    if (!empty($email)
        && !empty($email)
        && filter_var($email, FILTER_VALIDATE_EMAIL)){
    

  $stmt = $pdo->prepare("SELECT email FROM newsletter where email = '$email'");
  $stmt->execute();
  $resultat = $stmt->fetchAll();




  // vérifier si la requête d'insertion a réussi
  if($resultat){
      echo "deja";
      
  }else if(!$resultat){

      // Requête mysql pour insérer des données
      $sql = "INSERT INTO `newsletter`(`email`, `date`) VALUES (:email,:today)";
      $res = $pdo->prepare($sql);
      $exec = $res->execute(array(":email"=>$email,":today"=>$today));
      

      ?>
          <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/stylesecret.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Erreur</title>
    </head>
    
    <body>
        <div class="infos">

          <div class="content">
            <div class="formulaire">
              <p>Merci <3 <a href="../secret.php">Retour</a></p>
            </div>
          </div>
        </div>
    
    </body>
    </html>

<?php

die();
  }

}
}


 ?>