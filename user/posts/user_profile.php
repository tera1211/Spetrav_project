<?php

require_once 'header.php';

$user_id=$_GET['id'];
$profile_info=$profile->get_profile_by_user_id($user_id);
$get_user_posts=$post->display_user_post($user_id);
?>

<style>
main{
    background: url(../../images/lake.jpg);
    background-position: center;
    background-size:cover;
    background-attachment: fixed;
    padding:30px 0;
}

.card{
    background:rgba(85, 40, 1, 0.7);
    color:white;
}

</style>
<main>

    <section id="edit-profile">
        
        <div class="container">
            <div class="row">
                <div class="card col-8 mx-1 my-2">
                    <div class="card-header">
                        <h4><?php echo $profile_info['user_name']?> Profile</h4>
                    </div>
                    <form method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-5">
                                    <label for="firstname">First name</label>
                                    <input type="text" name="firstname" id="" class="form-control" placeholder="first name" value="<?php echo $profile_info['profile_firstname']; ?>" readonly>
                                </div>
                                <div class="form-group col-5">
                                    <label for="lastname">Last name</label>
                                    <input type="text" name="lastname" id="" class="form-control" placeholder="last name" value="<?php echo $profile_info['profile_lastname']; ?>" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label for="gender">Gender</label>
                                    <input value="<?php echo $profile_info['profile_gender']?>" class="form-control" readonly>
                                </div>
                                <div class="form-group col-3">
                                    <label for="lastname">Username</label>
                                    <input type="text" name="username" id="" class="form-control" placeholder="username" value="<?php echo $profile_info['user_name']; ?>" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label for="birthday">Birthday</label>
                                    <input type="date" name="birthday" id="" class="form-control" value="<?php echo $profile_info['profile_birthday']; ?>" readonly>
                                </div>
                                <div class="form-group col-5">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" value="<?php echo $profile_info['country_name']?>" readonly>
                                </div>
                                <div class="form-group col-12">
                                  <label for="self_introduction">Self introduction</label>
                                  <textarea name="self_introduction" class="form-control" id="" cols="30" rows="10" readonly><?php if(isset($_POST['self_introduction'])){echo $_POST['self_introduction'];}else{echo $profile_info['profile_self_introduction'];} ?></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card col-3 my-2">
                    <div class="card-header">
                        <h3>Avatar</h3>
                    </div>
                    <div class="card-body">
                        <img src="<?php if(empty($profile_info['profile_avatar'])):?>https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png<?php else:?><?php echo $profile_info['profile_avatar'];?><?php endif?>" alt="avatar" class="img-fluid d-block mb-3">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="mypost">
        <div class="container">
        <?php if($get_user_posts==TRUE):?>
            <?php foreach($get_user_posts as $key=>$values):?>
            <div class="card my-4">
                <div class="card-header">
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
        <?php endif ?>
        </div>
    </section>
    

</main>
<?php

require_once 'footer.php';

?>