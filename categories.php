<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <div class="row">
                        <h1>Categories</h1>
                        <hr>
                        <?php
                            $categories = getAllActive("categories");

                            if (mysqli_num_rows($categories) > 0) {
                                $shops = []; // Array to store unique shop names
                                foreach ($categories as $item) {
                                    $shops[$item['shop_name']][] = $item; // Group categories by shop name
                                }
                                ?>

                                    <div style="overflow-x: auto;">
                                    <div class="d-flex flex-wrap align-items-center mb-2">
                                        <p class="btn btn-dark shop-button mx-2 mb-2">All shops</p>
                                        <?php foreach ($shops as $shopName => $shopCategories): ?>
                                            <!-- Create a btn shop_name from the database -->
                                            <a href="#<?= sanitizeAnchor($shopName) ?>" class="btn btn-danger shop-button mx-2 mb-2"><?= $shopName ?></a>
                                        <?php endforeach; ?>
                                    </div>

                                    </div>


                                    
                                <hr>
                                <?php foreach ($shops as $shopName => $shopCategories): ?>
                                    <!-- target certain shop -->
                                    <h2 class="mx-2" id="<?= sanitizeAnchor($shopName) ?>"><?= $shopName ?></h2>
                                    <div class="row mb-2">
                                        <?php foreach ($shopCategories as $category): ?>
                                            <div class="col-md-4 mb-2">
                                                <a style="text-decoration:none; color:black;" href="products.php?category=<?= rawurlencode($category['slug']); ?>&symbol=<?= rawurlencode('+'); ?>">
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <img src="uploads/<?= $category['image']; ?>" alt="Image" class="w-100" height="225">
                                                            <h4 class="text-center mt-4"><?= $category['name']; ?></h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>

                        <?php
                            } else {
                                echo "No Categories Available";
                            }
                        ?>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
<style>
    .btn.btn-warning.shop-button {
        background-color: orange;
        color: white;
    }
</style>