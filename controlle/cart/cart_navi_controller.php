<?php

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $cartItems = 0;
    $cartTotalPrice = 0;
    foreach ($cart as $cartProduct) {
        $priceWithDiscount = number_format(($cartProduct->getPrice()-($cartProduct->getPrice()*$cartProduct->getdiscount())/100), 2);
        $cartItems += $cartProduct->getQuantity();
        $cartTotalPrice += $priceWithDiscount * $cartProduct->getQuantity();
    }

} else {
    $cartItems = "0";
    $cartTotalPrice = "0.00";
}