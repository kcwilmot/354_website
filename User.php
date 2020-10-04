<?php

class User {

  public $email;
  public $password;
  protected $permission;

  public function __construct($email, $password) {
    $this->email = $email;
    $this->password = $password;
    $this->permission = 0;
  }

}