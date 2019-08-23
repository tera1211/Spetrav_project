<?php
require_once 'header.php';

$category_no=$_GET['id'];


if(isset($_POST['deactivate'])){
    $category->deactivate_category($category_no);
}

?>


<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h3>Deactivate category</h3>
            </div>
            <div class="card-body">
                Are you sure to deactivate "<?php echo $category_info['category_name'];?>"?
            </div>
            <div class="card-footer">
                <form action="" method="post">
                    <a href="list.php" class="btn btn-secondary">Back to list</a>
                    <button type="submit" name="deactivate" class="btn btn-danger">Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>


</div>

<?php

include_once 'footer.php';

?>