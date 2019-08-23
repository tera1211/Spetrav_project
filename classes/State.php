<?php
require_once 'Config.php';
class State extends Config{

    public function display_all_states(){
        $sql= "SELECT * FROM states";
        $result=$this->conn->query($sql);
        if($result->num_rows>0){
            $rows=array();
            while($row=$result->fetch_assoc()){
                $rows[]=$row;
            }
            return $rows;
        }else{
            return false;
        } if($result==FALSE){
            echo "ERROR:".$this->conn->error;
        }       
        $this->conn->close();
    }
    
    public function display_states($country_id){
        $sql = "SELECT * FROM states WHERE country_id='$country_id'";
        $result=$this->conn->query($sql);
        if($result->num_rows>0){
            $rows=array();
            while($row=$result->fetch_assoc()){
                $rows[]=$row;
            }
            return $rows;
        }else{
            return false;
        } if($result==FALSE){
            echo "ERROR:".$this->conn->error;
        }       
        $this->conn->close();
    }
}