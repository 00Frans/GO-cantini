//delete product
$(document).ready(function() {
    $(document).on('click', '.delete_product_btn', function(e){
        e.preventDefault();

        var id = $(this).val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                method:"POST",
                url: "code.php",
                data:{
                    'product_id': id,
                    'delete_product_btn': true
                },
                success: function(response){
                    if(response == 200){
                        swal("Success!", "Product Deleted Successfully", "success");
                        // Reload the products table after the product is deleted
                        $("#products_table").load(location.href + " #products_table", function(response, status, xhr) {
                            if (status == "error") {
                                console.log("Error reloading products table:", xhr.status, xhr.statusText);
                            }
                        });
                        
                    }
                    else if(response == 500){
                        swal("Error!", "Something went wrong", "error");
                    }

                }
              });
            }
          });

    });

});

//delete category
$(document).ready(function () {

    $(document).on('click', '.delete_category_btn', function(e){
        e.preventDefault();

        var id = $(this).val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: "POST",
                        url: "code.php",
                        data: {
                            'category_id': id,
                            'delete_category_btn': true
                        },
                        success: function (response) {
                            if (response == 200) {
                                swal("Success!", "Category Deleted Successfully", "success");
                                // Reload the products table after the product is deleted
                                $("#category_table").load(location.href + " #category_table", function (response, status, xhr) {
                                    if (status == "error") {
                                        console.log("Error reloading category table:", xhr.status, xhr.statusText);
                                    }
                                });

                            }
                            else if (response == 500) {
                                swal("Error!", "Something went wrong", "error");
                            }

                        }
                    });
                }
            });

    });

});
