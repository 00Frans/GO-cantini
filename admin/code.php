<?php
    include('../config/dbcon.php');
    include('../functions/myfunctions.php');


    if(isset($_POST['update_status_btn'])){
        $track_no = $_POST['tracking_id'];
        $order_item_id = $_POST['p_code'];
        //$claim_status =isset($_POST['claim_status']) ? '1':'0';
        $claim_status = $_POST['claim_status'];  
        
        // Update claim_status
        $updateStatus_query = "UPDATE order_items SET claim='$claim_status' WHERE p_code='$order_item_id'";
        $updateStatus_query_run = mysqli_query($con, $updateStatus_query);
        
        $message = "Order Status Updated Successfully";
        header("Location: view-order.php?t=$track_no&message=$message");

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
    //update_order_btn
    else if(isset($_POST['update_order_btn'])){
        $track_no = $_POST['tracking_id'];
        $order_status = $_POST['order_status'];

        $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_id='$track_no'  ";
        $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

        $message = "Order Status Updated Successfully";
        header("Location: view-order.php?t=$track_no&message=$message");
    }
    // Update Role
    else if (isset($_POST['update_role_btn'])) {
        $email = $_POST['email'];
        $role_as = $_POST['role_as'];

        // Update the role in the database
        $updateRole_query = "UPDATE users SET role_as='$role_as' WHERE email='$email'";
        $updateRole_query_run = mysqli_query($con, $updateRole_query);

        if ($updateRole_query_run) {
            $message = "Role updated successfully";
            header("Location: view-account.php?email=$email&message=$message");
            exit;
        }
    }
    else{
        header('Location: index.php');
}


    

    
    
    
    
?>