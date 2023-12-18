<?php 
include('includes/header.php'); 
include('../middleware/sellerMiddleware.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark shadow">
                    <span class="fs-4 text-white">Products</span>
                    <a href="index.php" class="btn btn-light float-end"><i class="fa fa-reply"></i> Back</a>
                </div>
                <div class="card-body" id="products_table">
                    <div class="table-responsive">
                        <div class="table-wrapper-scroll-x">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Availability</th>
                                        <th>Status</th>
                                        <th>Index</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $products = getAll("products");

                                    if(mysqli_num_rows($products) > 0)
                                    {
                                        foreach($products as $item)
                                        {
                                            ?>
                                            <tr>
                                                <td><p class="mx-3"><?= $item['id']; ?></p></td>
                                                <td><p class="mx-3"><?= $item['name']; ?></p></td>
                                                <td>
                                                    <a href="image-viewer.php?img=<?= $item['image']; ?>" target="_blank">
                                                        <img src="../uploads/<?= $item['image']; ?>" class="mx-3 product-image" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <p class="mx-3"><?= $item['qty'] >= '1' ? "Available" : "Soldout" ?> </p>
                                                </td>
                                                <td>
                                                    <p class="mx-3"><?= $item['status'] == '1' ? "Visible" : "Hidden" ?> </p>
                                                </td>
                                                <td>
                                                    <p class="mx-3"><?= $item['trending'] == '1' ? "Display" : "Hidden" ?> </p>
                                                </td>
                                                <td>
                                                    <a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-dark shadow">Edit</a>
                                                </td>
                                                    
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?=$item['id'];?>">Delete</button>
                                                    <!--
                                                    <form action="code.php" method="POST">
                                                        <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger" name="delete_product_btn">Delete</button>
                                                    </form>
                                                    -->
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr><td colspan='6'>No records found</td></tr>";
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
</div>

<?php include('includes/footer.php'); ?>
