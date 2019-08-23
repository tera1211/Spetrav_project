<?php

require_once 'header.php';

$picture_id=$_GET['id'];
$display_single_picture=$picture->get_picture_by_id($picture_id);
$post_no=$display_single_picture['post_no'];

if(isset($_POST['update_picture'])){
    $photo_filename=$_FILES['picture']['name'];
    $photo_tmpname=$_FILES['picture']['tmp_name'];
    $directory="images/";

    $result=$picture->update_picture($photo_filename,$photo_tmpname,$directory,$picture_id);
    if($result==TRUE){
        $picture->redirect("detail.php?id=$post_no");
    }
}

if(isset($_POST['delete_picture'])){
    $picture->delete_picture($picture_id,$post_no);
}

?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Update picture</h1>
    <div class="container">
        <div class="card">
            <form action="" method="POST" enctype="multipart/form-data">     
                <div class="card-body">
                    <img src="<?php echo '../../'.$display_single_picture['picture_name'] ?>" alt="" style="width:100%">
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <label for="picture">Picture</label>
                        <input type="file" name="picture" id="" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-warning" name="update_picture">Update</button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#picture-delete">
                      Delete
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="picture-delete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">picture delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        Are you sure to delete the picture?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" name="delete_picture">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                        
            </form>
        </div>
    </div>
</div>

</div>
<?php

require_once 'footer.php';