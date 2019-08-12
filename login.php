<?php

session_start();

//echo $_SESSION['message'];
//unset($_SESSION['message']);
require_once 'classes/Config.php';
$login =new Config;
$err_msg="";
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $info=$login->login($email,$password);
    if(!empty($info)){
        $_SESSION['id']=$info['user_id'];
        $_SESSION['email']=$info['user_email'];
        $_SESSION['permission']=$info['user_permission'];
        $_SESSION['status']=$info['user_status'];

        if($_SESSION['status']=='D'){
            $err_msg= "<div class='alert alert-danger' role='alert'>
                Your account has been already deleted.
                </div>";
        }elseif($_SESSION['permission']=='A'){
            $login->redirect('admin/posts/dashboard.php');
        }elseif($_SESSION['permission']=='U'){
            $login->redirect('web/posts/display.php');
        }else{
            $err_msg="<div class='alert alert-danger' role='alert'>
                    Invalid credentials
                    </div>";
        }
    }
}

require_once 'header.php';

?>
<link rel="stylesheet" href="css/login.css">

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
                            <?php echo $err_msg ?>
                        </div>
                </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-block btn-primary" name="login">Log in</button>
                        <p class="mt-2">or</p>
                        <a href="signup.php" class="btn btn-warning px-4">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>

    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>