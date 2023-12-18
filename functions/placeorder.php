<?php 
    session_start();
    include('../config/dbcon.php');

    if(isset($_SESSION['auth'])){
        if(isset($_POST['placeOrderBtn'])){
        
            $idno = mysqli_real_escape_string($con, $_POST['id_number']);
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $phone = mysqli_real_escape_string($con, $_POST['phone']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $refno = mysqli_real_escape_string($con, $_POST['refno']); //reference no of gcash
            //save image in database
            $receipt = $_FILES['image']['name'];
            
            $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
            //$payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

            if($idno == "" || $name == "" || $phone == "" || $email == "" || $refno == ""){

                if(empty($_FILES['image']['name'])){
                    $_SESSION['message'] = "Receipt is required";
                    header('Location: ../checkout.php');
                    exit(0);
                }
                
                $_SESSION['message'] = "All fields are required";
                header('Location: ../checkout.php');
                exit(0);
            }

            $userId = $_SESSION['auth_user']['user_id'];
            $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price
                        FROM carts c, products p
                        WHERE c.prod_id=p.id
                        AND c.user_id='$userId' 
                        ORDER BY c.id DESC ";
            $query_run = mysqli_query($con, $query);

            $totalPrice = 0;
            foreach ($query_run as $citems){
                $totalPrice += $citems['selling_price'] * $citems['prod_qty'];

            }
            $tracking_no = rand(1111111111111111,9999999999999999);
                $path = "../uploads/receipt";
                $image_ext = pathinfo($receipt, PATHINFO_EXTENSION);
                $random = rand(11111,99999);
                $filename = 'gocantini' . $random . '.jpg'; // add ".jpg" extension

                $insert_query = "INSERT INTO orders (tracking_id, user_id, idno, name, email, phone, total_price, refno, receipt, payment_mode)
                                VALUES ('$tracking_no', '$userId', '$idno', '$name', '$email', '$phone', '$totalPrice','$refno', '$filename', '$payment_mode')";
                $insert_query_run = mysqli_query($con, $insert_query);

                if ($insert_query_run) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

                $order_id = mysqli_insert_id($con);
                foreach ($query_run as $citem) {
                    {
                        $prod_id = $citem['prod_id'];
                        $prod_qty = $citem['prod_qty'];
                        $price = $citem['selling_price'];
                
                        // Get the product data
                        $product_query = "SELECT id, user_id, qty FROM products WHERE id='$prod_id' LIMIT 1";
                        $product_query_run = mysqli_query($con, $product_query);
                        $productData = mysqli_fetch_array($product_query_run);
                        $prod_code = $productData['id'];
                        $user_id = $productData['user_id'];
                        $current_qty = $productData['qty'];
                
                        // Generate the order item code
                        $p_code = rand(111111111,999999999);
                
                        $insert_items_query = "INSERT INTO order_items (seller_id, p_code, order_id, prod_id, qty, price) 
                        VALUES ('$user_id', '$p_code', '$order_id', '$prod_id', '$prod_qty', '$price')";
                                
                        $insert_items_query_run = mysqli_query($con, $insert_items_query);
                    
                    }
                    // Calculate the new quantity
                    $new_qty = $current_qty - $prod_qty;
            
                    // Ensure that the new quantity is non-negative
                    if ($new_qty < 0) {
                        $new_qty = 0;
                    }
            
                    // Update the product quantity
                    $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id'";
                    $update_query_run = mysqli_query($con, $updateQty_query);
            
                }        
            
                $deleteCartQuery = "DELETE FROM carts WHERE user_id='$userId'";
                $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);
            
                $_SESSION['message'] = "Order placed successfully";
                header('Location: ../my-orders.php');
                die();
            }            
            
        }
    }
    else{
        header('Location: ../index.php');
    }
?>