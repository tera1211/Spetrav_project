<?php

session_start();
if(empty($_SESSION)){
  header('Location:../logout.php');
}


require_once '../../classes/Post.php';
require_once '../../classes/User.php';
require_once '../../classes/Category.php';
require_once '../../classes/Place.php';
require_once '../../classes/Country.php';
require_once '../../classes/City.php';
require_once '../../classes/Profile.php';
require_once '../../classes/Picture.php';
$post=new Post;
$user=new User;
$category=new Category;
$place=new Place;
$country=new Country;
$city=new City;
$profile=new Profile;
$picture=new Picture;

$get_categories=$category->display_all_categories();
$get_posts=$post->display_all_posts();
$get_country=$country->display_all_countries();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SPETRAV</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700"> 
    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">


    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../css/style.css">
    
  </head>
  <body>
    
    <div class="site-wrap">
      
      <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>
      
      <header class="site-navbar py-1" role="banner">
        
      <!-- modals -->

        <!-- password-modal -->
      <div class="modal fade" id="password_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modallabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="" class="form-control m-2">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="" class="form-control m-2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-outline-warning" name="update_password" value="Change password">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /password-modal -->

    <!-- avatar edit modal -->
      <div class="modal fade" id="img-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="modallabel">Edit Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="justify-content-center">
                            <input type="file" name="profile_photo" id="" class="form-control-file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Update image" name="update_image" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /avatar edit modal -->

    <!-- avatar-delete modal -->
    <div class="modal fade" id="img-delete-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="modallabel">Delete Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        Are you sure you delete your Avatar?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="delete image" class="btn btn-danger" name="delete_image">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /avatar delete modal -->

    <!-- account delete modal -->
    <div class="modal fade" id="account-delete-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="modallabel">Delete account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body bg-warning">
                        Are you sure you delete your account?<br>
                    </div>
                    <div class="modal-footer bg-warning">
                        <input type="submit" class="btn btn-danger" name="deactivate" value="deactivate_profile">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /acount delete modal -->
  <!-- /modals -->

        <div class="container">
          <div class="row align-items-center">
            
            <div class="col-6 col-xl-2">
              <h1 class="mb-0"><a href="../posts/list.php" class="text-black h2 mb-0">SPETRAV</a></h1>
            </div>
            <div class="col-10 col-md-8 d-none d-xl-block">
              <nav class="site-navigation position-relative text-right text-lg-center" role="navigation">
                
                <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                  <li class="mx-2">
                    <a href="../posts/list.php">See post</a>
                  </li>
                  
                  <li class="mx-2"><a href="../posts/register.php">Share experience</a></li>
                </ul>
              </nav>
            </div>
            
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../logout.php">Logout</a>
                  </div>
                </div>
              </div>
            </div>
          <div class="col-6 col-xl-2 text-right">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['username']?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="users/profile.php?id=<?php echo$_SESSION['id']?>">Profile</a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
            </div>
          
          </div>

            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>
      
      
    </header>