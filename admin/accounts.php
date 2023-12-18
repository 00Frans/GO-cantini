<?php 
include('includes/header.php'); 
include('../middleware/adminMiddleware.php');

?> <!-- Calling the header.php code here -->
    
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark shadow">
                <span class="fs-4 text-white">ACCOUNTS</span>
                    <a href="index.php" class="btn btn-light float-end"><i class="fa fa-reply"></i> Back</a>
                </div>
                <div class="card-body" id="category_table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID number</th>
                                    <th>Name</th>
                                    <th>Birthday</th>
                                    <th>Role</th>
                                    <th>Details</th>
                                <tr>
                            </thead>
                            <tbody>
                                <?php
                                $allUsers = getAllUsers();                                    
                                    foreach ($allUsers as $users) {
                                        ?>
                                            <tr>
                                                <td>&nbsp<?= $users['id']; ?></td>
                                                <td>&nbsp<?= $users['id_number']; ?></td>
                                                <td>&nbsp<?= $users['name']; ?></td>
                                                <td>&nbsp<?= $users['birthday']; ?></td>
                                                <td>&nbsp&nbsp<?= $users['role_as'] == '1' ? "Seller" : ($users['role_as'] == '2' ? "Admin" : "User") ?></td>
                                                <td>
                                                    <a href="view-account.php?email=<?= $users['email']; ?>" class="btn btn-dark shadow center">View Details</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->
