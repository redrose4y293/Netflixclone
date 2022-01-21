<?php
Class User {

  private $con,$sqldata;

 public function __construct($con,$username)
 {
     $this->con = $con;

     $query = $con->prepare("SELECT * FROM users WHERE username=:username");
     $query->bindValue(":username",$username);
     $query->execute();
   $this->sqldata = $query->fetch(PDO::FETCH_ASSOC);
 }

 public function getfirstName()
 {
  return $this->sqldata["firstname"];
 }
 public function getlastName()
 {
     return $this->sqldata["lastname"];
 }
 public function getUsername()
 {
    return $this->sqldata["email"];
 }

}


?>