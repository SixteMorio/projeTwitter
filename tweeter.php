<?php

session_start();

require("Compte.php");

$compte = unserialize($_SESSION["user"]);
$id = $compte->id();

if(isset($_POST["description"])) {
  echo "Envoyé ";
  $description = $_POST["description"];

  try {
    $db = new PDO("mysql:host=localhost;dbname=tweeter;", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }

  $query = "INSERT INTO tweets(description,comptes_id) VALUES (:description, :comptes_id); ";

  try {
    $q = $db->prepare($query);
    $q->bindParam(":description", $description); 
    $q->bindParam(":comptes_id", $id);

    $q->execute();

    header('Location: profile.php');

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
    <title>Twetter</title>
</head>
<body>
	<main class="fullContainer">
    <div class="firstHalfContainer">
      <img class="imgLogo" src="img/logo.png" alt="logo tweeter">
    </div>
    <div class="secondHalfContainer">
      <h2>Pose ton Tweet</h2>
      <form action="tweeter.php" method="post">
        <label for="description">Ton tweet</label></br>
        <input type="text" id="description" name="description"/></br>
        <label></label></br>

        <button class="button" type="submit">Tweeter</button>

      </form>
    </div>
  </main>
</body>
</html>