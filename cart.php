<?php 
include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');
?>
<div id="mycart">
  <div class="py-3" id="mycart">
    <div class="container">
    <?php $items = getCartItems();
      if(mysqli_num_rows($items)){
        ?>
      <div class="card card-body shadow">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive" >
              <table class="table">
                <thead>
                  <tr>
                    <th>Remove</th>
                    <th>Seller ID</th> 
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th><span class="float-end">Subtotal</span></th>
                  </tr>
                </thead>
                  <tbody>
                          <?php
                          $totalPrice = 0;
                          foreach ($items as $citems) {
                            $subtotal = $citems['selling_price'] * $citems['prod_qty'];
                            $totalPrice += $subtotal; // Accumulate subtotal to the total price
                          ?>
                          <tr class="product_data">
                            <td class="align-middle">
                                <button class="btn btn-danger btn-sm float-start deleteItem" value="<?= $citems['cid']; ?>">
                                <i class="fa fa-trash me-2"></i>Remove
                                </button>
                            </td>
                            <td class="align-middle">
                                <div class="align-items-center mx-3">
                                <h5 class="mb-0"><?= $citems['seller_id']; ?></h5>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="align-items-center">
                                <img src="uploads/<?= $citems['image']; ?>" alt="Image" width="80" height="80">
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="align-items-center">
                                <h5 class="mb-0"><?= $citems['name']; ?></h5>
                                </div>
                            </td>
                            <td class="align-middle">₱ <?= $citems['selling_price']; ?></td>
                            <td class="align-middle">
                                <input type="hidden" class="prodId" value="<?=$citems['prod_id']; ?>">
                                <div class="input-group" style="max-width: 110px;">
                                <button class="input-group-text px-2 decrement-btn updateQty">-</button>
                                <input type="text" class="form-control text-center input-qty bg-white" value="<?= $citems['prod_qty']; ?>">
                                <button class="input-group-text px-2 increment-btn updateQty">+</button>
                                </div>
                            </td>
                            <td class="align-middle">₱ <span class="subtotal"><?= $citems['selling_price'] * $citems['prod_qty']; ?></span></td>
                            <!--<td class="align-middle">₱ <span class="subtotal"><?= $citems['selling_price'] * $citems['prod_qty']; ?></span></td> -->
                          </tr>
                          <?php
                          }
                      ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="total-price">
            <table>
              <tr>
                <td>Total Price: </td>
                <td> ₱ <?= $totalPrice; ?></td>
                
              </tr>
            </table>
        </div>
        <div class="row">
          <div class="col-md-12 text-end mt-2">
            <a href="checkout.php" class="btn btn-dark checkout-btn">Proceed to Checkout</a>
      </div>
    </div>
    <?php
      }
      else{
        ?>
        <div class="card card-body shadow text-center">
          <h4 class="py-3">Your Cart is Empty</h4>
        </div>
        <?php
      }
      ?>
  </div>
</div>

<?php include('includes/footer.php'); ?>

<style>
  .input-group-text {
    padding: 0.3rem 0.5rem;
    font-size: 0.8rem;
    min-width:1.5rem;
  }

  .input-group-text.px-2 {
    padding: 0.3rem 0.5rem;
    font-size: 0.8rem;
  }

  .input-qty {
    font-size: 1rem;
    padding: 0.3rem 0.5rem;
    width:2rem;
    border: 1px solid #ced4da;
    border-radius: 4px;
    text-align: center;
  }

  .input-group .input-group-text {
    margin: 0;
  }

  .align-middle {
    vertical-align: middle;
  }
  th{
    min-width: 119px;
  }
  div.total-price{
    display:flex;
    justify-content: flex-end;
  }
  .total-price table{
    border-top: 3px solid #000000;
    width: 100%;
    max-width: 350px;
  }
  td:last-child{
    text-align: right;
  }
  th:last-childe{
    text-align: right;
  }
  

</style>
