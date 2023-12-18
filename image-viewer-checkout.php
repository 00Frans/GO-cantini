<?php 
include('functions/userfunctions.php');
include('includes/header.php'); ?> <!-- Calling the header.php code here -->


<div class="container mt-5">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card">
            <div class="card-header bg-white mb-3 line-bottom">
                            <span class="fs-4 fw-bold">RECEIPT</span>
                            <a href="checkout.php" class="btn btn-dark float-end mb-2"><i class="fa fa-reply"></i> Back</a>
                    </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="./uploads/receipt/qrcode.jpg" width="50%" height="50%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
