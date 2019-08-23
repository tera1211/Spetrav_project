<?php

require_once 'Config.php';
class Post extends Config{
    public function display_all_posts(){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
                JOIN profiles ON users.user_id=profiles.user_id
                JOIN states ON posts.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON posts.city_id=cities.id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' ORDER BY posts.posted_datetime DESC";
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


    public function display_user_post($user_id){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
                JOIN states ON posts.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON posts.city_id=cities.id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND posts.user_id='$user_id' ORDER BY posts.posted_datetime DESC";
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

    public function get_post_info($post_no){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
                JOIN states ON posts.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON posts.city_id=cities.id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND posts.post_no='$post_no'";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }

    public function get_post_by_country($country_id){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
        JOIN states ON posts.state_id=states.id
        JOIN countries ON states.country_id=countries.id
        JOIN cities ON posts.city_id=cities.id
        JOIN places ON posts.place_id=places.place_id
        JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND states.country_id='$country_id' ORDER BY posts.posted_datetime DESC";
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

    public function get_post_by_state($state_id){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
                JOIN states ON posts.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON posts.city_id=cities.id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND posts.state_id='$state_id' ORDER BY countries.country_name ASC,states.state_name ASC,cities.city_name ASC,posts.posted_datetime DESC";
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

    public function get_post_by_city($city_id){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
        JOIN states ON posts.state_id=states.id
        JOIN countries ON states.country_id=countries.id
        JOIN cities ON posts.city_id=cities.id
        JOIN places ON posts.place_id=places.place_id
        JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND posts.city_id='$city_id' ORDER BY countries.country_name ASC,states.state_name ASC,cities.city_name ASC,posts.posted_datetime DESC";
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

    public function get_post_by_country_category($country_id,$category_id){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
                JOIN states ON posts.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON posts.city_id=cities.id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND posts.category_id='$category_id' AND states.country_id='$country_id' ORDER BY countries.country_name ASC,states.state_name ASC,cities.city_name ASC,posts.posted_datetime DESC";
        
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
    public function get_post_by_country_state_category($country_id,$state_id,$category_id){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
                JOIN states ON posts.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON posts.city_id=cities.id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND posts.category_id='$category_id' AND states.country_id='$country_id' AND posts.state_id='$state_id' ORDER BY countries.country_name ASC,states.state_name ASC,cities.city_name ASC,posts.posted_datetime DESC";
        
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

    public function get_post_by_country_state_city_category($country_id,$state_id,$city_id,$category_id){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
                JOIN states ON posts.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON posts.city_id=cities.id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND posts.category_id='$category_id' AND states.country_id='$country_id' AND posts.state_id='$state_id' AND posts.city_id='$city_id' ORDER BY countries.country_name ASC,states.state_name ASC,cities.city_name ASC,posts.posted_datetime DESC";
        
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

    public function get_post_by_category($category_id){
        $sql = "SELECT * FROM posts JOIN users ON posts.user_id=users.user_id
                JOIN states ON posts.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON posts.city_id=cities.id
                JOIN places ON posts.place_id=places.place_id
                JOIN categories ON posts.category_id=categories.category_no WHERE post_status='A' AND posts.category_id='$category_id' ORDER BY countries.country_name ASC,states.state_name ASC,cities.city_name ASC,posts.posted_datetime DESC";
        
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

    public function add_post($user_id,$state_id,$city_id,$place_id,$category_id,$post_title,$post_content){
        $sql = "INSERT INTO posts(user_id,state_id,city_id,place_id,category_id,post_title,post_content)
                VALUES('$user_id','$state_id','$city_id','$place_id','$category_id','$post_title','$post_content')";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return true;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

    public function update_post($user_id,$state_id,$city_id,$place_id,$category_id,$post_title,$post_content,$post_no){
        $sql = "UPDATE posts SET user_id='$user_id', state_id='$state_id', city_id='$city_id', place_id='$place_id', category_id='$category_id', post_title='$post_title', post_content='$post_content' WHERE post_no='$post_no' ";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return true;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close;
    }
    public function count_posts(){
        $sql = "SELECT COUNT(*) AS total_posts FROM posts WHERE post_status='A'";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function delete_post($post_no){
        $sql="UPDATE posts SET post_status='D' WHERE post_no='$post_no' ";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return true;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }

}