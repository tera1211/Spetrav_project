<?php
require_once 'header.php';

$profile_no=$_GET['id'];
$profile_info=$profile->get_profile_info($profile_no);

?>

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Profile detail</h4>
        </div>
        <div class="card-body">
        <?php if(!empty($profile_info['profile_avatar'])):?>
            <div class="row">
                <div class="col-8">
                    <?php endif ?>
                <table class="table table-striped">
                    <tr>
                        <th>User name</th>
                        <td><?php echo $profile_info['user_name']?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $profile_info['profile_firstname']." ".$profile_info['profile_lastname']?></td>
                    </tr>
                    <tr>
                        <th>Birthday</th>
                        <td><?php echo $profile_info['profile_birthday']?></td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td><?php echo $profile_info['country_name']?></td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td><?php echo $profile_info['user_email']?></td>
                    </tr>
                    <tr>
                        <th>Self introduction</th>
                        <td><?php echo $profile_info['profile_self_introduction']?></td>
                    </tr>
                </table>
                <?php if(!empty($profile_info['profile_avatar'])):?>
                </div>
                <div class="col-4">
                    <img src="<?php echo $profile_info['profile_avatar'] ?>" alt="" width="100%">
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>

<?php

include_once 'footer.php';

?>