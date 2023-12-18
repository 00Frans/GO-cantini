<?php 

include('includes/header.php'); 
include('../middleware/sellerMiddleware.php');

?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if(isset($_GET['id']))
                    {   
                        $id = $_GET['id'];
                        $category = getByID("categories", $id);

                        if(mysqli_num_rows($category) > 0 )
                        {
                            $data = mysqli_fetch_array($category);
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Category
                                        <a href="category.php" class="btn btn-primary float-end">Back</a>
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
                                                <input type="hidden" name="category_id" value="<?= $data['id']?>">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="<?= $data['name']?>" placeholder="Enter Category Name" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Shop Name</label>
                                                <input type="text" name="shop_name" value="<?= $data['shop_name']?>" placeholder="Enter Shop Name" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Slug</label>
                                                <input type="text" name="slug" value="<?= $data['slug']?>" placeholder="Eg. Category Name + Shop Name" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Description</label>
                                                <textarea rows="3" name="description" placeholder="Enter description" class="form-control" > <?= $data['description']?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for=""> Upload Image </label>
                                                    <input type="hidden" name="old_image" value="<?= $data['image']?>">
                                                    <input type="file" name="image" class="form-control mb-2">
                                                    <label for=""> Current Image </label>
                                                    <img src="../uploads/<?= $data['image']?>" alt="Product Image" height="50px" width="50px">

                                                </div>
                                            <div class="col-md-6">
                                            <label for="">Status</label>
                                            <input type="checkbox" <?= $data['status'] ? "checked":"" ?> name="status">
                                            </div>
                                            <div class="col-md-6">
                                            <label for="">Popular</label>
                                            <input type="checkbox" <?= $data['popular'] ? "checked":"" ?> name="popular">
                                            </div>
                                            <div class="col-md-12">
                                            <button type="submit" class="btn btn-warning" name="update_category_btn">Update</button>
                                            </div>
                                        </div>
                                        </form>
                                </div> 
                            </div>
                        <?php
                        }
                        else
                        {
                            echo "Category not found";
                        }
                    }
                    else
                    {
                        echo "Id missing from url";
                    }
                        ?>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->