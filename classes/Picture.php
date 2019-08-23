<?php

require_once 'Config.php';
class Picture extends Config{
    public function add_post_pictures($photo_filename,$photo_tmpname,$directory,$post_no){
        $extension=pathinfo($photo_filename,PATHINFO_EXTENSION);
        $photo_extension=array('PNG','png','JPG','jpg','JPEG','jpeg','GIF','gif','JFIF','jfif');
        if(in_array($extension,$photo_extension)){
            $new_directory="../../".$directory.$photo_filename;
            $mysql_directory=$directory.$photo_filename;
            if(move_uploaded_file($photo_tmpname,$new_directory)){
                $sql="INSERT INTO pictures(picture_name,post_no) VALUES('$mysql_directory','$post_no') ";
                $result=$this->conn->query($sql);
                return $result;
            }else{
                echo "ERROR:".$this->conn->error;
            }
        } else {
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

    public function display_post_pictures($post_no){
        $sql = "SELECT * FROM pictures WHERE post_no='$post_no' AND picture_status='A'";
        $result=$this->conn->query($sql);
        if($result->num_rows>0){
            $rows=array();
            while($row=$result->fetch_assoc()){
                $rows[]=$row;
            }
            return $rows;
        }else{
            return false;
        }if($result==false){
            echo "ERROR:".$this->conn->error;
        }
    }

    public function get_picture_by_id($picture_id){
        $sql = "SELECT * FROM pictures WHERE picture_id='$picture_id'";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }

    public function update_picture($photo_filename,$photo_tmpname,$directory,$picture_id){
        $extension=pathinfo($photo_filename,PATHINFO_EXTENSION);
        $photo_extension=array('PNG','png','JPG','jpg','JPEG','jpeg','GIF','gif','JFIF','jfif');
        if(in_array($extension,$photo_extension)){
            $new_directory="../../".$directory.$photo_filename;
            $mysql_directory=$directory.$photo_filename;
            if(move_uploaded_file($photo_tmpname,$new_directory)){
                $sql="UPDATE pictures SET picture_name='$mysql_directory' WHERE picture_id='$picture_id' ";
                $result=$this->conn->query($sql);
                return $result;
            }else{
                echo "ERROR:".$this->conn->error;
            }
        } else {
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

    public function delete_multiple_pictures($post_no){
        $sql = "UPDATE pictures SET picture_status='D' WHERE post_no='$post_no' ";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return true;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

    public function delete_single_picture($picture_id){
        $sql = "UPDATE pictures SET picture_status='D' WHERE picture_id='$picture_id' ";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return true;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

}