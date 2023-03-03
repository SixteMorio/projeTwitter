<?php

class Compte {
  private $_id;
  private $_name;
  private $_pseudo;
  private $_bio;
  private $_country;
  private $_joinedAt;
  private $_followers;
  private $_followee;
  private $_email;
  private $_password;
  private $_photo;
  private $_profilPicture;

  function __construct($id, $name, $pseudo, $bio, $country, $joinedAt, $followers, $followee, $email, $password, $photo, $profilPicture) {
    $this->_id = $id;
    $this->_name = $name;
    $this->_pseudo = $pseudo;
    $this->_bio = $bio;
    $this->_country = $country; 
    $this->_joinedAt = $joinedAt;
    $this->_followers = $followers;
    $this->_followee = $followee;
    $this->_email= $email;
    $this->_password = $password;
    $this->_photo = $photo;
    $this->_profilPicture = $profilPicture;   
  }

  public function id(){
    return $this->_id;
  }

  public function name(){
    return $this->_name;
  }

  public function pseudo(){
    return $this->_pseudo;
  }

  public function bio(){
    return $this->_bio;
  }

  public function country(){
    return $this->_country;
  }

  public function joinedAt(){
    return $this->_joinedAt;
  }

  public function followers(){
    return $this->_followers;
  }

  public function followee(){
    return $this->_followee;
  }

  public function email(){
    return $this->_email;
  }

  public function password(){
    return $this->_password;
  }

  public function photo(){
    return $this->_photo;
  }

  public function profilPicture(){
    return $this->_profilPicture;
  }

}

?>