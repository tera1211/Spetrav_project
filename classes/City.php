<?php

require_once 'Config.php';
class City extends Config{
    public function display_all_cities(){
        $sql="SELECT * FROM cities WHERE city_status='A'";
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

    public function search_addcity_duplicate($country_id,$city_name){
        $new_city_name=ucfirst($city_name);
        $sql="SELECT COUNT(*) AS duplicate FROM cities WHERE country_id='$country_id' AND city_name='$new_city_name' ";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function add_cities($country_id,$city_name){
        $new_city_name=ucfirst($city_name);
        $sql="INSERT INTO cities(country_id,city_name) VALUES('$country_id','$new_city_name')";
        $result=$this->conn->query($sql);
        return $result;
        $this->conn->close();
    }

    public function count_cities(){
        $sql="SELECT COUNT(*) AS total_cities FROM cities WHERE city_status='A' ";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

}