<?php 

require_once 'Config.php';

class Place extends Config{
    public function display_all_places(){
        $sql = "SELECT * FROM places JOIN countries ON places.country_id=countries.country_id
                JOIN cities ON places.city_id=cities.city_id";
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
        $this->conn->close();
    }

    public function search_addplace_duplicate($country_id,$city_id,$place_name){
        $new_place_name=ucfirst($place_name);
        $sql="SELECT COUNT(*) AS duplicate FROM places WHERE country_id='$country_id' AND city_id='$city_id' AND place_name='$new_place_name' AND place_status='A' ";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function add_place($country_id,$city_id,$place_name){
        $new_place_name=ucfirst($place_name);
        $sql="INSERT INTO places(country_id,city_id,place_name) VALUES('$country_id','$city_id','$new_place_name')";
        $result=$this->conn->query($sql);
        return $result;
        $this->conn->close();
    }

    public function count_places(){
        $sql="SELECT COUNT(*) AS total_places FROM places WHERE place_status='A'";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }
}