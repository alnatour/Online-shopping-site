<?php
require '../include.php';

require_once (ROOT_PATH . '/controlle/cart/show_cart_controller.php');

include(ROOT_PATH . '/header.php') ;
?>
<style>
 td,th{
    font-size:18px!important;
}
</style>
<br><br><br><br><br><br><br>


<div id="cartItems" style="display:none"><?= $cartItems ?></div>
<div id="cartTotalPrice" style="display: inline;"> <?= $cartTotalPrice ?></div>

<div class="container">
    <div class="row mx-auto">
        <div class=" col-12" id="content">
            <table class="table table-hover" cellspacing="0" cellpadding="5" style="border-radius:20px;border:1px solid #ccc">
                <tbody>
                    <tr bgcolor="#CCCCCC">
                        <th width="220" align="left">Image </th> 
                        <th width="130" align="left">Description </th> 
                        <th width="250" align="center">Quantity </th> 
                        <th width="150" align="right">Price per piece</th> 
                        <th width="60" align="right">Total </th> 
                        <th width="130">Total Price</th>
                        
                    </tr>
                    <?php foreach ($cart as $cartProduct) { 
                      //  echo "<pre>";print_r($cartProduct->getImage());die;
                        ?>
                    <tr id="product-<?= $cartProduct->getId() ?>">
                        <td>
                            <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $cartProduct->getId(); ?>">
                                <img src="<?php echo BASE_URL . 'view/images/'?><?= $cartProduct->getImage() ?>" alt="<?= $cartProduct->getTitle() ?>" width="180"></td>
                            </a> 
                        <td> <?= $cartProduct->getTitle() ?></td> 
                        <td align="center">             
                            <div id="quantityText">Quantity:
                                <span id="quantityNumber">
                                    <span id="product-<?= $cartProduct->getId() ?>-quantity">
                                        <?= $cartProduct->getQuantity() ?>
                                    </span>
                                    <span id="Quantity-<?= $cartProduct->getQuantity() ?>">

                                    </span>
                                </span>
                            </div>
                            <button class="btn btn-xs btn-danger"
                                            onclick="removeOneQuantityFromCart
                                            (<?= $cartProduct->getId()
                                    . "," . $cartProduct->getPrice() ?>)"><i class="fas fa-minus"></i>
                            </button>
                            <button class="btn btn-xs btn-success"
                                        onclick="addOneQuantityToCart
                                        (<?= $cartProduct->getId()
                                . "," . $cartProduct->getPrice() ?>)"><i class="fas fa-plus"></i>
                            </button>
                        </td>
                        <td align="right">
                            <span id="PriceOne-<?= $cartProduct->getPrice() ?>">
                                <?= $cartProduct->getPrice() ?> 
                            </span>
                        </td> 
                                
                        <td align="right">
                            <span  id="product-<?= $cartProduct->getId() ?>-totalPrice">
                                <?= $cartProduct->getPrice() * $cartProduct->getQuantity() ?>
                            </span>
                        </td>
                        
                    </tr>
      
                    <?php } ?>

                    <tr>
                        <td>Total Price for all </td>
                        <td></td>
                        <td></td>
                        <td>
                            <small>Number of Items 
                                 <div id="cartItems2"><?= $cartItems ?></div>
                            </small> 
                        </td>
                        <td>
                        </td>
                        <td>
                            <div id="cartTotalPrice2">
                                    <?= number_format($cartTotalPrice ,2, '.','2') ?>
                            </div>
                                  €
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div align="center"  style=" margin-top: 20px;">
        <div  class="checkout">
            <a href="checkout.php" class="more btn btn-info" >Proceed to Checkout</a>
        </div>
        <div class="continueshopping ">
            <a href="javascript:history.back()" class="more btn btn-success" >Continue Shopping</a>
        </div>
    </div>


</div>