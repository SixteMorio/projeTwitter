<?php

require("Compte.php");
require("Tweet.php");

session_start();

$compte = unserialize($_SESSION["user"]);
$id = $compte->id();

  try {
    $db = new PDO("mysql:host=localhost;dbname=tweeter;port=3306", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(Exception $e) {
    echo $e->getMessage();
  }

  $query = "SELECT * FROM tweets JOIN comptes ON comptes_id = comptes.id  WHERE comptes_id = :comptes ";

  $q = $db->prepare($query);

  
  $q->bindParam(':comptes', $id);
  
  $q->execute();

  $tweets = $q->fetchAll();

  //var_dump($tweets);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <link rel="stylesheet" href="profile.css">
</head>

<body>
  <main class="fullContainer">
    <div class="containerProfil">
      <div class="pictureBaniere">
        <img src="<?= $compte->photo() ?>" alt="img Bannière">
      </div>
      <div class="containerProfilPicture">
        <img class="profilPicture" src="<?= $compte->profilPicture() ?>" alt="img Profil">
      </div>
      <div class="accountINfo">
        <div class="namePseudo">
          <h3><?= $compte->name() ?></h3>
          <h4><?= "@".$compte->pseudo() ?></h4>
        </div>
        <div class="bio">
          <p><?= $compte->bio() ?></p>
        </div>
        <div class="follow">
          <button>Suivre</button>
        </div>
      </div>
      
      <div>
        <h4 class="land">lieu <?= $compte->country() ?><h4>
        <h4>A rejoint Twitter <?= $compte->joinedAt() ?></h4>
      </div>
    </div> 
    <div class="containerFollow">
      <h4 class="followees"><?= $compte->followee() ?> abonnements</h4>
      <h4 class="followers"><?= $compte->followers() ?> abonnés</h4>  
    </div>
    <div class="actionButton">
      <div class="editProfil">
        <a href="editProfil.php">Edit your profil</a>
      </div>
      <div class="tweeter">
        <a href="tweeter.php">Tweeter</a>
      </div>
      <div class="reception">
        <a href="reception.php">Acceuil</a>
      </div>
      <div class="logout">
        <a href="logout.php">Se déconnecter</a>
      </div>
    </div>
    <label></label></br>
    <div class="FirstContainerTweet">
      <div>  
        <?php
          for($i = 0; $i < count($tweets); $i++){
        ?>
        <div class="SecondContainerTweet">

          <div class="PictureTweet">
            <img src="<?= $compte->profilPicture() ?>" alt="img Profil">
          </div>
          <div class="NameTweet">
            <?= $compte->name() ?>
          </div>
          <div class="pseudoTweet">
            <?= $compte->pseudo() ?>
          </div>
          <div class="description">
            <?= $tweets[$i]["description"] ?>
          </div>
          <div class="createdAT">
            <?= $tweets[$i]["createdAt"] ?></br>
          </div>
          <div class="containerReaction">
            <div class="retweets">
              <?= " ".$tweets[$i]["retweets"] ?><p> Retweets</p>
            </div>
            <div class="answers">
              <?= " ".$tweets[$i]["answers"] ?><p> Tweets cités</p>
            </div>
            <div class="likes">  
              <?= " ".$tweets[$i]["likes"] ?><p> likes </p>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div> 
    </div> 
  </main> 


</body>
</html>