<?php

//A class that represents a user, containing an email and password.
//Also provides the ability to hash a password.
class User {

  public $email;
  public $password;
  public $hash;

  public function __construct($email, $password) {
    $this->email = $email;
    $this->password = $password;
    $this->hash = $this->hashPassword($password); 
  }

  //Returns a hash of the password using PHP's default hashing algorithm.
  //The current default is BCRYPT.
  public static function hashPassword($password) {
    return password_hash($password,PASSWORD_DEFAULT);
  }


  //
  public function verify($hash) {
    return password_verify($this->password, $hash);
}
}