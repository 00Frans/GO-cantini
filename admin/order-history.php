<?php 
include('includes/header.php'); 
include('../middleware/adminMiddleware.php');

?> <!-- Calling the header.php code here -->
    
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark shadow">
                <span class="fs-4 text-white">PAID ORDERS</span>
                    <a href="orders.php" class="btn btn-light float-end"><i class="fa fa-reply"></i> Back</a>
                </div>
                <div class="card-body" id="category_table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tracking ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                <tr>
                            </thead>
                            <tbody>
                                <?php
                                $orders = getOrderHistory();

                                if(mysqli_num_rows($orders) > 0){
                                    
                                    foreach ($orders as $item) {
                                        ?>
                                            <tr>
                                                <td>&nbsp<?= $item['tracking_id']; ?></td>
                                                <td>&nbsp<?= $item['name']; ?></td>
                                                <td>&nbsp<?= $item['total_price']; ?></td>
                                                <td>&nbsp<?= $item['created_at']; ?></td>
                                                <td>&nbsp&nbsp<?= $item['status'] == '1' ? "Paid" : ($item['status'] == '2' ? "Completed" : "Pending") ?></td>

                                                <td>
                                                    <a href="view-order.php?t=<?= $item['tracking_id']; ?>" class="btn btn-dark shadow center">View Details</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                        <tr>
                                            <td colspan="5">No orders yet</td>
                                        </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->
