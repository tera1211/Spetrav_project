<?php 

require_once 'Config.php';

class Category extends Config{
    public function display_all_categories(){
        $sql="SELECT * FROM categories WHERE category_status='A' ORDER BY category_name ASC";
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
    
    public function search_addcategory_duplicate($category_name){
        $new_category_name=ucfirst($category_name);
        $sql = "SELECT COUNT(*) AS duplicate FROM categories WHERE category_name='$new_category_name'";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function add_category($category_name,$created_date){
        $new_category_name=ucfirst($category_name);
        $sql = "INSERT INTO categories(category_name,category_created) VALUES('$new_category_name','$created_date')";
        $result=$this->conn->query($sql);
        return $result;
        $this->conn->close();
    }



    public function get_category_info($category_no){
        $sql="SELECT * FROM categories WHERE category_no='$category_no' ";
        $result=$this->conn->query($sql);
        $id=$result->fetch_assoc();
        return $id;
        $this->conn->close();
    }


    public function search_updatecategory_duplicate($category_name,$category_no){
        $new_category_name=ucfirst($category_name);
        $sql="SELECT COUNT(*) AS duplicate FROM categories WHERE category_name='$new_category_name' AND category_no != '$category_no' ";
        $result=$this->conn->query($sql);
        $count=$result->fetch_assoc();
        return $count;
        $this->conn->close();
    }

    public function update_category($category_name,$category_updated,$category_no){
        $new_category_name=ucfirst($category_name);
        $sql = "UPDATE categories SET category_name='$new_category_name', category_created='$category_updated' WHERE category_no='$category_no'";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            $this->redirect('list.php');
        }else{
            echo "ERROR:".$this->conn->error;
        }
        $this->conn->close();
    }
    
    public function deactivate_category($category_no){
        $sql="UPDATE categories SET category_status='D' WHERE category_no='$category_no' ";
        $result=$this->conn->query($sql);
        if($result==TRUE){
            $this->redirect('list.php');
        }
        $this->conn->close();
    }


}
