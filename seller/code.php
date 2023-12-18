<?php
    include('../config/dbcon.php');
    include('../functions/myfunctions.php');

    if (isset($_POST['add_category_btn'])) {
        // $name = $_POST['name'];
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $shop = mysqli_real_escape_string($con, $_POST['shop_name']);
        $slug = mysqli_real_escape_string($con, $_POST['slug']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $status = isset($_POST['status']) ? '1' : '0';
        $popular = isset($_POST['popular']) ? '1' : '0';
        $image = $_FILES['image']['name'];
        $path = "../uploads";
    
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $random = rand(11111,99999);
        $filename = 'gocantini' . $random . '.' . $image_ext;
    
        if ($name != "" && $slug != "" && $description != "") {
            
            session_start(); // start the session
            $userId = $_SESSION['auth_user']['user_id']; // get the user id from the session
            $cate_query = "INSERT INTO categories (user_id, name, shop_name, slug, description, status, popular, image) 
                VALUES ('$userId', '$name','$shop', '$slug', '$description', '$status', '$popular', '$filename')";
    
            $cate_query_run = mysqli_query($con, $cate_query);
    
            if ($cate_query_run) {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
                $message = "Category Added Successfully";
                header("Location: add-category.php?message=$message");
            } else {
                $error = "Something went wrong";
                header("Location: add-category.php?error=$error");
            }
        } else {
            $error = "All fields are required";
            header("Location: add-category.php?error=$error");
        }
    
        exit(); // prevent further execution of the script
    }
    

    else if(isset($_POST['update_category_btn'])){
        $category_id = $_POST['category_id'];
        // $name = $_POST['name'];
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $shop = mysqli_real_escape_string($con, $_POST['shop_name']);
        $slug = mysqli_real_escape_string($con, $_POST['slug']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $status = isset($_POST['status']) ? '1':'0';
        $popular = isset($_POST['popular']) ? '1':'0';
    
        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];
    
        if($new_image != "")
        {
            $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
            $random = rand(11111,99999);
            $update_filename = 'gocantini' . $random . '.' . $image_ext;
        }
        else
        {
            $update_filename = $old_image;
        }
        $path = "../uploads";
    
        $update_query = "UPDATE categories SET name='$name',shop_name='$shop', slug='$slug', description='$description',
        status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id' ";
    
        $update_query_run = mysqli_query($con, $update_query);
    
        if($update_query_run)
        {
            if($_FILES['image']['name'] != "")
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename); 
                if(file_exists("../uploads/".$old_image))
                {
                    unlink("../uploads/".$old_image);
                }
            }
            $message = "Category Updated Successfully";
            header("Location: edit-category.php?id=$category_id&message=$message");
        }
        else
        {
            $error = "Something went wrong";
            header("Location: edit-category.php?id=$category_id&error=$error");
        }
    }
    
    else if(isset($_POST['delete_category_btn'])){
        $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

        $category_query = "SELECT * FROM categories WHERE id='$category_id' ";
        $category_query_run = mysqli_query($con, $category_query);
        $category_data = mysqli_fetch_array($category_query_run);
        $image = $category_data['image'];

        $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
        $delete_query_run = mysqli_query($con, $delete_query);

        if($delete_query_run)
        {
            if(file_exists("../uploads/". $image))
            {
                unlink("../uploads/". $image);
            }
            echo 200;
            //redirect("category.php", "Category Deleted Successfully");
        }
        else{
            echo 500;
            //redirect("category.php", "Something went wrong");
        }
    }
    else if(isset($_POST['add_product_btn'])) {
        
        $category_id = $_POST['category_id'];
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $shop = mysqli_real_escape_string($con, $_POST['shop_name']);
        $slug = mysqli_real_escape_string($con, $_POST['slug']);
        $small_description = mysqli_real_escape_string($con, $_POST['small_description']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $original_price = mysqli_real_escape_string($con, $_POST['original_price']);
        $selling_price = mysqli_real_escape_string($con, $_POST['selling_price']);
        $qty = mysqli_real_escape_string($con, $_POST['qty']);        
        $status = isset($_POST['status']) ? '1' : '0';
        $trending = isset($_POST['trending']) ? '1' : '0';
    
        $image = $_FILES['image']['name'];
    
        $path = "../uploads";
            
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        //$filename = time() . '.' . $image_ext;
        $random = rand(11111,99999);
        $filename = 'gocantini' . $random . '.' . $image_ext;
    
        if($name !== "" && $slug !== "" && $description !== "") {
            session_start(); // start the session
            $userId = $_SESSION['auth_user']['user_id']; // get the user id from the session
            $product_query = "INSERT INTO products (user_id,category_id,name,shop_name,slug,small_description,description,original_price,selling_price,qty,status,trending,image)
            VALUES ('$userId','$category_id','$name','$shop','$slug','$small_description','$description','$original_price','$selling_price','$qty','$status','$trending','$filename')";
        
            $product_query_run = mysqli_query($con, $product_query);
        
            if($product_query_run){
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        
                $message = "Product Added Successfully";
                header("Location: add-product.php?message=$message");

            }else{
                $error = "Something went wrong";
                header("Location: add-product.php?error=$error");
            }

        }else{
            $error = "All fields are required";
            header("Location: add-product.php?error=$error");
        }
        exit();          
    }
    
    else if(isset($_POST['update_product_btn'])){

        $product_id = mysqli_escape_string($con, $_POST['product_id']);
        $category_id = mysqli_escape_string($con, $_POST['category_id']);
        $name = mysqli_escape_string($con, $_POST['name']);
        $shop = mysqli_escape_string($con, $_POST['shop_name']);
        $slug = mysqli_escape_string($con, $_POST['slug']);
        $small_description = mysqli_escape_string($con, $_POST['small_description']);
        $description = mysqli_escape_string($con, $_POST['description']);
        $original_price = mysqli_escape_string($con, $_POST['original_price']);
        $selling_price = mysqli_escape_string($con, $_POST['selling_price']);
        $qty = mysqli_escape_string($con, $_POST['qty']);        
        $status = isset($_POST['status']) ? '1':'0';
        $trending =isset($_POST['trending']) ? '1':'0';

        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];
    
        if($new_image != "")
        {
            $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
            $random = rand(11111,99999);
            $update_filename = 'gocantini' . $random . '.' . $image_ext;
        }
        else
        {
            $update_filename = $old_image;
        }
        $path = "../uploads";
        $update_product_query = "UPDATE products SET category_id='$category_id',name='$name',shop_name='$shop',slug='$slug',small_description='$small_description',description='$description',original_price='$original_price',selling_price='$selling_price',qty='$qty',status='$status',trending='$trending',image='$update_filename' WHERE id='$product_id' ";
        
        $update_product_query = mysqli_query($con, $update_product_query);

        if($update_product_query)
        {
            if($_FILES['image']['name'] != "")
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename); 
                if(file_exists("../uploads/".$old_image))
                {
                    unlink("../uploads/".$old_image);
                }
            }
            //redirect("edit-product.php?id=$product_id", "Category Update Successfully");
            $message = "Product Updated Successfully";
            header("Location: edit-product.php?id=$product_id&message=$message");
        }
        else
        {
            //redirect("edit-product.php?id=$product_id", "Something Went Wrong");
            $error = "Something went wrong";
            header("Location: edit-product.php?id=$product_id&error=$error");
        }
    
    }
    else if(isset($_POST['delete_product_btn'])){

        $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

        $product_query = "SELECT * FROM products WHERE id='$product_id' ";
        $product_query_run = mysqli_query($con, $product_query);
        $product_data = mysqli_fetch_array($product_query_run);
        $image = $product_data['image'];

        $delete_query = "DELETE FROM products WHERE id='$product_id' ";
        $delete_query_run = mysqli_query($con, $delete_query);

        if($delete_query_run)
        {
            if(file_exists("../uploads/". $image))
            {
                unlink("../uploads/". $image);
            }
            echo 200;
            //redirect("products.php", "Product Deleted Successfully");
        }
        else{
            echo 500;
           //redirect("products.php", "Something went wrong");
        }
    }

    else if(isset($_POST['update_status_btn'])){
        $track_no = $_POST['tracking_id'];
        $order_item_id = $_POST['p_code'];
        //$claim_status =isset($_POST['claim_status']) ? '1':'0';
        $claim_status = $_POST['claim_status'];  
        
        // Get seller_id of the current user
        session_start(); // start the session
        $userId = $_SESSION['auth_user']['user_id']; // get the user id from the session
    
        // Check if seller_id matches the seller_id associated with the order_item
        $checkSeller_query = "SELECT seller_id FROM order_items WHERE p_code='$order_item_id'";
        $checkSeller_query_run = mysqli_query($con, $checkSeller_query);
        $order_seller_id = mysqli_fetch_assoc($checkSeller_query_run)['seller_id'];
        
        if($userId == $order_seller_id) {
            // Update claim_status
            $updateStatus_query = "UPDATE order_items SET claim='$claim_status' WHERE p_code='$order_item_id'";
            $updateStatus_query_run = mysqli_query($con, $updateStatus_query);
    
            $message = "Order Status Updated Successfully";
            header("Location: view-order.php?t=$track_no&message=$message");
        }
        else {
            $message = "You don't have permission to update the status of this order item.";
            header("Location: view-order.php?t=$track_no&error=$message");
        }
    }
    else if (isset($_POST['edit_profile_btn'])) {
        session_start(); // start the session

        $userId = $_SESSION['auth_user']['user_id']; // get the user id from the session
        $idNo = $_POST['id_number'];
        $username = mysqli_real_escape_string($con, $_POST['name']);
        // $username = $_POST['name'];
        $bday = $_POST['birthday'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $add = $_POST['address'];
        $password = $_POST['password'];
        //$confirmPassword = $_POST['confirm_password'];

        if(!preg_match('/^[0-9]{11}$/', $phone)) {
            $message = "Phone number must be 11 digits.";
            header("Location: edit-profile.php?id=$userId&error=$message");
            exit();
        }
    
        // Retrieve the user's data from the database
        $select_user_query = "SELECT * FROM `users` WHERE `id` = $userId";
        $select_user_query_run = mysqli_query($con, $select_user_query);
    
        if(mysqli_num_rows($select_user_query_run) > 0) {
            $user_data = mysqli_fetch_assoc($select_user_query_run);
        }
    
        // Check if a new image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $new_image = $_FILES['image']['name'];
    
            // Get the file extension
            $image_ext = strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
    
            // Check if the file is an image
            $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array($image_ext, $allowed_exts)) {
                $message = "File is not an image.";
                header("Location: edit-profile.php?id=$userId&error=$message");
                exit();
            }
    
            // Generate a unique filename
            $random = rand(11111, 99999);
            $update_filename = 'gocantini' . $random . '.' . $image_ext;
            $path = "../uploads/";
    
            // Move the uploaded image to the uploads folder
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $path . $update_filename)) {
                $message = "Failed to upload image.";
                header("Location: edit-profile.php?id=$userId&error=$message");
                exit();
            }
            // Update the user's profile with the new image filename
            $update_profile_query = "UPDATE `users` SET `id_number` = '$idNo', `name` = '$username', `birthday` = '$bday', `phone` = '$phone', `email` ='$email', `address` = '$add', `image` = '$update_filename' WHERE `id` = $userId";
            $update_profile_query_run = mysqli_query($con, $update_profile_query);
            // if(!isset($_POST['password']) || empty($_POST['password'])) {
            } else {
                // Check if the user has an image set
                if(empty($user_data['image'])) {
                    $default_image = "../uploads/default.png"; // Set the default image path
                    $update_filename = $default_image; // Set the image filename to be used
                } else {
                    $update_filename = $user_data['image']; // Use the user's existing image filename
                }
            }
    
        // Update the user's profile without changing the image
        $update_profile_query = "UPDATE `users` SET `id_number` = '$idNo', `name` = '$username', `birthday` = '$bday', `phone` = '$phone', `email` ='$email', `address` = '$add', `image` = '$update_filename' WHERE `id` = $userId";
        $update_profile_query_run = mysqli_query($con, $update_profile_query);

        // Check if the password is being updated
        if(!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

        // Check if the old password is correct
        if(password_verify($old_password, $user_data['password'])) {
            // Check if the new password and confirm password match
            if($new_password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                // Update the user's password
                $update_password_query = "UPDATE `users` SET `password` = '$hashed_password' WHERE `id` = $userId";
                $update_password_query_run = mysqli_query($con, $update_password_query);
                // Check if the update was successful
                if ($update_password_query_run) {
                    $message = "Profile and Password Updated Successfully";
                    header("Location: edit-profile.php?id=$userId&message=$message");
                    exit();
                } else {
                    $message = "Failed to update password.";
                    header("Location: edit-profile.php?id=$userId&error=$message");
                    exit();
                }
            } else {
                $message = "New password and confirm password do not match.";
                header("Location: edit-profile.php?id=$userId&error=$message");
                exit();
            }
        } else {
            $message = "Old password is incorrect.";
            header("Location: edit-profile.php?id=$userId&error=$message");
            exit();
        }
        } else {
        // Update the user's profile without changing the password or image
        $update_profile_query = "UPDATE `users` SET `id_number` = '$idNo', `name` = '$username', `birthday` = '$bday', `phone` = '$phone', `email` ='$email', `address` = '$add', `image` = '$update_filename' WHERE `id` = $userId";
        $update_profile_query_run = mysqli_query($con, $update_profile_query);

        // Check if the update was successful
        if ($update_profile_query_run) {
            $_SESSION['auth_user']['name'] = $username;
            $message = "Profile Updated Successfully";
            header("Location: edit-profile.php?id=$userId&message=$message");
            exit();
        } 
        else {
            $message = "All fields are required";
            header("Location: edit-profile.php?id=$userId&error=$message");
            exit();
            }

        }
    }
    else{
        header('Location: index.php');
}
    

    
    
    
    
?>