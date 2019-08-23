<?php 
require_once '../../classes/Category.php';
$action=$_GET['action'];
$category=new Category;
if($action="ADD" AND isset($_POST['category'])){
    $category_name=$_POST['category'];
    $created_date=date('Y/m/d');
    $category_add_duplicate=$category->search_addcategory_duplicate($category_name);
    if($category_duplicate['duplicate']>0){
       echo "error";
    }else{
        $result=$category->add_category($category_name,$created_date);
        if($result=true){
           echo "success";
        }
    }
}

if($action="EDIT" && isset($_POST['update'])){
    $category_name=$_POST['update_category'];
    $category_updated=date('Y/m/d');
    $category_no=$_GET['id'];

    $count=$category->search_updatecategory_duplicate($category_name,$category_no);
    if($count['duplicate']>0){
        $duplicate_msg="<span class='invalid-feedback'>Category already exists</span>";
        return $duplicate_msg;
    }else{
        $category->update_category($category_name,$category_updated,$category_no);
    }
}