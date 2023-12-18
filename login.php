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
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header card shadow">
                    Login Form
                </div>
                <div class="card-body card shadow">
                    <div class="row">
                        <!-- Alert message -->
                        <?php 
                        if(isset($_SESSION['message'])) {
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message']; ?>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                            unset($_SESSION['message']);
                        }
                        ?>
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center mb-3">
                            <img src="gocantini-logo.png" alt="" class="w-80" height="230">
                            <span>Don't have an account?
                                <a href="register.php" class="text-dark">Register here</a>
                            </span>
                        </div>
                            <div class="col-md-6">
                                <!-- Login Form -->
                                <form action="functions/authcode.php" method="POST">
                                    <div class="mb-4 mt-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control border border-dark" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control border border-dark" placeholder="Enter password" id="exampleInputPassword1">
                                    </div>
                                    <button type="submit" name="login_btn" class="btn btn-dark text-white mt-3">Submit</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of login container -->




<?php include('includes/footer.php'); ?> 