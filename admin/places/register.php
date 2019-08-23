<?php
require_once 'header.php';
$duplicate_msg=null;
if(isset($_POST['add_place'])){
    $place_name=$_POST['place'];
    $state_id=$_POST['state'];
    $city_id=$_POST['city'];
    $place_duplicate=$place->search_addplace_duplicate($state_id,$city_id,$place_name);
    if($place_duplicate['duplicate']>0){
        $duplicate_msg="Place already exist";
    }else{
        $result=$place->add_place($state_id,$city_id,$place_name);
        if($result==TRUE){
            $place->redirect('list.php');
        }
    }
}

?>

<div class="container-fluid">

    <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">ADD PLACE</h1>

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
                            <option value="<?php echo $values['id'];?>"><?php echo $values['country_name']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-6" id="state-select">
                        <label for="state">State</label>
                        <select name="state" id="state" class="form-control">
                            <option>choose or type the state</option>
                        </select>
                    </div>
                    <div class="form-group col-6" id="city-select">
                        <label for="city">City</label>
                        <select name="city" class="form-control" id="city">
                            <option>Choose or type the city</option>
                        </select>
                    </div>
                    <div class="form-group col-6" id="place">
                        <label for="place">New Place</label>
                        <input type="text" name="place" class="form-control  <?php if(!empty($duplicate_msg)):?> is-invalid<?php endif ?>" placeholder="place" id="place">
                        <span id="error" class ="invalid-feedback"><?php echo $duplicate_msg ?></span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="add_place" id="add_place" class="btn btn-primary">Add place</button>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>

<?php

include_once 'footer.php';

?>