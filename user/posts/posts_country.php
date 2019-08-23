<?php
require_once '../../classes/Post.php';
require_once '../../classes/Picture.php';
$post=new Post;
$picture=new Picture;

$country_id=$_POST['country'];
$category_id=$_POST['category'];
$get_post_by_country=null;
if(empty($category_id)){
    $get_post_by_country=$post->get_post_by_country($country_id);
}else{
    $get_post_by_country=$post->get_post_by_country_category($country_id,$category_id);
}
?>

<?php if($get_post_by_country==TRUE):?>
<?php foreach($get_post_by_country as $key=>$values):?>
<div class="card my-4">
    <div class="card-header">
        <h5>
            <a href="<?php if($_SESSION['id']!=$values['user_id']):?>user_profile.php?id=<?php echo $values['user_id']?><?php else:?> ../users/profile.php?id='<?php echo $_SESSION['id']?><?php endif?>">
            <span><img src="<?php if(!empty($values['profile_avatar'])){echo $values['profile_avatar'];}else{echo 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png';}?>" alt="" width="50" class="rounded-circle"></span> <?php echo $values['user_name']?>
            </a>
        </h5>
        <span class="float-right"><?php echo $values['posted_datetime']?></span>
        <h5>Category:<?php echo $values['category_name']?></h5>
        <h6>
            Country: <?php echo $values['country_name']?> /
            State: <?php echo $values['state_name']?> /
            City:<?php echo $values['city_name'] ?> /
            Place:<?php echo $values['place_name']?> 
        </h6>
    </div>
    <div class="card-body">
        <h6><?php echo $values['post_content']?></h6>
        <?php 
        $post_no=$values['post_no'];
        $get_pictures=$picture->display_post_pictures($post_no);
        if($get_pictures==TRUE){
            foreach($get_pictures as $keys=>$rows){
        ?>
        <img src="../../<?php echo $rows['picture_name']?>" class="d-inline m-3" alt="" width="30%">

        <?php
            }
        }
        ?>
    </div>
</div>
<?php endforeach ?>
<?php endif?>