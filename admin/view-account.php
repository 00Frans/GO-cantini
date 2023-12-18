<?php
include('../functions/myfunctions.php');
include('includes/header.php');

if(isset($_GET['email'])){
    $email = $_GET['email'];

    $getEmail = checkTrackingNoValid($email);
    if(mysqli_num_rows($getEmail) < 0){
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

$user_email = mysqli_fetch_array($getEmail);
?>
<div class="container mt-5">
    <div class="row">
            <?php
                $email_fetch = $_GET['email'];

                // Sanitize the user input to prevent SQL injection
                $email_escape = mysqli_real_escape_string($con, $email_fetch);

                $email_query = "SELECT * FROM users WHERE email = '$email_escape'";
                $email_query_run = mysqli_query($con, $email_query);

                if (mysqli_num_rows($email_query_run) > 0) {
                    foreach ($email_query_run as $users) {
                
            ?>
        <div class="col-md-3">
            <div class="card">
            <div class="d-flex flex-column align-items-center text-center mb-3">
                    <div class="card-header mt-2">
                        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110"> -->
                        <form method="post" enctype="multipart/form-data">
                            <img src="../uploads/<?= $users['image']; ?>" class="mx-3 product-image rounded-circle p-1" width="130" height="130">                  
                        </form>
                        
                    </div>
                     <div class="card-body">
                        <!-- <h5 class="card-title">Title</h5>
                        <p class="card-text">Content</p> -->
                        <p class="mb-1 fw-bold">Name: <?= $users['name']; ?></p>
                        <p class="text-muted font-size-sm fw-bold">Phone: <?= $users['phone']; ?></p>
                        <!-- <a href="#"><input type="button" class="btn btn-primary" value="Update Role"></a> -->
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
                </div> 
            </div> 
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark shadow">
                <!-- <h4 class="fw-bold">USERS INFORMATION <a href="edit-seller-profile.php"><input type="button" class="btn btn-primary px-4 float-right" value="Edit Profile"></a></h4>     -->
                <span class=" h3 text-light">USERS INFORMATION</span>
                <a href="accounts.php" class="btn btn-light float-end"><i class="fa fa-reply"></i> Back</a>
                </div>
                <div class="card-body mt-2">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">ID No.</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $users['id_number']; ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $users['name']; ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Birthday</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $users['birthday']; ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $users['phone']; ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">E-mail</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $users['email']; ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $users['address']; ?>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                        <form method="POST" action="code.php">   
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mt-3">Role_As</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="p-1 mb-3">
                                        <input type="hidden" name="email" value="<?php echo $users['email']; ?>">
                                        <select name="role_as" class="form-select w-30">
                                            <option value="0" <?php if ($users['role_as'] == 0) echo "selected"; ?>>User</option>
                                            <option value="1" <?php if ($users['role_as'] == 1) echo "selected"; ?>>Seller</option>
                                            <option value="2" <?php if ($users['role_as'] == 2) echo "selected"; ?>>Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                               
                            <div class="p-1 mb-3">
                            </div>
                            <button type="submit" name="update_role_btn" class="btn btn-dark shadow float-end">Update Role</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>  
</div>

<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->