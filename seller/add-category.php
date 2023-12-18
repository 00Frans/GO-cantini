<?php 
include('includes/header.php'); 
include('../middleware/sellerMiddleware.php');
?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-dark shadow">
                <span class="fs-4 text-white">Add Category</span>
                    <a href="index.php" class="btn btn-light float-end"><i class="fa fa-reply"></i> Back</a>
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
                          <label for="">Name</label>
                          <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                        </div>
                        <div class="col-md-12">
                          <label for="">Shop Name</label>
                          <input type="text" name="shop_name" placeholder="Enter Shop Name" class="form-control">
                        </div>
                        <div class="col-md-12">
                          <label for="">Slug</label>
                          <input type="text" name="slug" placeholder="eg. Category Name + Shop Name" class="form-control">
                        </div>
                        <div class="col-md-12">
                          <label for="">Description</label>
                          <textarea rows="4" name="description" placeholder="Enter description" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12">
                          <label for=""> Upload Image </label>
                          <input class="mx-1 mt-2" type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label for="">Status</label>
                          <input type="checkbox" name="status">
                        </div>
                        <div class="col-md-6">
                          <label for="">Popular</label>
                          <input type="checkbox" name="popular">
                        </div>
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-warning" name="add_category_btn">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                <!-- closing divs -->
              </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->