<?php 
include('functions/userfunctions.php');
include('includes/header.php'); 
include('authenticate.php');
?> <!-- Calling the header.php code here -->
    
<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tracking No.</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                <tr>
                            </thead>
                            <tbody>
                                <?php
                                $orders = getOrders();

                                if(mysqli_num_rows($orders) > 0){
                                    
                                    foreach ($orders as $item) {
                                        ?>
                                            <tr>
                                                <td>&nbsp<?= $item['id']; ?></td>
                                                <td>&nbsp<?= $item['tracking_id']; ?></td>
                                                <td>&nbsp<?= $item['total_price']; ?></td>
                                                <td>&nbsp<?= $item['created_at']; ?></td>
                                                <td>
                                                    <a href="view-order.php?t=<?= $item['tracking_id']; ?>" class="btn btn-primary center">View Details</a>
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
<style>
th{
    min-width: 180px;
  }
</style>
