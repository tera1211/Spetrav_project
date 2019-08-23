<?php

require_once 'Config.php';
class City extends Config{
    public function display_all_cities(){
        $sql = "SELECT * FROM cities";
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

    public function display_cities($state_id){
        $sql="SELECT * FROM cities WHERE state_id='$state_id' AND city_status='A' ORDER BY city_name ASC ";
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

    public function search_addcity_duplicate($city_name){
        $new_city_name=ucfirst($city_name);
        $sql="SELECT COUNT(*) AS duplicate FROM cities WHERE city_name='$new_city_name' ";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function get_city_by_name($city_name){
        $new_city_name=ucfirst($city_name);
        $sql="SELECT* FROM cities WHERE city_name='$new_city_name' ";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }

    public function add_city($city_name,$state_id,$country_id){
        $new_city_name=ucfirst($city_name);
        $sql="INSERT INTO cities(city_name,state_id,country_id) VALUES('$new_city_name','$state_id','$country_id')";
        $result=$this->conn->query($sql);
        if($result==TRUE){
           return $this->conn->insert_id;
        }
    }


}