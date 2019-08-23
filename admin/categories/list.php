<?php
require_once 'header.php';


?>

<!--add Category Modal -->
<div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <!-- <form action="" method="post"> -->
                <div class="modal-body">
                    <div class="form-group inline-form">
                        <label for="category">category name</label>
                        <input type="text" name="category" id="category" class="form-control" required>
                        <span id="error" class ="invalid-feedback">Category already exists</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add-category" name="add">Add</button>
                </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<div class="container-fluid">

    <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">CATEGORIES</h1>

    <!-- DataTales Example -->
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h4>Total categories: 
                    <?php 
                        echo $count_categories['total_categories'];
                    ?>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <th>Category name</th>
                            <th>Date</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <?php
                        if($get_categories == TRUE){
                            foreach($get_categories as $key=>$row){
                        ?>

                        <tr>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['category_created'];?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['category_no']?>" class='btn btn-warning mx-2'>
                                <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="deactivate.php?id=<?php echo $row['category_no']?>" class='btn btn-danger mx-2'>
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
                    <button  data-toggle="modal" data-target="#add_category" class="btn btn-primary"><i class="fas fa-plus"></i>Add category</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>

<?php

include_once 'footer.php';

?>