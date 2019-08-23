<?php

require_once 'Config.php';

class Profile extends Config{
    public function display_profile(){
        $sql = "SELECT * FROM profiles JOIN users ON profiles.user_id=users.user_id
                JOIN countries ON profiles.country_id=countries.id WHERE profile_status ='A' ORDER BY profiles.user_id DESC ";
        $result=$this->conn->query($sql);
        if($result->num_rows>0){
            $rows=array();
            while($row=$result->fetch_assoc()){
                $rows[]=$row;
            }
            return $rows;
        }else{
            return false;
        }if($result==FALSE){
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

    public function get_profile_info($profile_no){
        $sql = "SELECT * FROM profiles JOIN users ON profiles.user_id=users.user_id
                JOIN countries ON profiles.country_id=countries.id WHERE profile_no='$profile_no'";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }

    public function get_profile_by_user_id($user_id){
        $sql = "SELECT * FROM profiles JOIN users ON profiles.user_id=users.user_id
                JOIN countries ON profiles.country_id=countries.id WHERE profiles.user_id='$user_id'";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }

    public function add_profile($firstname,$lastname,$gender,$country_id,$birthday,$self_introduction,$user_id){
        $new_firstname=ucfirst($firstname);
        $new_lastname=ucfirst($lastname);
        $introduction=addslashes($self_introduction);
        $sql = "INSERT INTO profiles(profile_firstname,profile_lastname,profile_gender,country_id,profile_birthday,profile_self_introduction,user_id) 
                        VALUES('$new_firstname','$new_lastname','$gender','$country_id','$birthday','$introduction','$user_id')";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return true;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }
    
    public function update_profile($firstname,$lastname,$gender,$country_id,$birthday,$self_introduction,$user_id){
        $introduction=addslashes($self_introduction);
        $sql = "UPDATE profiles SET profile_firstname='$firstname',profile_lastname='$lastname',profile_gender='$gender',country_id='$country_id',profile_birthday='$birthday',profile_self_introduction='$introduction' WHERE user_id='$user_id'";
        $result=$this->conn->query($sql);
        return $result;
        $this->conn->close();
    }
    
    public function update_avatar($photo_filename,$photo_tmpname,$directory,$user_id){
        $extension=pathinfo($photo_filename,PATHINFO_EXTENSION);
        $photo_extension=array('PNG','png','JPG','jpg','JPEG','jpeg','GIF','gif','JFIF','jfif');
        if(in_array($extension,$photo_extension)){
            $new_directory=$directory.$photo_filename;
            if(move_uploaded_file($photo_tmpname,$new_directory)){
                $sql="UPDATE profiles SET profile_avatar='$new_directory' WHERE user_id='$user_id' ";
                $result=$this->conn->query($sql);
                return $result;
            }
        }
    }

    public function delete_avatar($user_id){
        $sql= "UPDATE profiles SET profile_avatar=NULL WHERE user_id='$user_id'";
        $result=$this->conn->query($sql);
        return $result;
    }

    public function deactivate_profile($user_id){
        $sql = "UPDATE profiles SET profile_status='D' WHERE user_id='$user_id'";
        $result=$this->conn->query($sql);
        return $result;
    }
}