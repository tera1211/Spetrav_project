<?php

class Config{

    private $servername="localhost";
    private $username="root";
    private $password="root";
    private $database="portfolio_spetrav";
    public $conn;

    public function __construct(){
        $this->conn=new mysqli($this->servername,$this->username,$this->password,$this->database);
        if($this->conn->connect_error){
            die("ERROR:".$this->conn->connect_error);
        }
    }

    public function redirect($url){
        echo "<script>window.location.replace('$url');</script>";
    }

    public function login($email,$password){
        $hash_password=md5($password);
        $sql="SELECT * FROM users WHERE user_email='$email' AND user_password='$hash_password'";
        $result=$this->conn->query($sql);
        $info=$result->fetch_assoc();
        return $info;
    }
}