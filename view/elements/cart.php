<?php require_once (ROOT_PATH . "/controlle/cart/cart_navi_controller.php"); 
?>

<div align="right" class="col-lg-2 col-md-2" style="">
    <ul class="">
        <li style="list-style:none">
            <div align="right" id="cartToHover" class="box_1">
                <a class="nav-link" href="<?php echo BASE_URL . 'view/main/cart/cart_panel.php'?>">
                    <span id="cartItems" class="notify-badge" style="right: -35px!important;top: -8px!important;"><?= $cartItems ?></span>
                    <i class="fa fa-shopping-cart" style="font-size:30px;"></i>
                </a>
            </div>
            <div id="cartDivHover" class="cart-hover">
                
                <div id="cartDivHover2" class="cart-items"></div>

                <div class="cart-total p-2" style='background-color:#fff'>
                    <span><h4 style="color: #e7ab3c;">total:</h4></span><span style="color: #e7ab3c;float: right;margin-left:10px"> $</span>
                    <h5 id="cartTotalPrice"><?= $cartTotalPrice ?></h5>
                    <br>
                </div>
                <div class="select-button" style='background-color:#fff; color:#fff!important;'>
                    <a href="<?php echo BASE_URL . 'view/main/cart/cart_panel.php' ?>" class="btn btn-lg btn-dark">VIEW CARD</a>
                    <a href="<?php echo BASE_URL . 'view/main/cart/checkout.php' ?>" class="btn btn-lg btn-info mt-2">CHECK OUT</a>
                </div>
            </div>
        </li>
    </ul>
</div>
