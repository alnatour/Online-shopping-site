<?php
require '../include.php';

require_once (ROOT_PATH . '/controlle/cart/show_cart_controller.php');

include(ROOT_PATH . '/header.php') ;
?>
<style>

    .img-fluid{
        min-width: 100px!important;
    }
    .input-group-text a{
        cursor: pointer;
    }
    .fa-minus, .fa-plus{
        color: #eee;
        text-decoration: none;
    }
    .fa-minus:hover, .fa-plus:hover{
        color: #fff;
    }

    #quantityText{
        min-width: 42.63px!important;
    }
    .proceed-btn {
        font-size: 14px;
        font-weight: 700;
        color: #ffffff;
        background: #252525;
        text-transform: uppercase;
        display: block;
        text-align: center;
    }
    .continue-shop {
        font-size: 14px;
        font-weight: 700;
        color: #ffffff;
        background-color:#117a8b;
        text-transform: uppercase;
        display: block;
        text-align: center;
    }
</style>
<br><br><br><br><br><br><br>


<div id="cartItems" style="display:none"><?= $cartItems ?></div>
<div id="cartTotalPrice" style="display: inline;"> <?= $cartTotalPrice ?></div>

<div class="container">
    <div class="row mx-auto">
        <div class=" col-12" id="content">
            <table class="table table-hover">
                <thead>
                    <tr bgcolor="#CCCCCC">
                        <th scope="col">Image </th> 
                        <th scope="col">Description </th> 
                        <th scope="col">Quantity </th> 
                        <th scope="col">Price per piece</th> 
                        <th scope="col">Total </th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $cartProduct) { ?>
                    <tr id="product-<?= $cartProduct->getId() ?>">
                        <td width="180">
                            <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $cartProduct->getId(); ?>">
                                <img src="<?php echo BASE_URL . 'view/images/'?><?= $cartProduct->getImage() ?>" alt="<?= $cartProduct->getTitle() ?>" class="img-fluid" >
                            </a> 
                        </td>
                        <td>
                            <?= $cartProduct->getTitle() ?>
                        </td> 
                        <td>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="background-color:#dc3545;color:#fff">
                                        <a onclick='removeOneQuantityFromCart(<?= $cartProduct->getId()
                                            . "," . $cartProduct->getPrice() ?>)'><i class="fas fa-minus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div id="quantityText">
                                    <span id="quantityNumber" class="form-control">
                                        <span id="product-<?= $cartProduct->getId() ?>-quantity">
                                            <?= $cartProduct->getQuantity() ?>
                                        </span>
                                        <span id="Quantity-<?= $cartProduct->getQuantity() ?>">

                                        </span>
                                    </span>
                                </div>
                                <div class="input-group-prepend">
                                    <div class="input-group-text"  style="background-color:#1e7e34;color:#fff">
                                        <a onclick='addOneQuantityToCart
                                                (<?= $cartProduct->getId()
                                        . "," . $cartProduct->getPrice() ?>)'><i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="PriceOne-<?= $cartProduct->getPrice() ?>">
                                <?= $cartProduct->getPrice() ?> 
                            </span>
                        </td>     
                        <td>
                            <span  id="product-<?= $cartProduct->getId() ?>-totalPrice">
                                <?= $cartProduct->getPrice() * $cartProduct->getQuantity() ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 offset-lg-8">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">
                            Number of Items 
                        </th>
                        <th>
                            (<div id="cartItems2"><?= $cartItems ?></div>)
                        </th>
                    </tr>
                </thead>
                    
                <tbody>
                    <tr class="table-dark" style="border-bottom: 1px solid #ffffff;">
                        <th colspan="2">Total</th>
                        <td>
                            <div id="cartTotalPrice2" class="text-white">
                                <?= number_format($cartTotalPrice ,2, '.','2') ?>
                            </div><span class="text-white"> $</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <th colspan="3" style="background-color:#000">
                            <a href="checkout.php" class="proceed-btn">Proceed to Checkout</a>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3" style="background-color:#117a8b">
                            <a href="javascript:history.back()" class="continue-shop" >Continue Shopping</a>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include(ROOT_PATH . '/footer.php') ?>
