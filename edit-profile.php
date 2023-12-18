<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>
<?php
    $user = getUsers("users");
    if(mysqli_num_rows($user) > 0){ 
        foreach($user as $users)
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
            <form action="code.php" method="POST" enctype="multipart/form-data">
            <div class="d-flex flex-column align-items-center text-center mb-3">
                    <div class="mt-3">
                        <img src="uploads/<?= $users['image']; ?>" class="mx-3 product-image rounded-circle p-1" width="130" height="130"> 
                    </div>
                     <div class="card-body">
                        <!-- <h5 class="card-title">Title</h5>
                        <p class="card-text">Content</p> -->
                        <p class="mb-1 fw-bold">Name: <?= $users['name']; ?></p>
                        <p class="text-muted font-size-sm fw-bold">Phone: <?= $users['phone']; ?></p>
                        <button type="submit" class="btn btn-secondary shadow" name="edit_profile_btn">Update</button>
                        <a href="profile.php"><input type="button" class="btn btn-dark shadow" value="Back"></a>
                        <?php 
                        // Check if the message query parameter exists
                        if(isset($_GET['message'])) {
                            $message = $_GET['message'];
                            echo "<div class='alert alert-success text-white'>$message</div>";
                            unset($_SESSION['success_message']);
                            echo "<script>
                            setTimeout(function(){
                                $('.alert-success').fadeOut();
                            }, 1500);
                            </script>";
                        }
                        // Check if there were any errors
                        if(isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo "<div class='alert alert-danger text-white'>$error</div>";
                            echo "<script>
                            setTimeout(function(){
                                $('.alert-danger').fadeOut();
                            }, 1500);
                            </script>";
                        }
                        ?>
                            
                    </div>
                </div> 
            </div> 
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                <!-- <h4 class="fw-bold">USERS INFORMATION <a href="edit-seller-profile.php"><input type="button" class="btn btn-primary px-4 float-right" value="Edit Profile"></a></h4>     -->
                <span class="fw-bold h3 ">USERS INFORMATION</span>
                </div>
                <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h6 class="mb-0">ID No.</h6>
                            </div>
                            <div class="col-sm-6">
                            <input class="wide-input" type="text" name="id_number" value="<?= $users['id_number']; ?>" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-6">
                                <input class="wide-input" type="text" name="name" value="<?= $users['name']; ?>"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Birthday</h6>
                            </div>
                            <div class="col-sm-6 ">
                                <input class="wide-input" type="date" name="birthday" value="<?= $users['birthday']; ?>" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="wide-input" name="phone" value="<?= $users['phone']; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">E-mail</h6>
                            </div>
                            <div class="col-sm-6 ">
                                <input class="wide-input" type="text" name="email" value="<?= $users['email']; ?>" />          
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-6">
                                <textarea class="wide-input" name="address" rows="3"><?= $users['address']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Old Password</h6>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="old_password" class="wide-input">
                        </div>
                    </div>
                        <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">New Password</h6>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="new_password" class="wide-input">
                        </div>
                    </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Confirm New Password</h6>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" name="confirm_password" class="wide-input">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Edit Image</h6>
                            </div>
                            <div class="col-sm-6">
                            <input type="hidden" name="current_image" value="<?php echo $user_data['image']; ?>">
                            <input type="file" name="image" class="form-control" value="<?= pathinfo($users['image'], PATHINFO_EXTENSION); ?>">
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>  
</div>
<?php
 }
?>
<style>
    input[type="date"] {
    width: 100%;
}
    
    .wide-input{
        width:100%;
    }

</style>
<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->