<?php
session_start();
include('config/dbcon.php');

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='1'";
    return mysqli_query($con, $query);
}
function getUsers($table)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM $table WHERE id = $userId";
    return $query_run = mysqli_query($con, $query);
}
function getAllTrending()
{
    global $con;
    $query = "SELECT * FROM products WHERE trending='1' ";
    return mysqli_query($con, $query);
}
function getSlugActive($table, $slug)
{
    global $con;
    $escaped_slug = mysqli_real_escape_string($con, $slug);
    // $query = "SELECT * FROM $table WHERE slug='$escaped_slug' AND status='1' LIMIT 1";
    $query = "SELECT * FROM $table WHERE slug='$escaped_slug' AND status='1' ORDER BY shop_name ASC LIMIT 1";
    return mysqli_query($con, $query);
}

function getProdByCategory($category_id)
{
    global $con;
    $escaped_category = mysqli_real_escape_string($con, $category_id);
    $query = "SELECT * FROM products WHERE category_id='$escaped_category' AND status='1' ";
    return $query_run = mysqli_query($con, $query);
}


function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='1' ";
    return $query_run = mysqli_query($con, $query);
}

function getCartItems()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.seller_id, c.prod_qty, p.id as pid, p.name, p.shop_name, p.image, p.selling_price
                FROM carts c, products p
                WHERE c.prod_id=p.id
                AND c.user_id='$userId' 
                ORDER BY c.seller_id ASC, c.id DESC "; // group by seller ID, sort by cart ID
    return $query_run = mysqli_query($con, $query);
}
function getCartItem()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.seller_id, c.prod_qty, p.id as pid, p.name, p.shop_name, p.image, p.selling_price
                FROM carts c, products p
                WHERE c.prod_id=p.id
                AND c.user_id='$userId'
                AND c.check_box = '1'
                ORDER BY c.seller_id ASC, c.id DESC "; // group by seller ID, sort by cart ID
    return $query_run = mysqli_query($con, $query);
}

// function getCartItem(){
//     global $con;
//     $userId = $_SESSION['auth_user']['user_id'];
//     $query = "SELECT c.id as cid, c.prod_id, c.seller_id, c.prod_qty, p.id as pid, p.name, p.slug, p.image, p.selling_price
//                 FROM carts c, products p
//                 WHERE c.prod_id=p.id
//                 AND c.user_id='$userId' 
//                 ORDER BY c.seller_id ASC, c.id DESC "; // group by seller ID, sort by cart ID
//     $query_run = mysqli_query($con, $query);
//     $cart_items = array();
//     while ($row = mysqli_fetch_assoc($query_run)) {
//         $seller_id = $row['seller_id'];
//         if (!isset($cart_items[$seller_id])) {
//             $cart_items[$seller_id] = array();
//         }
//         $cart_items[$seller_id][] = $row;
//     }
//     return $cart_items;
// }

function getOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id='$userId' ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}
function checkTrackingNoValid($trackingNo)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_id='$trackingNo' AND user_id='$userId' ";

    return mysqli_query($con, $query);
}

// Function to sanitize anchor (shop name) for HTML ID attribute
function sanitizeAnchor($string)
{
    $string = preg_replace("/[^a-zA-Z0-9]+/", "-", $string);
    $string = trim($string, "-");
    return strtolower($string);
}



?>