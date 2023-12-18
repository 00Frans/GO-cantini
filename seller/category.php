<?php 
include('includes/header.php'); 
include('../middleware/sellerMiddleware.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark shadow">
                    <span class="fs-4 text-white">Categories</span>
                        <a href="index.php" class="btn btn-light float-end"><i class="fa fa-reply"></i> Back</a>
                </div>
                    <div class="card-body" id="category_table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $categories = getAll("categories");
                                if(mysqli_num_rows($categories) > 0)
                                {
                                    while($item = mysqli_fetch_assoc($categories))
                                    {
                                        ?>
                                        <tr>
                                            <td><p class="mx-3"><?= $item['id']; ?></p></td>
                                            <td><p class="mx-3"><?= $item['name']; ?></p></td>
                                            <td>
                                                <a href="image-viewer-categories.php?img=<?= $item['image']; ?>" target="_blank">
                                                    <img src="../uploads/<?= $item['image']; ?>" class="mx-3 product-image" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="mx-3"><?= $item['status'] == '1' ? "Visible" : "Hidden" ?> </p>
                                            </td>
                                            <td>
                                                <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-dark shadow">Edit</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger delete_category_btn" value="<?=$item['id'];?>">Delete</button>
                                                <!--
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_category_btn">Delete</button>
                                                </form>
                                                -->
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<tr><td colspan='6'>No records found</td></tr>";
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
</div>

<?php include('includes/footer.php'); ?> <!-- Calling the footer.php code here -->
