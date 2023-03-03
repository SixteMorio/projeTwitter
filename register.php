<?php

session_start();

if(isset($_POST["email"], $_POST["password"])) {
  echo "Envoyé ";
  // je récupère mes variables du formulaire
  // pour vous les noms pourraient être un peu différents
  $email = $_POST['email'];
  $password = $_POST['password'];
  // on se connecte à la base de données
  try {
    // il faudra sûrement changer quelques infos pour vous
    $db = new PDO("mysql:host=localhost;dbname=tweeter;", "root", "root");
    // permet d'attraper une erreur SQL si elle survient (désactivé par défaut)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }

  // insérer une nouvelle ligne
  // si vous devez écrire une variable, écrivez-la précédée du symbole ':'
  // par exemple pour insérer une variable 'firstname'
  // je peux écrire ':firstname' dans ma requête (sans les guillemets)
  $query = "INSERT INTO comptes(email, password) VALUES (:email, :password);"; 
  
  
  try {
    // préparation de la requête et exécution
    $q = $db->prepare($query);
    // ça permet de remplacer les variables présents dans la requête SQL (précédées par le symbole ':')
    // par les vraies variables qu'on a récupérées de notre formulaire
    $q->bindParam(":email", $email); //on attache le paramètre
    $q->bindParam(":password", $password);

    $q->execute();

    $_SESSION["registering_user"] = $email;

    header('Location: editProfil.php');

    // si jamais une erreur survient, on l'affiche
  } catch (PDOException $e) {
    echo "Erreur dans la base de données : ".$e->getMessage();
  } catch (Exception $e) {
    echo "Erreur PHP : ".$e->getMessage();
  }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="loginRegister.css">
</head>
<body>
  <main class="fullContainer">
    <div class="firstHalfContainer">
      <img src="img/acceuil" alt="image logo tweeter">
    </div>

    <div class="secondHalfContainer">
      <img class="imgLogo" src="img/logo.png" alt="logo tweeter">
      <h2>S'inscrire</h2>
      <form action="register.php" method="post">
        <label for="email">Email</label></br>
        <input type="email" id="email" name="email"/></br>
        <label></label></br>
        <label for="password">Mot de passe</label></br>
        <input type="password" id="password" name="password"></br>
        <label></label></br>

        <button class="button" type="submit">Suivant</button>

      </form>
    </div>
  </main>
</body>
</html>