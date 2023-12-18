<?php 
include('includes/header.php'); 
include('../middleware/sellerMiddleware.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="../uploads/<?=$_GET['img'];?>" class="img-fluid">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        <a href="category.php" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
