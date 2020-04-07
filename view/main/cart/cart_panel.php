<?php
require '../../../config.php';

require_once (ROOT_PATH . '/controlle/cart/show_cart_controller.php');

require (ROOT_PATH . '/view/elements/head_section.php');
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
        min-width: 40px!important;
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
<br><br><br>


<div id="cartItems" style="display:none"><?= $cartItems ?></div>
<div id="cartTotalPrice" style="display: none;"> <?= $cartTotalPrice ?></div>

<div class="container bg-white p-4">
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
                    <?php foreach ($cart as $cartProduct) {
                        $priceWithDiscount= $cartProduct->getPrice()- ($cartProduct->getPrice()*$cartProduct->getDiscount()/100);
                        ?>
                    <tr id="product-<?= $cartProduct->getId() ?>">
                        <td width="180">
                            <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $cartProduct->getId(); ?>">
                                <img src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?= $cartProduct->getImage() ?>" alt="<?= $cartProduct->getTitle() ?>" class="img-fluid" >
                            </a> 
                        </td>
                        <td>
                            <?= $cartProduct->getTitle() ?>
                        </td> 
                        <td>
                            <div class="input-group input-group-sm mb-2">
                                <a style="cursor: pointer" onclick="removeOneQuantityFromCart(<?= $cartProduct->getId() . ',' . $priceWithDiscount ?>)">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="background-color:#dc3545;color:#fff">
                                            <i class="fa fa-minus"></i>
                                        </div>
                                    </div>
                                </a>
                                <div id="quantityText" class="input-group-prepend "  >
                                    <span id="quantityNumber" class="input-group-text bg-white" style="width:40px">
                                        <span id="product-<?= $cartProduct->getId() ?>-quantity"  class="mx-auto">
                                            <?= $cartProduct->getQuantity() ?>
                                        </span>
                                        <span id="Quantity-<?= $cartProduct->getQuantity() ?>">

                                        </span>
                                    </span>
                                </div>
                                <a style="cursor: pointer" onclick="addOneQuantityToCart(<?= $cartProduct->getId() . ',' . $priceWithDiscount ?>)">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"  style="background-color:#1e7e34;color:#fff">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </td>
                        <td>
                            <span id="PriceOne-<?= number_format($priceWithDiscount,2) ?>">
                                <?= number_format($priceWithDiscount,2) ?> 
                            </span>
                        </td>     
                        <td>
                            <span  id="product-<?= $cartProduct->getId() ?>-totalPrice">
                                <?= number_format($priceWithDiscount * $cartProduct->getQuantity(),2) ?>
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
                            <a href="<?php echo BASE_URL . 'view/main/cart/checkout.php' ?>" class="proceed-btn">Proceed to Checkout</a>
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

<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
