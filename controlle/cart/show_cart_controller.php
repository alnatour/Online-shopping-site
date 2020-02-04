<?php

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    // cartTotalPrice
    $cartItems = 0;
    $cartTotalPrice = 0;
    foreach ($cart as $cartProduct) {
        $cartItems += $cartProduct->getQuantity();
        $cartTotalPrice += $cartProduct->getPrice() * $cartProduct->getQuantity();
    }
    //end
    $cartIsEmpty = 0;
} else {
    $cart = array();
    $cartItems = "0";
    $cartTotalPrice = "0.00";
    $cartIsEmpty = 1;
}

if (isset($_SESSION['oid'])) {
    $orderNumber = $_SESSION['oid'];
    $orderQuantity = $_SESSION['oItems'];
    $orderTotalPrice = $_SESSION['oTotalPrice'];
    unset($_SESSION['oid']);
    unset($_SESSION['oItems']);
    unset($_SESSION['oTotalPrice']);
    $orderSuccessful = 1;
} else {
    $orderSuccessful = 0;
}