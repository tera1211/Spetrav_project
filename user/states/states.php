<?php

require_once '../../classes/State.php';
$country_id=$_POST['id'];
$state=new State;

$get_states=$state->display_states($country_id);
?>

<label for="state"> State</label>
<select name="state" class="form-control" id="state" onchange="citySelect()">
    <option value="">choose or type the state</option>
    <?php if($get_states==TRUE):?>
    <?php foreach($get_states as $key=>$values):?>
    <option value="<?php echo $values['id'];?>"><?php echo $values['state_name'];?></option>
    <?php endforeach;?>
    <option value="4029" >OTHER</option>
    <?php elseif($get_states==FALSE): ?>
    <option value="4029" >OTHER</option>
    <?php endif ?>
</select>

