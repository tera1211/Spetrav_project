<?php

require_once 'Config.php';

class Country extends Config{
    public function display_all_countries(){
        $sql = "SELECT * FROM countries ORDER BY country_name ASC";
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

    public function get_country_info($country_id){
        $sql = "SELECT * FROM countries WHERE country_id='$country_id'";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }
}