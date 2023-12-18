<?php 
include('includes/header.php'); 
include('../middleware/sellerMiddleware.php');
?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $product = getByID("products",$id);
                    if(mysqli_num_rows($product) > 0){

                        $data = mysqli_fetch_array($product);
                        ?>
                            <div class="card">
                        <div class="card-header">
                        <h4>Edit Product
                            <a href="products.php" class="btn btn-primary float-end">Back</a>
                        </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-md-12">
                                <label for="">Select Category</label>
                                <select name="category_id" class="form-select mb-2"> 
                                <option class="mx-2" selected>Select Category</option>
                                        <?php
                                            $categories = getAll("categories");
        
                                            if(mysqli_num_rows($categories) > 0){
                                                foreach($categories as $item){
                                                    ?>
                                                        <option value="<?= $item['id'];?>" <?= $data['category_id'] == $item['id']?'selected':'' ?> > <?= $item['name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            else{
                                                echo "No category available";
                                            }
                                        ?>
                                </select>
                            </div>
                            <input type="hidden" name="product_id" value="<?= $data['id'];?>">
                                <div class="col-md-4">
                                <label class="mb-0">Name</label>
                                <input type="text" name="name" value="<?= $data['name'];?>" placeholder="Enter Category Name" class="form-control mb-2">
                                </div>
                                <div class="col-md-4">
                                <label class="mb-0">Shop Name</label>
                                <input type="text" name="shop_name" value="<?= $data['shop_name'];?>" placeholder="Enter Shop Name" class="form-control mb-2">
                                </div>
                                <div class="col-md-4">
                                <label class="mb-0">Slug</label>
                                <input type="text" name="slug" value="<?= $data['slug'];?>" placeholder="Enter Slug" class="form-control mb-2">
                                </div>
                                <div class="col-md-12">
                                <label class="mb-0">Small Description</label>
                                <textarea rows="3" name="small_description" placeholder="Enter small description" class="form-control mb-2"><?= $data['small_description'];?></textarea>
                                </div>
                                <div class="col-md-12">
                                <label class="mb-0">Description</label>
                                <textarea rows="3" name="description" placeholder="Enter description" class="form-control mb-2"><?= $data['description'];?></textarea>
                                </div>
                                <div class="col-md-6">
                                <label class="mb-0">Original Price</label>
                                <input type="number" name="original_price" value="<?= $data['original_price'];?>" placeholder="Enter Original Price" class="form-control mb-2">
                                </div>
                                <div class="col-md-6">
                                <label class="mb-0">Selling Price</label>
                                <input type="number" name="selling_price" value="<?= $data['selling_price'];?>" placeholder="Enter Selling Price" class="form-control mb-2">
                                </div>
                                <div class="col-md-12">
                                <label for=""> Upload Image </label>
                                    <input type="hidden" name="old_image" value="<?= $data['image']?>">
                                    <input type="file" name="image" class="form-control mb-2">
                                    <label for=""> Current Image </label>
                                    <img src="../uploads/<?= $data['image']?>" alt="Product Image" height="50px" width="50px">

                                </div>
                                <div class="row">
        
                                    <div class="col-md-6">
                                    <label class="mb-0">Quantity</label>
                                    <input type="number" name="qty" value="<?= $data['qty'];?>" placeholder="Enter Quantity" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-3">
                                    <label class="mb-0">Status</label> <br> &nbsp; &nbsp;
                                    <input type="checkbox" name="status"> <? $data['status'] == '0'?'':'checked' ?> 
                                    </div>
                                    <div class="col-md-3">
                                    <label class="mb-0">Trending</label> <br> &nbsp; &nbsp;
                                    <input type="checkbox" name="trending"> <? $data['trending'] == '0'?'':'checked' ?> 
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-warning" name="update_product_btn">Update</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- closing divs -->
                    </div>
                            </div>
                        <?php
                        
                    }
                    else{
                        echo "Product not found for given ID";
                    }
                }
                else{
                    echo "ID missing from URL";
                }
            ?>
        </div>
    </div>
<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->