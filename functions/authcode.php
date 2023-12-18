<?php

session_start();
include('../config/dbcon.php');
include('myfunctions.php');

if(isset($_POST['register_btn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']); // mysql_real_escape_string prevents sql injection
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']); 
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);


    //check if email is already registered
    $check_email_query = "SELECT email FROM users WHERE email = '$email' ";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(!preg_match('/^[0-9]{11}$/', $phone)) {
        $_SESSION['message'] = "Phone number must be 11 digits.";
        header('Location: ../register.php');
        exit();
    }
    
    if(mysqli_num_rows($check_email_query_run) > 0)
    {
       $_SESSION['message'] = "Email already exists";
       header('Location: ../register.php');
    }
    else
    {
        //check if the password matches
        if($password == $cpassword)
        {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $insert_query = "INSERT INTO users(name, phone, email, password) VALUES('$name', '$phone', '$email', '$hashed_password')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if($insert_query_run)
            {
                $_SESSION['message'] = "Registered Successfully";
                header('Location: ../login.php');
            }
            else
            {
                $_SESSION['message'] = "Something went wrong";
                header('Location: ../register.php');
            }
        }
        else
        {
            $_SESSION['message'] = "Passwords do not match";
            header('Location: ../register.php');
        }
    
    }
    
}
else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email'";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        $userdata = mysqli_fetch_array($login_query_run);
        $hashed_password = $userdata['password'];

        // Verify password
        if (password_verify($password, $hashed_password))
        {
            $_SESSION['auth'] = true;
            $userid = $userdata['id'];
            $username = $userdata['name'];
            $useremail= $userdata['email'];
            $role_as= $userdata['role_as'];

            $_SESSION['auth_user'] = [
                'user_id' => $userid,
                'name' => $username,
                'email' => $useremail

            ];
            $_SESSION['role_as'] = $role_as;
            if($role_as == 1) // the user is seller
            {
                redirect("../seller/index.php","Welcome to Dashboard");
            }
            else if($role_as == 2) //the user is admin
            {
                redirect("../admin/index.php", "Welcome to admin");
            }
            else // the user is a normal user
            {
                redirect("../index.php","Welcome to Homepage!");
            }
        }
        else
        {
            redirect("../login.php","Invalid Credentials"); 
        }
    }
    else
    {
        redirect("../login.php","Invalid Credentials"); 
    }
}

?>
