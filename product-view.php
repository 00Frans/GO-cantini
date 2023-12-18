<?php
include('functions/userfunctions.php');
include('includes/header.php');

if (isset($_GET['product'])) {

    $product_shop = $_GET['product'];
    $product_data = getSlugActive("products", $product_shop);
    $product = mysqli_fetch_array($product_data);

    if ($product && $product['qty'] > 0) {
        $seller_id = $product['user_id'];
        ?>
        <div class="container product_data mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4 pt-3">
                    <div class="card shadow p-3 mb-5 px-3">
                        <img src="uploads/<?= $product['image']; ?>" alt="Product Image" class="w-80" height="300">
                    </div>
                </div>
                <div class="col-md-5 pt-3 px-3">
                <div class="line-table">
                    <table>
                        <tr>
                            <td>
                                <span class="h2" style="vertical-align: middle;"><?=$product['name']; ?></span>
                            </td>
                            <td>
                                <span><a href="javascript:void(0)" onclick="history.back()" class="btn btn-dark float-end"><i class="fa fa-reply"></i> Back</a></span>
                            </td>
                        </tr>
                        <tr class="tr-with-gap"></tr>
                    </table>
                </div>

                    <div class="row mt-4 mb-1">
                        <div class="col-md-12">
                            <h4 class="fw-bold">Price: <small class="text-muted" style="text-align:center;"><s>₱ <?= $product['original_price']; ?>.00</s></small> <span class="text-danger"> ₱<?= $product['selling_price']; ?>.00 </span></h4>
                        </div>
                    </div>
                    <hr class="line-table">
                    <span class="fw-bold h5 ">Shop:</span><span class="h5"> <?= $product['shop_name']; ?></span>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <span class="fw-bold h5">Quantity:</span><span class="h5"> <?= $product['qty']; ?></span>
                        </div>
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col-md-12">
                            <span class="fw-bold h5">Small Description:</span> <span> <?= $product['small_description']; ?></span>
                        </div>
                    </div>
                    <div class="row mt-5 mb-4">
                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width:120px;">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" class="form-control text-center input-qty bg-white" value="1">
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-dark w-100 addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2"> Add to Cart</i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <hr>
                    <h5>Product Description</h5>
                    <p><?= $product['description']; ?></p>
                </div>
            </div>
        </div>        
            <?php
    } else {
        ?>
        <div class="card card-body shadow text-center">
            <h4 class="py-3 alert-danger">Sold out, please choose another product</h4>
        </div>

        <script>
            setTimeout(function() {
                window.location.href = "categories.php";
            }, 2000);
        </script>

    <?php

    }

} else {
    echo "Something went wrong";
}
include('includes/footer.php');
?>
<style>
    div.line-table {
    display:flex;
    justify-content: flex-end;
    }
    div.line-table table{
    border-bottom: 2px solid #000000;
    width: 100%;
    max-width: 100%;
    }
    .tr-with-gap::before {
    content: "";
    display: block;
    height: 10px; 
    }
    hr.line-table{
    border-bottom: 2px solid #000000;
    width: 100%;
    max-width: 100%;
    }


    
</style>
