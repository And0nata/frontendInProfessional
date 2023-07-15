<?php
class User {
  private $name;
  private $lastname;
  private $email;
  private $id;

  function __construct($id, $name, $lastname, $email) {
    $this->id = $id;
    $this->name = $name;
    $this->lastname = $lastname;
    $this->email = $email;
  }

  function getId() {return $this->id;}
  function getName() {return $this->name;}
  function getLastname() {return $this->lastname;}
  function getEmail() {return $this->email;}

  static function addUser($name, $lastname, $email, $password) {
    global $mysqli;
    $email = mb_strtolower(trim($email));
    $password = trim($password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $result = $mysqli->query("SELECT * FROM `user` WHERE `email`='$email'");

    if ($result->num_rows != 0) {
      return json_encode(["result"=>"exist"]);
    } else {
      $mysqli->query("INSERT INTO `user`(`name`, `lastname`, `email`, `password`) VALUES ('$name', '$lastname', '$email', '$password')");
      return json_encode(["result"=>"success"]);
    }
  }
  static function authUser($email, $password) {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM `user` WHERE `email`='$email'");
    $result = $result->fetch_assoc();
    if ($result) {
      $password_hash = $result["password"];
    if (password_verify($password, $password_hash)) {
      $_SESSION["id"] = $result["id"];
      $_SESSION["name"] = $result["name"];
      $_SESSION["lastname"] = $result["lastname"];
      $_SESSION["email"] = $result["email"];
      return json_encode(["result"=>"success"]);
      } else {
        return json_encode(["result"=>"exit"]);
      }
    }
    else {
      return json_encode(["result"=>"exit"]);
    }
}}
