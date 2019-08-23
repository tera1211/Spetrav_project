<?php

require_once 'header.html';

session_start();

//echo $_SESSION['message'];
//unset($_SESSION['message']);
require_once 'classes/Config.php';
$login =new Config;
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $info=$login->login($email,$password);
    if(!empty($info)){
        $_SESSION['id']=$info['user_id'];
        $_SESSION['username']=$info['user_name'];
        $_SESSION['email']=$info['user_email'];
        $_SESSION['permission']=$info['user_permission'];
        $_SESSION['status']=$info['user_status'];

        if($_SESSION['status']=='D'){
            echo "<div class='alert alert-danger' role='alert'>
                Your account has been already deleted.
                </div>";
        }elseif($_SESSION['permission']=='A'){
            $login->redirect('admin/posts/dashboard.php');
        }elseif($_SESSION['permission']=='U'){
            $login->redirect('user/posts/list.php');
        }else{
            echo "<div class='alert alert-danger' role='alert'>
                    Invalid credentials
                    </div>";
        }
    }
}



?>

<style>
main{
    background: url(images/tongariro.jpg);
    background-position: center;
    background-attachment:fixed;
    background-size:cover;
    padding:150px 0;
}

.card{
    background:rgba(85, 40, 1, 0.7);
    width:60%;
    color:white;
}

</style>

    <main>
        <div class="container">
            <div class="card mx-auto">
                <div class="card-header text-center">
                    <h4 class="card-title">User Login</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" id="" placeholder="E-mail" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="" placeholder="password" class="form-control">
                            </div>
                        </div>
                </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-block btn-info" name="login">Log in</button>
                        <p class="mt-2">or</p>
                        <a href="signup.php" class="btn btn-warning px-4">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
 <?php

 require_once 'footer.html';

 ?>