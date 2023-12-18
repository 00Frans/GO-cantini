<?php 
include('includes/header.php'); 
include('../middleware/adminMiddleware.php');


if(isset($_GET['t'])){
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no);
    if(mysqli_num_rows($orderData) < 0){
        ?>
            <h4>Something went wrong <h4>
        <?php
        die();
    }
}else{
    ?> 
        <h4>Something went wrong <h4>
    <?php
    die();
}

$data = mysqli_fetch_array($orderData);
?> <!-- Calling the header.php code here -->












<div class="py-5">
    <div class="container">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark shadow">
                            <span class="fs-4 text-white">View Order</span>
                                <a href="javascript:void(0)" onclick="history.back()" class="btn btn-light float-end"><i class="fa fa-reply"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-12">                    
                            <?php 
                                // Check if the message query parameter exists
                                if(isset($_GET['message'])) {
                                    $message = $_GET['message'];
                                    echo "<div class='alert alert-success text-white'>$message</div>";
                                    unset($_SESSION['success_message']);
                                    echo "<script>
                                    setTimeout(function(){
                                        $('.alert-success').fadeOut();
                                    }, 3000);
                                    </script>";
                                }
                                // Check if there were any errors
                                if(isset($_GET['error'])) {
                                    $error = $_GET['error'];
                                    echo "<div class='alert alert-danger text-white'>$error</div>";
                                    echo "<script>
                                    setTimeout(function(){
                                        $('.alert-danger').fadeOut();
                                    }, 3000);
                                    </script>";
                                }
                                ?>
                                </div> 
                                
                                <div class="col-md-5">
                                    <h4>Buyer Details</h4>
                                    <hr class="line-table">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Tracking No.</label>
                                            <div class="border p-2 border border-dark">
                                                <?= $data['tracking_id']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Reference No.</label>
                                            <div class="border p-2 border border-dark">
                                                <?= $data['refno']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Name</label>
                                                <div class="border p-2 border border-dark">
                                                    <?= $data['name']; ?>
                                                </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Email</label>
                                                <div class="border p-2 border border-dark">
                                                    <?= $data['email']; ?>
                                                </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone</label>
                                                <div class="border p-2 border border-dark">
                                                    <?= $data['phone']; ?>
                                                </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Attachment</label>
                                            <div class="border p-2 border border-dark">
                                                <a style="text-decoration:none; color:black;" href="../uploads/receipt/<?= $data['receipt']; ?>" download="<?= $data['receipt']; ?>">
                                                    <span class="bi bi-cloud-download"></span> Proof of Payment
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-7">
                                <h4>Order Details</h4>
                                    <div class="table-responsive">
                                    <hr>
                                        <table class="table line-table mt-3 border-top">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Shop</th>
                                                    <th>Status</th>
                                                    <th>Quantity</th>
                                                    <th><span class="float-end">Price</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                </tr>

                                                    <?php
                                                        $order_query = "SELECT o.id as oid, o.tracking_id, o.user_id, oi.*, oi.qty as orderqty, oi.id as id, p.* 
                                                        FROM orders o, order_items oi, products p 
                                                        WHERE oi.order_id=o.id 
                                                        AND p.id=oi.prod_id 
                                                        AND o.tracking_id='$tracking_no'";

                                                        $order_query_run = mysqli_query($con, $order_query);

                                                        if(mysqli_num_rows($order_query_run) > 0){
                                                            foreach ($order_query_run as $item) {
                                                                ?>
                                                                    <tr>
                                                                        <td class="align-middle">
                                                                            <img src="../uploads/<?= $item['image']; ?>" alt="<?= $item['name']; ?>"  width="70px" height="70px">
                                                                            <span class="mx-1"><?= $item['name']; ?></span>
                                                                        </td>
                                                                        <td class="align-middle">
                                                                            <span class="mx-3"><?= $item['shop_name']; ?></span>
                                                                        </td>
                                                                        <td class="align-middle">
                                                                        <span class="<?= $item['claim'] == '0' ? "text-danger" : ($item['claim'] == '1' ? "text-primary" : "text-success") ?>">
                                                                            <?= $item['claim'] == '0' ? "Processing" : ($item['claim'] == '1' ? "Ready to claim" : "Claimed") ?>
                                                                        </span>
                                                                        </td>
                                                                        <td class="align-middle">
                                                                            <span class="mx-3"><?= $item['orderqty']; ?></span>
                                                                        </td>

                                                                        <td class="align-middle">
                                                                            <span class="mx-4 float-end"><?= $item['price']; ?></span>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                            </tbody>
                                        </table>
                                
                                </div>
                                <hr>
                                        <h5>Total Price: <span class="float-end fw-bold mx-4"> <?= $data['total_price']; ?></span></h5>                 
                                        <hr>
                                        <label class="fw-bold">Payment Method: </label>
                                        <div class="border p-2 border border-dark mb-3">
                                            <?= $data['payment_mode'] ?>
                                        </div>
                                        <form method="POST" action="code.php">                                   
                                            <label class="fw-bold">Status:  </label>
                                            <div class="p-1 mb-3">
                                                <input type="hidden" name="tracking_id" value="<?=$data['tracking_id'] ?>">
                                                <select name="order_status" class="form-select">
                                                    <option value="0" <?= $data['status'] == 0?"selected":"" ?> >Pending</option>
                                                    <option value="1" <?= $data['status'] == 1?"selected":"" ?> >Paid</option>
                                                    <option value="2" <?= $data['status'] == 2?"selected":"" ?> >Completed</option>
                                                </select>
                                            </div>
                                            <button type="submit" name="update_order_btn" class="btn btn-dark shadow float-end">Update Order Details</button>
                                        </form>


                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>


<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->
