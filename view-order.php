<?php 
include('functions/userfunctions.php');
include('includes/header.php'); 
include('authenticate.php');

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
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">         
                    <div class="card">
                        <div class="card-header">
                            <span class="fs-4">View Order</span>
                            <a href="my-orders.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Details</h4>
                                    <hr class="border border-dark">
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
                                            <label class="fw-bold">ID No</label>
                                            <div class="border p-2 border border-dark">
                                                <?= $data['idno']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Name</label>
                                            <div class="border p-2 border border-dark">
                                                <?= $data['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone</label>
                                            <div class="border p-2 border border-dark">
                                                <?= $data['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Email</label>
                                            <div class="border p-2 border border-dark">
                                                <?= $data['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Attachment</label>
                                            <div class="border p-2 border border-dark">
                                                <a style="text-decoration:none; color:black;" href="./uploads/receipt/<?= $data['receipt']; ?>" download="<?= $data['receipt']; ?>">
                                                    <span class="bi bi-cloud-download"></span> Proof of Payment
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr class="border border-dark">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Name</th>
                                                    <th>Shop</th>
                                                    <th>Quantity</th>
                                                    <th>Claim Status</th>
                                                    <th><span class="float-end">Price</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $userId = $_SESSION['auth_user']['user_id'];

                                                $order_query = "SELECT o.id as oid, o.tracking_id, o.user_id, oi.*, oi.qty as orderqty, p.* 
                                                                FROM orders o, order_items oi, products p 
                                                                WHERE o.user_id='$userId' 
                                                                AND oi.order_id=o.id 
                                                                AND p.id=oi.prod_id 
                                                                AND o.tracking_id='$tracking_no' ";
                                                $order_query_run = mysqli_query($con, $order_query);

                                                if(mysqli_num_rows($order_query_run) > 0){
                                                    foreach ($order_query_run as $item) {
                                                        ?>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <img src="uploads/<?= $item['image']; ?>" alt="<?= $item['name']; ?>"  width="70px" height="70px">
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class="mx-1"><?= $item['name']; ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class="mx-1"><?= $item['shop_name']; ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class=""><?= $item['orderqty']; ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class="<?= $item['claim'] == '0' ? "text-danger" : ($item['claim'] == '1' ? "text-primary" : "text-success") ?>">
                                                                    <?= $item['claim'] == '0' ? "Processing" : ($item['claim'] == '1' ? "Ready to claim" : "Claimed") ?>
                                                                </span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class="float-end"><?= $item['price']; ?></span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr class="border border-dark">
                                    <h5>Total Price: <span class="float-end fw-bold mx-2"> <?= $data['total_price']; ?></span></h5>
                                    <hr class="border border-dark">
                                    <label class="fw-bold">Payment Method: </label>
                                    <div class="border p-2 mb-3 border border-dark">
                                        <?= $data['payment_mode'] ?>
                                    </div>
                                    <label class="fw-bold">Status:  </label>
                                    <div class="border p-2 mb-3 border border-dark">
                                        <?php
                                        if($data['status'] == 0){
                                            echo "Pending";
                                        }
                                        else if($data['status'] == 1){
                                            echo "Completed";
                                        }
                                        else if($data['status'] == 2)
                                            echo "Cancelled";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->
