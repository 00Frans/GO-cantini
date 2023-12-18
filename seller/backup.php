<?php 
include('includes/header.php'); 
include('../middleware/sellerMiddleware.php');


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
                            <span class="fs-4 text-white">View Orders</span>
                                <a href="order-history.php" class="btn btn-light float-end"><i class="fa fa-reply"></i> Back</a>
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
                                <div class="col-md-4">
                                    <h3>Details</h3>
                                    <hr class="line-table">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Tracking No.</label>
                                            <div class="border p-1">&nbsp
                                                <?= $data['tracking_id']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Reference No.</label>
                                            <div class="border p-1">&nbsp
                                                <?= $data['refno']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">ID No</label>
                                                <div class="border p-1">&nbsp
                                                    <?= $data['idno']; ?>
                                                </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Name</label>
                                                <div class="border p-1">&nbsp
                                                    <?= $data['name']; ?>
                                                </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone</label>
                                                <div class="border p-1">&nbsp
                                                    <?= $data['phone']; ?>
                                                </div>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label class="fw-bold">Email</label>
                                            <div class="border p-1">&nbsp
                                                <?= $data['email']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>Order Details</h3>
                                    <div class="table-responsive">
                                        
                                        <hr>
                                        <table class="table line-table mt-3 border-top">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Shop</th>
                                                    <th>Quantity</th>
                                                    <th>Claim Status </th>
                                                    <th>Update</th>
                                                    <th><span class="float-end">Price</span></th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-bottom">
                                                <?php
                                                    $userId = $_SESSION['auth_user']['user_id'];
                                                    $order_query = "SELECT o.id as oid, o.tracking_id, o.user_id, oi.*, oi.qty as orderqty, oi.id as id, p.* 
                                                    FROM orders o, order_items oi, products p 
                                                    WHERE oi.order_id=o.id 
                                                    AND p.id=oi.prod_id 
                                                    AND o.tracking_id='$tracking_no' 
                                                    AND oi.seller_id = $userId";

                                                    $order_query_run = mysqli_query($con, $order_query);

                                                    if(mysqli_num_rows($order_query_run) > 0){
                                                        $total_price = 0;
                                                        foreach ($order_query_run as $item) {
                                                            ?>
                                                            <tr>
                                                                <td class="align-middle">
                                                                    
                                                                    <img src="../uploads/<?= $item['image']; ?>" alt="<?= $item['name']; ?>"  width="80px" height="80px">
                                                                    
                                                                    <span class="mx-3"><?= $item['name']; ?></span>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <span class="mx-3"><?= $item['shop_name']; ?></span>
                                                                </td>
                                                                <td class="align-middle">
                                                                    
                                                                    <span class="mx-3"><?= $item['orderqty']; ?></span>
                                                                </td>

                                                                <form method="POST" action="code.php">
                                                                    <td class="align-middle">
                                                                        <!--<input type="text" placeholder="<?=$item['id'] ?>"> -->                                                                            
                                                                        <input type="hidden" name="p_code" value="<?=$item['p_code'] ?>">
                                                                        <input type="hidden" name="tracking_id" value="<?=$item['tracking_id'] ?>">
                                                                        
                                                                        
                                                                        <select name="claim_status" class="form-select custom-select" aria-label="Default select example" style="width: 100px;">
                                                                            <option value="0" <?= $item['claim'] == 0?"selected":"" ?> >Processing</option>
                                                                            <option value="1" <?= $item['claim'] == 1?"selected":"" ?> >Ready</option>
                                                                            <option value="2" <?= $item['claim'] == 2?"selected":"" ?> >Claimed</option>
                                                                        </select>
                                                                        
                                                                                                                                        
                                                                    </td>
                                                                    <td class="align-middle">
                                                                        <span class="mx-3">
                                                                            <button type="submit" name="update_status_btn">Update</button>
                                                                        </span>
                                                                    </td>
                                                                </form>

                                                                

                                                                <td class="align-middle">
                                                                    <span class="mx-4 float-end"><?= $item['price']; ?></span>
                                                                    <?php $total_price += $item['price']; ?>
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
                                        <h5>Total Price: <span class="float-end fw-bold mx-4"> <?php echo "₱ ".$total_price; ?></span></h5>                 
                                        <hr>


                                        <label class="fw-bold">Payment Method: </label>
                                        <div class="border p-1 mb-3">&nbsp
                                            <?= $data['payment_mode'] ?>
                                        </div>
                                        <form method="POST" action="code.php">                                   
                                            <label class="fw-bold">Status:  </label>
                                            <div class="p-1 mb-3">
                                                <input type="hidden" name="tracking_id" value="<?=$data['tracking_id'] ?>">
                                                <div class="border p-1 mb-3">
                                                    <td>&nbsp<?= $item['status'] == '1' ? "Completed" : ($item['status'] == '2' ? "Cancelled" : "Pending") ?></td>
                                                 </div>
                                                <!-- <select name="order_status" class="form-select">
                                                    <option value="0" <?= $data['status'] == 0?"selected":"" ?> >Pending</option>
                                                    <option value="1" <?= $data['status'] == 1?"selected":"" ?> >Completed</option>
                                                    <option value="2" <?= $data['status'] == 2?"selected":"" ?> >Cancelled</option>
                                                </select> -->
                                            </div>
                                        </form>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>


<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->
<style>
    button {
        background-color: #344767;
        border: none;
        color: white;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        border-radius: 5px;
    }
    td {
        text-align: center;
    }
    .custom-select {
        width: 200px;
        margin: 0 auto; /* Center align the select element */
    }
</style>