<?php

require_once '../../classes/City.php';
$state_id=$_POST['id'];
$city=new City;

$get_cities=$city->display_cities($state_id);
?>

<label for="city"> City</label>
<select name="city" class="form-control" id="city" onchange="selectPostbyCity()">
    <?php if($get_cities==TRUE):?>
    <?php foreach($get_cities as $key=>$values):?>
    <option value="<?php echo $values['id']?>"><?php echo $values['city_name'];?></option>
    <?php endforeach?>
    <?php else:?>
    <option value="47964" class="">OTHER</option>
    <?php endif ?>
</select>

