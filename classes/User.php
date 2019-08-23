<?php

require_once 'Config.php';

class User extends Config{


    public function search_adduser_duplicate($email){
        $sql="SELECT COUNT(*) AS duplicate FROM users WHERE user_email='$email' AND user_status='A'";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function add_user($username,$email,$password){
        $hash_password=md5($password);
        $sql = "INSERT into users(user_name,user_email,user_password) VALUES('$username','$email','$hash_password') ";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return $this->conn->insert_id;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

    public function search_updateuser_duplicate($email,$user_id){
        $sql="SELECT COUNT(*) AS duplicate FROM users WHERE user_email='$email' AND user_id != '$user_id' AND user_status='A'";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function update_user($email,$username,$user_id){
        $sql = "UPDATE users SET user_email='$email', user_name='$username' WHERE user_id='$user_id'";
        $result=$this->conn->query($sql);
        return $result;
        $this->conn->close();
    }

    public function update_password($password,$user_id){
        $hash_password=md5($password);
        $sql="UPDATE users SET user_password='$hash_password' WHERE user_id='$user_id' ";
        $result=$this->conn->query($sql);
        return $result;
        $this->conn->close();
    }

    public function deactivate_user($user_id){
        $sql="UPDATE users SET user_status='D' WHERE user_id='$user_id'";
        $result=$this->conn->query($sql);
        return $result;
    }

    public function count_users(){
        $sql = "SELECT COUNT(*) AS total_users FROM users WHERE user_status='A'";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }
}