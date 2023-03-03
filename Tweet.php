<?php

class Tweet {
  private $_createdAt;
  private $_description;
  private $_likes;
  private $_retweets;
  private $_answers;
  private Compte $_comptesId; 

 function __construct($createdAt, $description, $likes, $retweets, $answers, $_comptesId) {
   $this->_createdAt = $createdAt;
   $this->_description = $description;
   $this->_likes = $likes;
   $this->_retweets = $retweets;
   //$this->_authors = $authors;
   $this->_answers = $answers;
   $this->_comptesId = $comptesId;
  }

  public function createdAt() {
    return $this->_createdAt;
  }

  public function description() {
    return $this->_description;
  }
  
  public function likes() {
    return $this->_likes;
  }

  public function retweets() {
    return $this->_retweets;
  }
  
  public function answers() {
    return $this->_answers;
  }

  public function comptesId(){
    return $this->_comptesId;
  }
  
}

?>