<?php 
session_start();

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You are already Logged In";
    header('Location: index.php');
    exit();
}


include('includes/header.php'); 
?>
<!-- container for registration form --> 
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Alert message -->
                <?php 
                if(isset($_SESSION['message']))
                {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                }
                ?>
                <!-- Registration Form -->
                <div class="card">
                    <div class="card-header">
                    <h4>Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authcode.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" required name="name" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="number" required name="phone" class="form-control" placeholder="Enter your phone number">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" required name="email" class="form-control" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" required name="password" class="form-control" placeholder="Enter password" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                            <input type="password" required  name="cpassword" class="form-control" placeholder="Confirm password">
                        </div>
            
                        <button type="submit" required name="register_btn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- end of Registration form -->
            </div>
        </div>
    </div>
</div>
<!-- end of container for registration form -->

<?php include('includes/footer.php'); ?>