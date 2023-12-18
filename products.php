<?php
include('functions/userfunctions.php');
include('includes/header.php');

if(isset($_GET['category'])){
$category_slug = $_GET['category'];
$category_data = getSlugActive("categories",$category_slug);
$category = mysqli_fetch_array($category_data);
if($category){
$cid = $category['id'];
?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <div class="row">
                        <h1>Categories | <?= $category['name'] ?> <span><a href="javascript:void(0)" onclick="history.back()" class="btn btn-dark float-end"><i class="fa fa-reply"></i> Back</a></span></h1>
                        <hr>
                            <?php
                                $products = getProdByCategory($cid);

                                if(mysqli_num_rows($products) > 0){
                                    foreach($products as $item)
                                    {
                                        ?>
                                            <div class="col-md-4 mb-2">
                                                <a style="text-decoration:none; color:black;" href="product-view.php?product=<?= rawurlencode($item['slug']); ?>&symbol=<?= rawurlencode('+'); ?>" style="text-decoration:none;">
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100" height="225">
                                                            <h4 class="text-center mt-4"><?= $item['name']; ?></h4>

                                                        </div>

                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                    }
                                }
                                else{
                                    echo "No Categories Available";
                                }
                            ?>
                    </div>
            </div>
        </div>
    </div>
</div>

    <?php
            }
            else{
                echo "Something went wrong";
            }
        }
        else{
            echo "Something went wrong";
        }
    include('includes/footer.php'); ?>