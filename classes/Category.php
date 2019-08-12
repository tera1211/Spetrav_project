<?php 

require_once 'Config.php';

class Category extends Config{
    public function display_all_categories(){
        $sql="SELECT * FROM categories WHERE category_status='A'";
        $result=$this->conn->query($sql);
        if($result->num_rows>0){
            $rows=array();
            while($row=$result->fetch_assoc()){
                $rows[]=$row;
            }
            return $rows;
        }else{
            return false;
        }
        $this->conn->close();
    }

    public function count_categories(){
        $sql = "SELECT COUNT(*) AS total_categories FROM categories WHERE category_status='A'";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }
}
