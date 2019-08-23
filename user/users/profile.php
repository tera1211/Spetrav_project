<?php

require_once 'header.php';

$user_id=$_SESSION['id'];
$profile_info=$profile->get_profile_by_user_id($user_id);
$get_user_posts=$post->display_user_post($user_id);
$duplicate_msg=null;

if(isset($_POST['update'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $gender=$_POST['gender'];
    $username=$_POST['username'];
    $birthday=$_POST['birthday'];
    $country_id=$_POST['country'];
    $email=$_POST['email'];
    $self_introduction=$_POST['self_introduction'];

    $count=$user->search_updateuser_duplicate($email,$user_id);
    if($count['duplicate']>0){
        $duplicate_msg="<span class='invalid-feedback'>E-mail already exists</span> ";
    }else{
        $user_info_update=$user->update_user($email,$username,$user_id);
        $profile_info_update=$profile->update_profile($firstname,$lastname,$gender,$country_id,$birthday,$self_introduction,$user_id);
        if($user_info_update==TRUE && $profile_info_update==TRUE){
            echo "<div class='alert alert-success'>Profile updated</div>";
        }else{
            echo "ERROR:".$profile->conn->error;
        }
    }
}

if(isset($_POST['update_image'])){
    $photo_filename=$_FILES['profile_photo']['name'];
    $photo_tmpname=$_FILES['profile_photo']['tmp_name'];

    $directory="../../images/";

    $result=$profile->update_avatar($photo_filename,$photo_tmpname,$directory,$user_id);
    if($result==TRUE){
        $profile->redirect("profile.php?id=$user_id");
    }else{
        echo "ERROR:".$profile->conn->error;
    }
}

if(isset($_POST['delete_image'])){
    $result=$profile->delete_avatar($user_id);
    if($result==TRUE){
        $profile->redirect("profile.php?id=$user_id");
    }
}
if(isset($_POST['update_password'])){
    $password=$_POST['password'];
    $pass_confirm=$_POST['confirm_password'];

    if($password !=$pass_confirm){
        echo "<div class='alert alert-warning'>
            your password did not match
            </div>";
    }else{
        $result=$user->update_password($password,$user_id);
        
        if($result===true){
            echo "<div class='alert alert-success'>
                Updated successfully
                </div>";
        }else{
            echo"<div class='alert alert-danger'>
            Update failed
            </div>";
        }
    }
}

if(isset($_POST['deactivate'])){
    $user_deactivate=$user->deactivate_user($user_id);
    $profile_deactivate=$profile->deactivate_profile($user_id);

    if($user_deactivate==TRUE && $profile_deactivate==TRUE){
        $profile->redirect('../../logout.php');
    }
}
?>

<style>
main{
    background: url(../../images/lake.jpg);
    background-position: center;
    background-attachment:fixed;
    background-size:cover;
    padding-bottom:30px;
}

.card{
    background:rgba(85, 40, 1, 0.7);
    color:white;
}

</style>
<main>

    <section id="edit-profile">
        
        <div class="container mx-auto">
            <div class="row">
                <div class="card col-8 mx-1 my-2">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <form method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-5">
                                    <label for="firstname">First name</label>
                                    <input type="text" name="firstname" id="" class="form-control" placeholder="first name" required  value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];}else{echo $profile_info['profile_firstname'];} ?>">
                                </div>
                                <div class="form-group col-5">
                                    <label for="lastname">Last name</label>
                                    <input type="text" name="lastname" id="" class="form-control" placeholder="last name" required value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];}else{echo $profile_info['profile_lastname'];} ?>">
                                </div>
                                <div class="form-group col-2">
                                  <label for="gender">Gender</label>
                                  <select class="form-control" name="gender" id="">
                                    <option value="M" <?php if($profile_info['profile_gender']=='M'):?>selected<?php endif ?>>M</option>
                                    <option value="F" <?php if($profile_info['profile_gender']=='F'):?>selected<?php endif ?>>F</option>
                                  </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="lastname">Username</label>
                                    <input type="text" name="username" id="" class="form-control" placeholder="username" required value="<?php if(isset($_POST['username'])){echo $_POST['username'];}else{echo $profile_info['user_name'];} ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label for="birthday">Birthday</label>
                                    <input type="date" name="birthday" id="" class="form-control"required value="<?php if(isset($_POST['birthday'])){echo $_POST['birthday'];}else{echo $profile_info['profile_birthday'];} ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label for="country">Your Country</label>
                                    <select class="form-control" name="country" id="">
                                    <option value="country">choose or type your country</option>
                                    <?php foreach($get_country as $key=>$values):?>
                                        <option value="<?php echo $values['id']?>"<?php if(isset($_POST['country'])){if($_POST['country']==$values['id']){echo 'selected';}}else{if($values['id']==$profile_info['country_id']){echo 'selected';}}?>><?php echo $values['country_name']?></option>
                                    <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="" class="form-control <?php if(!empty($duplicate_msg)):?> is-invalid<?php endif ?>" placeholder="E-mail" <?php if(!empty($duplicate_msg)):?> style="background-color:pink"<?php endif ?>required value="<?php if(isset($_POST['email'])){echo $_POST['email'];}else{echo $profile_info['user_email'];} ?>">
                                    <?php if(isset($duplicate_msg)){echo $duplicate_msg;}?>
                                </div>
                            
                                <div class="form-group col-12">
                                  <label for="self_introduction">Self introduction</label>
                                  <textarea name="self_introduction" class="form-control" id="" cols="30" rows="10"><?php if(isset($_POST['self_introduction'])){echo $_POST['self_introduction'];}else{echo $profile_info['profile_self_introduction'];} ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Update" class="btn btn-success btn-block" name="update">
                        </div>
                    </form>
                </div>
                <div class="card col-3 my-2">
                    <div class="card-header">
                        <h3>Your Avatar</h3>
                    </div>
                    <div class="card-body">
                        <img src="<?php if(empty($profile_info['profile_avatar'])):?>https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png<?php else:?><?php echo $profile_info['profile_avatar'];?><?php endif?>" alt="avatar" class="img-fluid d-block mb-3">
                        <button class="btn btn-info btn-block" data-toggle="modal" data-target="#img-modal"><i class="fa fa-pencil"></i> Edit Image</button>
                        <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#img-delete-modal"><i class="fa fa-remove"></i> Delete Image</button>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#password_modal">Change Password</button>
                        <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#account-delete-modal">Delete account</button>
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