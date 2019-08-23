<?php

include_once 'header.php';

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-9">
        <h1 class="h3 mb-2 text-gray-800">POSTS</h1>

    <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4>Total posts: 
                        <?php 
                            echo $count_posts['total_posts'];
                        ?>
                        <a href="register.php" class="btn btn-success float-right"><i class="fas fa-plus"></i>Add post</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <th>Posted by</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Place</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th></th>
                            </thead>
                            <tbody>
                            <?php
                            if($get_posts == TRUE){
                                foreach($get_posts as $key=>$row){
                            ?>

                            <tr>
                                <td><?php echo $row['user_name'] ?></td>
                                <td><?php echo $row['country_name'];?></td>
                                <td><?php echo $row['city_name'];?></td>
                                <td><?php echo $row['place_name'];?></td>
                                <td><?php echo $row['category_name'];?></td>
                                <td><?php echo $row['posted_datetime'];?></td>
                                <td><?php echo $row['post_title'];?></td>
                                <td>
                                    <a href="detail.php?id=<?php echo $row['post_no']?>" class='btn btn-outline-secondary'>
                                    <i class='fa fa-angle-double-right'></i> Details
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

        <!-- cards -->
        <div class="col-3">

            <!-- user card-->
            <div class="card text-center bg-warning py-4 mb-2">
                <div class="card-block">
                    <h3 class="text-white">Users</h3>
                    <h1 class="display-4 text-white">
                        <i class="fa fa-users"></i> <?php echo $count_users['total_users'];?>
                    </h1>
                    <a href="../users/list.php" class="btn btn-sm btn-outline-secondary text-white">View</a>
                </div>
            </div>
            <!-- /user card-->

            <!-- category card-->
            <div class="card text-center bg-success py-4 mb-2">
                <div class="card-block">
                    <h3 class="text-white">Categories</h3>
                    <h1 class="display-4 text-white">
                        <i class="fas fa-folder-open"></i> <?php echo $count_categories['total_categories'];?>
                    </h1>
                    <a href="../categories/list.php" class="btn btn-sm btn-outline-secondary text-white">View</a>
                </div>
            </div>
            <!-- /category card-->

            <!-- place card-->
            <div class="card text-center bg-primary py-4 mb-2">
                <div class="card-block">
                    <h3 class="text-white">Places</h3>
                    <h1 class="display-4 text-white">
                    <i class="fas fa-map-marked-alt"></i> <?php echo $count_places['total_places'];?>
                    </h1>
                    <a href="../places/list.php" class="btn btn-sm btn-outline-secondary text-white">View</a>
                </div>
            </div>
            <!-- /place card-->
        </div>
        <!--/cards-->
    </div>
</div>
<!-- /.container-fluid -->

</div>

<?php

include_once 'footer.php';

?>