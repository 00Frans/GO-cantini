<?php

include('../config/dbcon.php');

function getAll($table)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM $table WHERE user_id = $userId";
    return $query_run = mysqli_query($con, $query);
}
function getUsers($table)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM $table WHERE id = $userId";
    return $query_run = mysqli_query($con, $query);
}
function getSpecificUsers($table)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM $table WHERE user_id = $userId";
    return $query_run = mysqli_query($con, $query);
}
function getAllUsers() {
    global $con; // Assuming you have a database connection already established

    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error executing the query: " . mysqli_error($con));
    }

    $users = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    mysqli_free_result($result);

    return $users;
}



function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' ";
    return $query_run = mysqli_query($con, $query);
}

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}
function getallOrders(){
    global $con;

    //$query = "SELECT o.*, u.name, p.slug, FROM orders o, users u, products p WHERE status='0' AND o.user_id=u.id AND p.slug=o.slug ";
    $query = "SELECT * FROM orders WHERE status='0' ";
    return $query_run = mysqli_query($con, $query);
}
function getSellerOrders(){
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM order_items WHERE seller_id = $userId";
    $result = mysqli_query($con, $query);
    $orders = array();
    while($row = mysqli_fetch_assoc($result)){
        $orders[] = $row;
    }
    return $orders;
}
function getOrderHistory(){
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    //$query = "SELECT o.*, u.name FROM orders o, users u WHERE status='0' AND o.user_id=u.id ";
    $query = "SELECT * FROM orders WHERE status ='1' ";
    return $query_run = mysqli_query($con, $query);
}
function getCompletedHistory(){
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    //$query = "SELECT o.*, u.name FROM orders o, users u WHERE status='0' AND o.user_id=u.id ";
    $query = "SELECT * FROM orders WHERE status ='2' ";
    return $query_run = mysqli_query($con, $query);
}
// function getOrdersHistory($orderId) {
//     global $con;
//     $userId = $_SESSION['auth_user']['user_id'];
//     $query = "SELECT *, oi.seller_id 
//               FROM orders o, order_items oi 
//               WHERE status!='0' AND oi.seller_id = $userId AND oi.order_id = $orderId";
//     return $query_run = mysqli_query($con, $query);
// }
function getOrdersHistory($userId = null){
    global $con;
    if ($userId === null) {
        $userId = $_SESSION['auth_user']['user_id'];
    }
    $query = "SELECT *,oi.seller_id FROM orders, order_items oi WHERE status!='0' AND oi.seller_id = $userId AND oi.order_id ";
    return $query_run = mysqli_query($con, $query);
}



function checkTrackingNoValid($trackingNo){
    
    global $con;

    $query = "SELECT * FROM orders WHERE tracking_id='$trackingNo' ";

    return mysqli_query($con, $query);
}
function checkUser($email){
    
    global $con;

    $query = "SELECT * FROM users WHERE email='$email' ";

    return mysqli_query($con, $query);
}




?>