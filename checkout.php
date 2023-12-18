<?php 
include('functions/userfunctions.php');
include('includes/header.php');
?>
<!-- Calling the header.php code here -->
<?php
$user = getUsers("users");
if(mysqli_num_rows($user) > 0){ 
    foreach($user as $users)
?>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow box-table">
            <form action="functions/placeorder.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="card-header bg-white mb-3 line-bottom">
                            <span class="fs-4 fw-bold">CHECKOUT</span>
                            <a href="cart.php" class="btn btn-dark float-end mb-2"><i class="fa fa-reply"></i> Back</a>
                    </div>
                    <div class="col-md-6">
                        <h3>Basic Details</h3>
                        <hr class="line-table">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold mb-1">ID No</label>
                                <input type="text" name="id_number" value="<?= $users['id_number']; ?>" class="form-control" style="border: 1px solid black;">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold mb-1">Name</label>
                                <input type="text" name="name" value="<?= $users['name']; ?>" class="form-control" style="border: 1px solid black;">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold mb-1">Phone</label>
                                <input type="text" name="phone" value="<?= $users['phone']; ?>" class="form-control" style="border: 1px solid black;">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold mb-1">Email</label>
                                <input type="text" name="email" value="<?= $users['email']; ?>" class="form-control" style="border: 1px solid black;">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold mb-1">Reference No. (GCASH)</label>
                                <input type="number" name="refno" value="" placeholder="Reference No." class="form-control" style="border: 1px solid black;">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold mb-1">Receipt</label>
                                <input type="file" name="image" value="" class="form-control" style="border: 1px solid black;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="table-responsive">
                    <span class="h3" style="vertical-align: middle;">Product Details</span>
                        <table class="table line-table mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Shop</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col"><span class="float-end">Price</span></th>
                                </tr>
                            </thead>
                            <tbody class="line-table">
                                <?php
                                $cart_items = getCartItems();
                                $totalPrice = 0;
                                foreach ($cart_items as $citems) {
                                ?>
                                <tr>
                                    <td style="vertical-align: middle;"><img src="uploads/<?= $citems['image']; ?>" alt="Image" width="80" height="80"></td>
                                    <td style="vertical-align: middle;"><?= $citems['name']; ?></td>
                                    <td style="vertical-align: middle;"><?= $citems['shop_name']; ?></td>
                                    <td style="vertical-align: middle; text-align: center;"><?= $citems['prod_qty']; ?></td>

                                    <td style="vertical-align: middle;"><?= $citems['selling_price']; ?></td>
                                </tr>

                                <?php
                                    $totalPrice += $citems['selling_price'] * $citems['prod_qty'];
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                        <div class="total-price">
                            <table>
                                <tr class="fw-bold">
                                    <td>Total Price: </td>
                                    <td>₱ <?= $totalPrice; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="mb-2 float-end mt-4">
                            <a style="text-decoration:none; color:black;" href="image-viewer-checkout.php">
                                <span class="fas fa-qrcode mr-2"></span>
                                <span>Scan w/ GCash</span>
                            </a>
                        </div>
                        <div>
                            <input type="hidden" name="payment_mode" value="Gcash">
                            <button name="placeOrderBtn" class="btn btn-dark w-100">Checkout</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<?php
    }
?>

<?php include('includes/footer.php'); ?>
<!-- Calling the footer.php code here -->
<style>
    div.total-price {
        display: flex;
        justify-content: flex-end;
    }

    .total-price table {
        border-top: 3px solid #000000;
        width: 100%;
        max-width: 200px;
    }

    td:last-child {
        text-align: right;
    }

    th:last-childe {
        text-align: right;
    }

    .line-table {
        border-top: 1px solid #000000;
        border-bottom: 1px solid #000000;
        width: 100%;
        max-width: 100%;
    }
    .line-bottom {
        border-bottom: 1px solid #000000;
        width: 100%;
        max-width: 100%;
    }

    .align-middle {
        vertical-align: middle;
    }

    .box-table {
        border: 2px solid #ffffff;
        border-radius: 20px;
        width: 100%;
        max-width: 100%;
    }

    /* Responsive Styles */
    div.table-responsive {
        overflow-x: auto;
        max-width: 100%;
    }

    table.line-table {
        width: 100%;
    }

    
</style>
