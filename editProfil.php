<?php

session_start();

require("Compte.php");

if(isset($_POST["name"], $_POST["pseudo"], $_POST["bio"], $_POST["country"], $_POST["joinedAt"], $_POST["photo"], $_POST["profilPicture"])) {
  echo "Envoyé ";
  // je récupère mes variables du formulaire
  // pour vous les noms pourraient être un peu différents
  $name = $_POST["name"];
  $pseudo = $_POST['pseudo'];
  $bio = $_POST['bio'];
  $country = $_POST['country'];
  $joinedAt = $_POST['joinedAt'];
  $photo = $_POST['photo'];
  $profilPicture = $_POST['profilPicture'];
  // on se connecte à la base de données
  //print_r($_SESSION["user"]);

  if(isset($_SESSION["registering_user"])) {
    $email = $_SESSION["registering_user"];
  } else {
    $compte = unserialize($_SESSION["user"]);
    $email = $compte->email();
  }
  
  try {
    // il faudra sûrement changer quelques infos pour vous
    $db = new PDO("mysql:host=localhost;dbname=tweeter;", "root", "root");
    // permet d'attraper une erreur SQL si elle survient (désactivé par défaut)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }

  echo "lm";
  // insérer une nouvelle ligne
  // si vous devez écrire une variable, écrivez-la précédée du symbole ':'
  // par exemple pour insérer une variable 'firstname'
  // je peux écrire ':firstname' dans ma requête (sans les guillemets)
  $query = "UPDATE comptes SET name = :name, pseudo = :pseudo , bio = :bio, country = :country, joinedAt = :joinedAt, photo = :photo, profilPicture = :profilPicture WHERE email = :email "; 
  
  
  try {
    // préparation de la requête et exécution
    $q = $db->prepare($query);
    // ça permet de remplacer les variables présents dans la requête SQL (précédées par le symbole ':')
    // par les vraies variables qu'on a récupérées de notre formulaire
    $q->bindParam(":name", $name); //on attache le paramètre
    $q->bindParam(":pseudo", $pseudo);
    $q->bindParam(":bio", $bio);
    $q->bindParam(":country", $country); 
    $q->bindParam(":joinedAt", $joinedAt);
    $q->bindParam(":photo", $photo);
    $q->bindParam(":profilPicture", $profilPicture);
    $q->bindParam(":email", $email);

    $q->execute();

    unset($_SESSION["registering_user"]);

    $account = new Compte($name, $pseudo, $bio, $country, $joinedAt, $compte["followers"], $compte["followees"], $email, $compte["password"], $photo, $profilPicture);
    $_SESSION["user"] = serialize($account);

    header('Location: profile.php');

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
  <title>Edit Your Profil</title>
  <link rel="stylesheet" href="editProfil.css">
</head>
<body>
  <main class="fullContainer">
    <div class="firstHalfContainer">
      <img class="imgLogo" src="img/logo.png" alt="image logo tweeter">
    </div>

    <div class="secondHalfContainer">
      <form action="editProfil.php" method="post">
        <label for="name">Enter you name</label></br>
        <input type="text" name="name" id="name"></br>
        <label></label></br>
        <label for="pseudo">Enter your pseudo</label></br>
        <input type="text" name="pseudo" id="pseudo"></br>
        <label></label></br>
        <label for="bio">Enter your Bio</label></br>
        <input type="text" name="bio" id="bio"></br>
        <label></label></br>
        <label for="country">Enter your Country</label></br>
        <input type="text" name="country" id="country"></br>
        <label></label></br>
        <label for="joinedAt">Date of begin</label></br>
        <input type="text" id="joinedAt" name="joinedAt"></br>
        <label></label></br>
        <label for="photo">Your Photo</label></br>
        <input type="text" name="photo" id="photo"></br>
        <label></label></br>
        <label for="profilPicture">Your Profil Picture</label></br>
        <input type="text" name="profilPicture" id="profilPicture"></br>
        <label></label></br>

        <button class="button" type="submit">Suivant</button>

      </form>
    </div>
  </main> 
</body>
</html>