<?php
require_once 'header.php';
$place_id=$_GET['id'];

$get_one_place=$place->display_one_place($place_id);
$country_id=$get_one_place['country_id'];
$get_specific_states=$state->display_states($country_id);

$duplicate_msg=null;
if(isset($_POST['update_place'])){
    $place_name=$_POST['place'];
    $state_id=$_POST['state'];
    $city_id=$_POST['city'];
    $place_duplicate=$place->search_updateplace_duplicate($state_id,$city_id,$place_name,$place_id);
    if($place_duplicate['duplicate']>0){
        $duplicate_msg="Place already exist";
    }else{
        $result=$place->update_place($state_id,$city_id,$place_name,$place_id);
        if($result==TRUE){
            $place->redirect('list.php');
        }
    }
}

?>

<div class="container-fluid">

    <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">UPDATE PLACE</h1>

    <!-- DataTales Example -->
    <form action="" method="post">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="country">Country</label>
                        <select class="form-control" name="country" id="country">
                            <option>Choose or type the country</option>
                            <?php foreach($get_countries as $key=>$values):?>
                            <option value="<?php echo $values['id'];?>" <?php if($values['id']==$get_one_place['country_id']):?> selected <?php endif?>><?php echo $values['country_name']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-6" id="state-select">
                        <label for="state">State</label>
                        <select name="state" id="state" class="form-control">
                            <?php foreach($get_specific_states as $key=>$values):?>
                            <option value="<?php echo $values['id']?>" <?php if($values['id']==$get_one_place['state_id']):?> selected<?php endif ?>><?php echo $values['state_name']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-6" id="city-select">
                        <label for="city">City</label>
                        <select name="city" class="form-control" id="city">
                            <option value="<?php echo $get_one_place['city_id']?>"><?php echo $get_one_place['city_name']?></option>
                        </select>
                    </div>
                    <div class="form-group col-6" id="place">
                        <label for="place">New Place</label>
                        <input type="text" name="place" class="form-control  <?php if(!empty($duplicate_msg)):?> is-invalid<?php endif ?>" placeholder="place" id="place" value="<?php echo $get_one_place['place_name']?>">
                        <span id="error" class ="invalid-feedback"><?php echo $duplicate_msg ?></span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-secondary" href="list.php">Back to list</a>
                <button type="submit" name="update_place" id="update_place" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>

<?php

include_once 'footer.php';

?>