<?php

require_once 'Config.php';
class Post extends Config{
    public function display_all_posts(){
        $sql = "SELECT * FROM posts JOIN countries ON posts.country_id=countries.country_id 
                JOIN cities ON posts.city_id=cities.city_id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' ORDER BY countries.country_name ASC";
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

    public function add_post($post_title,$country_id,$city_id,$place_id,$category_id,$post_content){
        $sql = "INSERT INTO posts(post_title,country_id,city_id,place_id,category_id,post_content)
                VALUES('$post_title','$country_id','$city_id','$place_id','$category_id','$post_content')";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return $this->conn->insert_id;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

    public function update_post_picture($post_picture_filename,$post_picture_tmpname,$directory,$post_no){
        $extension=pathinfo($post_picture_filename,PATHINFO);
        $photo_extension=array('png','jpg','jpeg','gif','jfif');
        if(in_array($extension,$photo_extension)){
            $new_directory=$directory.$post_picture_filename;
            if(move_uploaded_file($post_picture_tmpname,$new_directory)){
                $sql = "UPDATE posts SET post_picture='$new_directory' WHERE post_no='$post_no'";
                $result=$this->conn->query($sql);
                return $result;
            }
        }
        $this->conn->close();
    }

    public function count_posts(){
        $sql = "SELECT COUNT(*) AS total_posts FROM posts WHERE post_status='A'";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

}