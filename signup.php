<?php
require_once 'classes/Country.php';
require_once 'classes/User.php';
require_once 'classes/Profile.php';
$country=new Country;
$user=new User;
$profile=new Profile;
$err_msg=null;
$duplicate_msg=null;
$page_flag=0;
$country_list=$country->display_all_countries();

if(isset($_POST['confirm'])){
  $email=$_POST['email'];
  $count=$user->search_adduser_duplicate($email);
  if($count['duplicate']==0 && $_POST['password']==$_POST['password_confirm']){
    $page_flag=1;
    $country_id=$_POST['country'];
    $country_info=$country->get_country_info($country_id);
  }else{
    if($count['duplicate']>0){
      $duplicate_msg="E-mail already exists";
    }
    if($_POST['password'] != $_POST['password_confirm']){
      $err_msg="Password does not match";
    }
  }
}elseif(isset($_POST['register'])){
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $username=$_POST['username'];
  $gender=$_POST['gender'];
  $birthday=$_POST['birthday'];
  $country_id=$_POST['country'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $self_introduction=$_POST['self_introduction'];
  

  $user_id=$user->add_user($username,$email,$password);
  if($user_id){
    $result=$profile->add_profile($firstname,$lastname,$gender,$country_id,$birthday,$self_introduction,$user_id);
    if($result==TRUE){
      $page_flag=2;
    }
  }

}

require_once 'header.html';

?>

<style>
main{
    background: url(images/tongariro.jpg);
    background-position: center;
    background-attachment:fixed;
    background-size:cover;
    padding:100px 0;
}

.card{
    background:rgba(85, 40, 1, 0.7);
    color:white;
}

</style>
    <main>
      <?php if($page_flag===1):?>
      <div class="container">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Confirm</h4>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <tr>
                <th>Name</th>
                <td><?php echo $_POST['firstname']." ".$_POST['lastname']?></td>
              </tr>
              <tr>
                <th>Gender</th>
                <td><?php echo $_POST['gender']?></td>
              </tr>
              <tr>
                <th>User name</th>
                <td><?php echo $_POST['username']?></td>
              </tr>
              <tr>
                <th>Birthday</th>
                <td><?php echo $_POST['birthday']?></td>
              </tr>
              <tr>
                <th>Country</th>
                <td><?php echo $country_info['country_name']?></td>
              </tr>
              <tr>
                <th>E-mail</th>
                <td><?php echo $_POST['email']?></td>
              </tr>
              <tr>
                <th>Password</th>
                <td><?php echo str_repeat("*",mb_strlen($_POST['password'],"UTF8"));?></td>
              </tr>
              <tr>
                <th>Self introduction</th>
                <td><?php echo $_POST['self_introduction']?></td>
              </tr>
            </table>
          </div>
          <div class="card-footer">
            <form method="POST">
              <button type="submit" class="btn btn-dark" name="register">Register</button>
              <button type="submit" class="btn btn-outline-secondary" name="back">back</button>
              <input type="hidden" name="firstname" value="<?php echo $_POST['firstname']?>">
              <input type="hidden" name="lastname" value="<?php echo $_POST['lastname']?>">
              <input type="hidden" name="gender" value="<?php echo $_POST['gender']?>">
              <input type="hidden" name="username" value="<?php echo $_POST['username']?>">
              <input type="hidden" name="birthday" value="<?php echo $_POST['birthday']?>">
              <input type="hidden" name="country" value="<?php echo $_POST['country']?>">
              <input type="hidden" name="email" value="<?php echo $_POST['email']?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password']?>">
              <input type="hidden" name="self_introduction" value="<?php echo $_POST['self_introduction']?>">
            </form>
          </div>
        </div>
      </div>
      <?php elseif($page_flag==2):?>
      <div class="container">
        <div class="card mt-3 mb-3">
          <div class="card-body text-center">
            <div class="alert alert-success"> Registered successfully</div>
            <a href="login.php" class="btn btn-info btn-lg">Login from Login page</a>
          </div>
        </div>
      </div>
      <?php else:?>
      <div class="container">
        <div class="card mt-3 mb-3">
          <div class="card-header">
            <h4 class="card-title">Sign up</h4>
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="form-group col-5">
                  <label for="firstname">First name</label>
                  <input type="text" name="firstname" id="" class="form-control" placeholder="first name" required <?php if(isset($_POST['firstname'])):?> value="<?php echo $_POST['firstname']?>" <?php endif ?>>
                </div>
                <div class="form-group col-5">
                  <label for="lastname">Last name</label>
                  <input type="text" name="lastname" id="" class="form-control" placeholder="last name" required <?php if(isset($_POST['lastname'])):?> value="<?php echo $_POST['lastname']?>" <?php endif ?>>
                </div>
                <div class="form-group col-2">
                  <label for="gender">Gender</label>
                  <select name="gender" id="" class="form-control">
                    <option value="M">M</option>
                    <option value="F">F</option>
                  </select>
                </div>
                <div class="form-group col-4">
                  <label for="lastname">Username</label>
                  <input type="text" name="username" id="" class="form-control" placeholder="username" required <?php if(isset($_POST['lastname'])):?> value="<?php echo $_POST['lastname']?>" <?php endif ?>>
                </div>
                <div class="form-group col-3">
                  <label for="birthday">Birthday</label>
                  <input type="date" name="birthday" id="" class="form-control"required <?php if(isset($_POST['birthday'])):?> value="<?php echo $_POST['birthday']?>" <?php endif ?>>
                </div>
                <div class="form-group col-5">
                  <label for="country">Country</label>
                  <select class="form-control" name="country" id="">
                  <option value="">choose or type your country</option>
                  <?php foreach($country_list as $key=>$values):?>
                    <option value="<?php echo $values['id']?>"<?php if(isset($_POST['country'])){if($_POST['country']==$values['id']){echo 'selected';}}?>><?php echo $values['country_name']?></option>
                  <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group col-12">
                  <label for="email">E-mail</label>
                  <input type="email" name="email" id="" class="form-control <?php if(!empty($duplicate_msg)):?>is-invalid<?php endif ?>" placeholder="E-mail" required <?php if(isset($_POST['email'])):?> value="<?php echo $_POST['email']?>" <?php endif ?>>
                  <span class="invalid-feedback"><?php echo $duplicate_msg?></span>
                </div>
                <?php echo $duplicate_msg?>
                <div class="form-group col-6">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="" class="form-control <?php if(!empty($err_msg)):?>is-invalid<?php endif ?>" placeholder="password">
                  <span class="invalid-feedback"><?php echo $err_msg ?></span>
                </div>
                <div class="form-group col-6">
                  <label for="password_confirm">Password confirm</label>
                  <input type="password" name="password_confirm" id="" class="form-control <?php if(!empty($err_msg)):?>is-invalid<?php endif ?>" placeholder="password confirm">
                </div>
                <span class="invalid-feedback"><?php echo $err_msg ?></span>
                <div class="form-group col-12">
                  <label for="self_introduction">Self introduction</label>
                  <textarea name="self_introduction" class="form-control" id="" cols="30" rows="10"><?php if(isset($_POST['self_introduction'])){echo $_POST['self_introduction'];}?></textarea>
                </div>
              </div>
              <button type="submit" name="confirm" class="btn btn-dark">Confirm</button>
            </form>
          </div>
        </div>
      </div>
    <?php endif ?>
    </main>
 
    <?php

    require_once 'footer.html';