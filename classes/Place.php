<?php 

require_once 'Config.php';

class Place extends Config{
    public function display_all_places(){
        $sql = "SELECT * FROM places JOIN states ON places.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON places.city_id=cities.id WHERE place_status='A'";
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

    public function display_place($city_id){
        $sql = "SELECT * FROM places JOIN states ON places.state_id=states.id
                JOIN cities ON places.city_id=cities.id WHERE city_id='$city_id' ";
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

    public function display_one_place($place_id){
        $sql = "SELECT * FROM places JOIN states ON places.state_id=states.id
                JOIN countries ON states.country_id=countries.id
                JOIN cities ON places.city_id=cities.id WHERE place_id='$place_id'";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }

    public function get_place_by_name($place_name){
        $new_place_name=ucfirst($place_name);
        $sql= "SELECT * FROM places WHERE place_name='$new_place_name'";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }

    public function search_addplace_duplicate($state_id,$city_id,$place_name){
        $new_place_name=ucfirst($place_name);
        $sql="SELECT COUNT(*) AS duplicate FROM places WHERE state_id='$state_id' AND city_id='$city_id' AND place_name='$new_place_name' AND place_status='A' ";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function add_place($state_id,$city_id,$place_name){
        $new_place_name=ucfirst($place_name);
        $sql="INSERT INTO places(state_id,city_id,place_name) VALUES('$state_id','$city_id','$new_place_name')";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return true;
        }else{
            echo "ERROR:". $this->conn->error;
        }
        $this->conn->close();
    }

    public function search_updateplace_duplicate($state_id,$city_id,$place_name,$place_id){
        $new_place_name=ucfirst($place_name);
        $sql="SELECT COUNT(*) AS duplicate FROM places WHERE state_id='$state_id' AND city_id='$city_id' AND place_name='$new_place_name' AND place_id!='$place_id' ";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function update_place($state_id,$city_id,$place_name,$place_id){
        $new_place_name=ucfirst($place_name);
        $sql="UPDATE places SET place_name='$new_place_name',state_id='$state_id', city_id='$city_id' WHERE place_id='$place_id' ";
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

    public function delete_place($place_id){
        $sql = "UPDATE places SET place_status='D' WHERE place_id='$place_id' ";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            return true;
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }
}