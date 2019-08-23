<?php

require_once 'header.php';
if(isset($_POST['add_post'])){
    $country_id=$_POST['country'];
    $state_id=$_POST['state'];
    $city_name=$_POST['city'];

    $city_id=null;
    $city_count=$city->search_addcity_duplicate($city_name);
    $get_one_city=$city->get_city_by_name($city_name);
    if($city_count['duplicate']>0){
        $city_id=$get_one_city['id'];
    }else{
        $city_id=$city->add_city($city_name,$state_id,$country_id);
    }

    $place_id=null;
    $place_name=$_POST['place'];
    $place_count=$place->search_addplace_duplicate($state_id,$city_id,$place_name);
    $get_one_place=$place->get_place_by_name($place_name);
    if($place_count['duplicate']>0){
        $place_id=$get_one_place['place_id'];
    }else{
        $place_add=$place->add_place($state_id,$city_id,$place_name);
        if($place_add==TRUE){
            $place_id=$place->conn->insert_id;
        }
    }

    $category_id=$_POST['category'];
    $post_title=$_POST['post_title'];
    $post_content=$_POST['content'];
    
    $result=$post->add_post($user_id,$state_id,$city_id,$place_id,$category_id,$post_title,$post_content);
    if($result==TRUE){
        $post_id=$post->conn->insert_id;

        if(!empty(array_filter($_FILES['post_pictures']['name']))){
            foreach($_FILES['post_pictures']['name'] as $key=>$values){
                $photo_filename=basename($_FILES['post_pictures']['name'][$key]);
                $photo_tmpname= $_FILES['post_pictures']['tmp_name'][$key];
                $directory="images/";
                $add_pictures=$picture->add_post_pictures($photo_filename,$photo_tmpname,$directory,$post_id);
            }
            if($add_pictures==TRUE){
                echo "<div class='alert alert-success'>Posted successfully</div>";
            }
        }else{
            echo "<div class='alert alert-success'>Posted successfully</div>";
        }
    }else{
        echo "<div class='alert alert-danger'> Upload failed </div>";
    }
}

?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">ADD POST</h1>
    <div class="container">
        <div class="card">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                          <label for="country">Country</label>
                          <select class="form-control" name="country" id="country">
                            <option>Choose or type the country</option>
                            <?php foreach($get_countries as $key=>$values):?>
                            <option value="<?php echo $values['id'];?>"><?php echo $values['country_name']?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group col-6" id="state-select">
                        </div>
                        <div class="form-group col-6" id="city">
                            <label for="city">City</label>
                            <input type="text" name="city" id="" class="form-control" placeholder="city">
                        </div>
                        <div class="form-group col-6" id="place">
                            <label for="place">Place</label>
                            <input type="text" name="place" class="form-control" placeholder="place">
                        </div>
                        <div class="form-group col-6">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" id="">
                                <?php foreach($get_categories as $key=>$values):?>
                                <option value="<?php echo $values['category_no']?>"><?php echo $values['category_name']?></option>
                                <?php endforeach ?>
                                <option value="" class="">OTHER</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="post_title">Post title</label>
                            <input type="text" name="post_title" id="" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="post_pictures">Picture</label>
                            <input type="file" name="post_pictures[]" id="" class="form-control" multiple>
                        </div> 
                        <div class="form-group col-12">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="add_post" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<?php

require_once 'footer.php';