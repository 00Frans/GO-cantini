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


<!-- login container -->
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-8">
                <!-- Registration Form -->
                <div class="card">
                    <div class="card-body card shadow">
                        <div class="row">
                            <div class="col-md-6">
                            <!-- Login Form -->
                                <div class="card card shadow">
                                    <div class="card-header card shadow">
                                    <h4>Login Form</h4>
                                    </div>
                                    <div class="card-body card shadow">
                                        <form action="functions/authcode.php" method="POST">

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter password" id="exampleInputPassword1">
                                        </div>
                            
                                        <button type="submit" name="login_btn" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    PHOTO
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of Registration form -->
        </div>
    </div>
</div>
<!-- end of login container -->


<?php include('includes/footer.php'); ?> 