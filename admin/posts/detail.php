<?php

require_once 'header.php';

$post_no=$_GET['id'];
$post_info=$post->get_post_info($post_no);
$display_pictures=$picture->display_post_pictures($post_no);
$post_country=$post_info['country_id'];
$get_states=$state->display_states($post_country);
if(isset($_POST['update_post'])){
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
        $place_id=$place->add_place($state_id,$city_id,$place_name);
    }

    $category_id=$_POST['category'];
    $post_title=$_POST['post_title'];
    $post_content=$_POST['content'];
    
    $result=$post->update_post($user_id,$state_id,$city_id,$place_id,$category_id,$post_title,$post_content,$post_no);
    if($result==TRUE){
    
        if(!empty(array_filter($_FILES['post_pictures']['name']))){
            foreach($_FILES['post_pictures']['name'] as $key=>$values){
                $photo_filename=basename($_FILES['post_pictures']['name'][$key]);
                $photo_tmpname= $_FILES['post_pictures']['tmp_name'][$key];
                $directory="images/";
                $add_pictures=$picture->add_post_pictures($photo_filename,$photo_tmpname,$directory,$post_no);
            }
            if($add_pictures==TRUE){
                $post->redirect("detail.php?id=$post_no");
            }
        }else{
            echo "<div class='alert alert-success'>Posted successfully</div>";
        }
    }
}

if(isset($_POST['delete'])){
    $delete_post=$post->delete_post($post_no);
    $delete_pictures=$picture->delete_multiple_pictures($post_no);
    if($delete_post==TRUE && $delete_pictures==TRUE){
        $post->redirect('dashboard.php');
    }
}

?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">POST DETAIL</h1>
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
                            <option value="<?php echo $values['id'];?>"<?php if(isset($_POST['country'])){if($values['id']==$_POST['country']){echo 'selected';}}elseif($values['id']==$post_info['country_id']){echo 'selected';} ?><?php if($_SESSION['permission'] !='A' || $_SESSION['id']!=$post_info['user_id']){echo 'readonly';} ?>><?php echo $values['country_name']?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group col-6" id="state-select">
                            <?php if(isset($post_info['state_id'])):?>
                            <label for="state"> State</label>
                            <select name="state" class="form-control" id="state">
                                <?php foreach($get_states as $key=>$values):?>
                                <option value="<?php echo $values['id'];?>" <?php if(isset($_POST['state'])){if($values['id']==$_POST['state']){echo 'selected';}}elseif($values['id']==$post_info['state_id']){echo 'selected';} ?>><?php echo $values['state_name'];?></option>
                                <?php endforeach;?>
                                <option value="4029" >OTHER</option>
                            </select>
                            <?php endif ?>
                        </div>
                        <div class="form-group col-6" id="city">
                            <label for="city">City</label>
                            <input type="text" name="city" id="" class="form-control" placeholder="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city'];}else{echo $post_info['city_name'];}?>" <?php if($_SESSION['permission'] !='A' || $_SESSION['id']!=$post_info['user_id']){echo 'readonly';} ?>>
                        </div>
                        <div class="form-group col-6" id="place">
                            <label for="place">Place</label>
                            <input type="text" name="place" class="form-control" placeholder="place" value="<?php if(isset($_POST['place'])){ echo $_POST['place'];}else{echo $post_info['place_name'];}?>" <?php if($_SESSION['permission'] !='A' || $_SESSION['id']!=$post_info['user_id']){echo 'readonly';} ?>>
                        </div>
                        <div class="form-group col-6">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" id="">
                                <?php foreach($get_categories as $key=>$values):?>
                                <option value="<?php echo $values['category_no']?>"<?php if(isset($_POST['category'])){if($values['category_no']==$_POST['category']){echo 'selected';}}elseif($values['category_no']==$post_info['category_id']){echo 'selected';} ?> <?php if($_SESSION['permission'] !='A' || $_SESSION['id']!=$post_info['user_id']){echo 'readonly';} ?>><?php echo $values['category_name']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="post_title">Post title</label>
                            <input type="text" name="post_title" id="" class="form-control" value="<?php if(isset($_POST['post_title'])){ echo $_POST['post_title'];}else{echo $post_info['post_title'];}?>" <?php if($_SESSION['permission'] !='A' || $_SESSION['id']!=$post_info['user_id']){echo 'readonly';} ?>>
                        </div>
                        <?php if($display_pictures==TRUE):?>
                        <?php foreach($display_pictures as $key=>$values):?>
                        <div class="card col-4">
                            <div class="card-body">
                                <img src="<?php echo '../../'.$values['picture_name'] ?>" style="width:100%"alt="">
                            </div>
                            <div class="card-footer">
                                <a href="picture_edit.php?id=<?php echo $values['picture_id']?>" class="btn btn-warning">Edit</a>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <?php else:?>
                        <div class="alert alert-secondary">
                            No picture for this post
                        </div>
                        <?php endif ?>
                        <div class="form-group col-12"<?php if($_SESSION['id']!=$post_info['user_id']): ?>style="display:none"<?php endif ?>>
                            <label for="post_pictures">Add Picture</label>
                            <input type="file" name="post_pictures[]" id="" class="form-control" multiple>
                        </div> 
                        <div class="form-group col-12">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="" rows="3" <?php if($_SESSION['permission'] !='A' || $_SESSION['id']!=$post_info['user_id']){echo 'readonly';} ?>><?php if(isset($_POST['content'])){ echo $_POST['content'];}else{echo $post_info['post_content'];}?></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer" <?php if($_SESSION['permission'] !='A' || $_SESSION['id']!=$post_info['user_id']): ?>style="display:none"<?php endif ?>>
                    <button type="submit" name="update_post" class="btn btn-primary">Update</button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#post_delete_modal">
                      Delete Post
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="post_delete_modal" tabindex="-1" role="dialog" aria-labelledby="post_delete_modal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title text-white">Delete post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete this post?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="delete" class="btn btn-danger">DELETE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<?php

require_once 'footer.php';