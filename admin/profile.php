<?php
include('../functions/myfunctions.php');
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
                        <a href="edit-profile.php?id=<?= $users['id']; ?>"><input type="button" class="btn btn-primary" value="Edit Profile"></a>
                    </div>
                </div> 
            </div> 
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                <!-- <h4 class="fw-bold">USERS INFORMATION <a href="edit-seller-profile.php"><input type="button" class="btn btn-primary px-4 float-right" value="Edit Profile"></a></h4>     -->
                <span class="fw-bold h3 ">ADMIN INFORMATION</span>

                </div>
                <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>  
</div>
<?php
 }
?>
<?php include('includes/footer.php'); ?>