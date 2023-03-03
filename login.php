<?php

require("Compte.php");

session_start();

if(isset($_POST["email"]) AND $_POST["password"]) {
  //Connect to DataBase
  try {
  $db = new PDO("mysql:host=localhost;dbname=tweeter;port=3306", "root", "root");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(Exception $e) {
    echo $e->getMessage();
  }

  $email = $_POST["email"];

  //queries
  $queryEmail="SELECT email FROM comptes WHERE email = :email";

  $qemail = $db->prepare($queryEmail);
  $qemail->bindParam(":email", $email);

  $qemail->execute();

  if($qemail->rowCount() > 0){
    $queryPassword="SELECT password FROM comptes WHERE email = :email";

    $qpassword = $db->prepare($queryPassword);
    $qpassword->bindParam(":email", $email);

    $qpassword->execute();
  
    $result = $qpassword->fetch();

    if($_POST["password"] == $result["password"]){

      $compte="SELECT * FROM comptes WHERE email = :email";
      $qcompte = $db->prepare($compte);
      $qcompte->bindParam(":email", $email);

      $qcompte->execute();
      $compte = $qcompte->fetch();

      $account = new Compte($compte["id"], $compte["name"], $compte["pseudo"], $compte["bio"], $compte["country"], $compte["joinedAt"], $compte["followers"], $compte["followees"], $compte["email"], $compte["password"], $compte["photo"], $compte["profilPicture"]);
      $_SESSION["user"] = serialize($account);
      header('Location: profile.php');
    }
    else {
      echo "Code erroné";
    }
  }
  else {
      echo "Le compte n'existe pas";
  }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="loginRegister.css">
</head>
<body>
  <main class="fullContainer">
    <div class="firstHalfContainer">
      <img src="img/acceuil" alt="image logo tweeter">
    </div>

    <div class="secondHalfContainer">
      <img class="imgLogo" src="img/logo.png" alt="logo tweeter">
      <h2>Se connecter</h2>
      <form action="login.php" method="post">
        <label></label>
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