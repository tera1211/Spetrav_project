<?php
require_once 'header.php';
$place_id=$_GET['id'];

$get_one_place=$place->display_one_place($place_id);

if(isset($_POST['delete'])){
    $result=$place->delete_place($place_id);
    if(result==TRUE){
        $place->redirect('list.php');
    }else{
        echo "<div class='alert alert-danger'> Delete failed </div>";
    }
}
?>

<div class="container-fluid">

    <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Delete place</h1>

    <!-- DataTales Example -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="lead">Place</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="bg-warning text-white lead"><?php echo $get_one_place['place_name'];?></td>
                        <td><?php echo $get_one_place['country_name'];?></td>
                        <td><?php echo $get_one_place['state_name'];?></td>
                        <td><?php echo $get_one_place['city_name'];?></td>
                    </tr>
                    </tbody>
                </table>
                <h4>Are you sure to delete this place?</h4>
            </div>
            <form action="" method="post">
                <div class="card-footer">
                    <a href="list.php" class="btn btn-secondary">Back to place list</a>
                    <button type="submit" class="btn btn-danger" name="delete">delete</button>
                </div>
            </form>
        </div>
</div>
<!-- /.container-fluid -->

</div>

<?php

include_once 'footer.php';

?>