<?php
require_once 'header.php';


?>

<div class="container-fluid">

    <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">USERS</h1>

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h4 class="float-left">Total places: 
                    <?php 
                        echo $count_places['total_places'];
                    ?>
                </h4>
                <!-- Button trigger modal -->
                <a href="register.php" class="btn btn-primary float-right">
                  <i class="fas fa-plus"></i>Add place
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Place</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($get_places == TRUE){
                            foreach($get_places as $key=>$row){
                        ?>

                        <tr>
                            <td><?php echo $row['place_name'];?></td>
                            <td><?php echo $row['country_name'];?></td>
                            <td><?php echo $row['state_name'];?></td>
                            <td><?php echo $row['city_name'];?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['place_id']?>" class='btn btn-warning'>
                                <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="delete.php?id=<?php echo $row['place_id']?>" class='btn btn-danger'>
                                <i class="fas fa-trash-alt"></i> Delete
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