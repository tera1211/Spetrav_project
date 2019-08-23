<?php

require_once 'header.php';


?>

<style>
main{
    background: url(../../images/lake.jpg);
    background-position: center;
    background-attachment:fixed;
    background-size:cover;
    padding:30px 0;
}

.card{
    background:rgba(85, 40, 1, 0.7);
    color:white;
}

</style>
<main>
    <div class="container">
    <a href="register.php" class="btn btn-info btn-lg mb-4">add post</a>
        <div class="card">
            <div class="card-header">
                <h5>Choose which post to display</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="country">Country</label>
                        <select class="form-control" name="country" id="country">
                            <option>Choose or type the country</option>
                            <?php foreach($get_country as $key=>$values):?>
                            <option value="<?php echo $values['id'];?>"><?php echo $values['country_name']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-6" id="state-select">
                        <label for="state">State</label>
                        <select name="state" id="state" class="form-control">
                            <option>choose or type the state</option>
                        </select>
                    </div>
                    <div class="form-group col-6" id="city-select">
                        <label for="city">City</label>
                        <select name="city" class="form-control" id="city">
                            <option>Choose or type the city</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="category">Category</label>
                        <select name="category" class="form-control" id="category" onchange="categorySelect()">
                            <option value="">Choose the category</option>
                            <?php foreach($get_categories as $key=>$values):?>
                            <option value="<?php echo $values['category_no']?>"><?php echo $values['category_name']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
       

    <div class="container" id="post-list">
    <?php foreach($get_posts as $key=>$values):?>
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

                <div class="row">
                <?php 
                $post_no=$values['post_no'];
                $get_pictures=$picture->display_post_pictures($post_no);
                if($get_pictures==TRUE){
                    foreach($get_pictures as $keys=>$rows){
                ?>
                <div class="col-3">
                    <img src="../../<?php echo $rows['picture_name']?>" class="img-fluid m-3" alt="" width="">
                </div>
                <?php
                    }
                }
                ?>
                </div>
            </div>
            
        </div>
        <?php endforeach ?>
    
    </div>
</main>
<?php

require_once 'footer.php';

?>