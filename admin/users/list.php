<?php
require_once 'header.php';


?>

<div class="container-fluid">

    <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">USERS</h1>

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h4>Total users: 
                    <?php 
                        echo $count_users['total_users'];
                    ?>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>User name</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Country</th>
                            <th>Birthday</th>
                            <th>E-mail</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <?php
                        if($get_profile == TRUE){
                            foreach($get_profile as $key=>$row){
                        ?>

                        <tr>
                            <td><?php echo $row['user_id'];?></td>
                            <td><?php if(!empty($row['profile_avatar'])):?><img src="<?php echo $row['profile_avatar'];?>" alt="<?php echo $row['firstname']?>" width="100"><?php endif ?></td>
                            <td><?php echo $row['user_name'];?></td>
                            <td><?php echo $row['profile_firstname'];?></td>
                            <td><?php echo $row['profile_lastname'];?></td>
                            <td><?php echo $row['country_name'];?></td>
                            <td><?php echo $row['profile_birthday'];?></td>
                            <td><?php echo $row['user_email'];?></td>
                            <td>
                                <a href="detail.php?id=<?php echo $row['profile_no']?>" class='btn btn-outline-secondary'>
                                <i class='fa fa-angle-double-right'></i> Detail
                                </a>
                            </td>
                        </tr>

                        <?php
                            }
                        }else{
                            echo "<td colspan='7' class='text-center'>Nothing to display</td>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
<!-- /.container-fluid -->

</div>

<?php

include_once 'footer.php';

?>