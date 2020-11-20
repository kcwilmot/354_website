<?php

//A class that represents a user, containing an email and password.
//Also provides the ability to hash a password.
class User {

  public $email;
  public $password;

  public function __construct($email, $password) {
    $this->email = $email;
    $this->password = $password;
  }

  //TODO: Implement a hash function that returns the hash.
  public static function hashPassword($password) {

  }
}