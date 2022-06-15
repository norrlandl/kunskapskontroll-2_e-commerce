<?php

class ValidationHandler {
  public $errorMessage = "";

  public function __construct($errorMessage){
    $this->errorMessage = $errorMessage;
  }

  public function validateNotEmpty($data, $message) {
    if (empty($data)) {
      $this->$errorMessage .= $message;
    }
  }

  public function validatePassword($password, $confirmPassword, $message) {
    if ($password != $confirmPassword) {
      $this->$errorMessage .= $message;
    }
  }
}