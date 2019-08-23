<?php

require_once '../../classes/Place.php';
$city_id=$_POST['id'];
$place=new Place;

$get_places=$place->display_place($city_id);
?>
<?php if($get_places==TRUE):?>
<label for="place">Place</label>
<select name="place" class="form-control">
    <?php foreach($get_places as $key=>$values):?>
    <option value="<?php echo $values['place_id']?>"><?php echo $values['city_name'];?></option>
    <?php endforeach?>
    <option value="none" class="">OTHER</option>
</select>
<?php else: ?>
<label for="new-city"> Add new city</label>
<input type="text" class="form-control" name="new-city" id="">
<?php endif ?>
