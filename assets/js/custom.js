$(document).ready(function () {
   
    //increment
    $(document).on('click','.increment-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value= parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 99) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });
    //decerement 
    $(document).on('click','.decrement-btn', function (e){
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value= parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });
    //add to cart
    $(document).on('click','.addToCartBtn', function (e){
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function (response) {
                if(response == 201){
                    alertify.success("Product Added to cart");
                }
                else if(response == 210){
                    alertify.success("Product already in cart");
                }
                else if(response == 401){
                    //alert("Login to continue");
                    alertify.success("Login to continue");
                }
                else if(response == 500){
                    alertify.success("Something went wrong!");
                }
                else if(response == 999){
                    alertify.success("This Product is soldout, Please select another product");
                }
                
            }
        });
        
    });
    //update qty in database
    $(document).on('click','.updateQty', function (e) {

        e.preventDefault();
        
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function () {
                $('#mycart').load(location.href + " #mycart");
            }
        });
        
    });

// $(document).on('click', '.input-check', function(e) {
//     e.preventDefault();

//     var checkbox = $(this);
//     var prod_id = checkbox.closest('.product_data').find('.prodId').val();

//     // Determine the new checkbox value based on its current state
//     var newCheckboxValue = checkbox.is(':checked') ? 1 : 0;

//     console.log("prod_id:", prod_id); // Debug output

//     $.ajax({
//         method: "POST",
//         url: "functions/handlecart.php",
//         data: {
//             "prod_id": prod_id,
//             "check_box": newCheckboxValue,
//             "scope": "update_check_box"
//         },
//         success: function(response) {
//             if (response === "success") {
//                 // Update the UI or perform any necessary actions
//                 console.log("Checkbox value updated successfully");
//             } else {
//                 console.log("Error updating checkbox value: " + response);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.log("AJAX request error: " + error);
//         }
//     });
// });

    

    //delete item
    $(document).on('click','.deleteItem', function () {
        var cart_id = $(this).val();
        //alert(cart_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                if(response == 200){
                    alertify.success("Item deleted successfully");
                    $('#mycart').load(location.href + " #mycart");
                }else{
                    alertify.success(reponse);
                }
            }
        });
        
    });
});

