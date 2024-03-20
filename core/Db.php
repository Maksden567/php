<?php
class Db {
    public $server;
    public $username;
    public $password;
    public $db_name;
    public $isConnect;
    public $link;

 public function __construct($server,$username,$password,$db_name){
    $this->server=$server;
    $this->username=$username;
    $this->password=$password;
    $this->db_name=$db_name;
 }

 public function connect(){
    $this->link = mysqli_connect($this->server,$this->username,$this->password,$this->db_name);
    $this->isConnect=true;
    return $this->link; 
 }



}

?>