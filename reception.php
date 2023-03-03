<?php

session_start();

  try {
    $db = new PDO("mysql:host=localhost;dbname=tweeter;port=3306", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(Exception $e) {
    echo $e->getMessage();
  }

  $query = "SELECT * FROM tweets ";

  $q = $db->prepare($query);

  $q->execute();

  $tweets = $q->fetchAll();

  /*if(){
    header('Location: profile.php');
  }*/ 
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceuil</title>
  <link rel="stylesheet" href="reception.css">
</head>
<body>
  <main>
    <div>
      <button></button>
    </div>
    <div class="FirstContainerTweet">
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
          <?= $tweets[$i]["createdAt"] ?>
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
  </main>  
</body>
</html>