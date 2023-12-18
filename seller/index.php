<?php 

include('includes/header.php'); 
include('../middleware/sellerMiddleware.php');

?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <!--Dashboard content-->
            <div class="row mt-5">
                <!--ADD CATEGORY -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute pb-4">
                                <i class="bi bi-card-list opacity-10"></i>
                            </div>
                            <div class="text-end pt-1">
                                <h4 class="mb-0 mt-2"><a href="add-category.php" class="btn btn-sm btn-dark shadow">Add+</a></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-2"><span class="text-dark shadow text-sm font-weight-bolder">ADD CATEGORY</span></p>
                            <text-area> Add categories for shop</text-area>
                        </div>
                    </div>
                </div>
                <!-- ADD PRODUCT -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute pb-4">
                                <i class="bi bi-box-seam opacity-10"></i>
                            </div>
                            <div class="text-end pt-1">
                                <h4 class="mb-0 mt-2"><a href="add-product.php" class="btn btn-sm btn-dark shadow">Add+</a></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-2"><span class="text-dark shadow text-sm font-weight-bolder">ADD PRODUCT</span></p>
                            <text-area> Add products for each category</text-area>
                        </div>
                    </div>
                </div>
                <!-- ORDER HISTORY -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute pb-4">
                                <i class="bi bi-journal-check opacity-10"></i>
                            </div>
                            <div class="text-end pt-1">
                                <h4 class="mb-0 mt-2"><a href="order-history.php" class="btn btn-sm btn-dark shadow">View</a></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-2"><span class="text-dark shadow text-sm font-weight-bolder">ORDER HISTORY</span></p>
                            <text-area> View order histories</text-area>
                        </div>
                    </div>
                </div>

                <!--end of dashboard content-->
            </div>
        </div>
    </div>
</div>
<style>
.card {
    height: 250px; /* Change the height to your desired value */
}
</style>

<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->
