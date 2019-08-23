<?php
require_once 'header.php';

$duplicate_msg=null;
$category_no=$_GET['id'];
$category_info=$category->get_category_info($category_no);


?>


<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header bg-warning">
                <h3>Edit category</h3>
            </div>
            <form action="action.php?action=EDIT&id=<?php echo $category_info['category_no']?> " method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="update_category">Category name</label>
                        <input type="text" value="<?php if(empty($duplicate_msg)){echo $category_info['category_name'];}else{echo $_POST['update_category'];}?>" name="update_category" class="form-control <?php if(!empty($duplicate_msg)):?> is-invalid<?php endif ?>">
                        <?php echo $duplicate_msg ?>
                    </div>    
                </div>
                <div class="card-footer">
                    <a href="list.php" class="btn btn-secondary">Back to list</a>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>

<?php

include_once 'footer.php';

?>