<?php

require '../../config.php';

if (isset($_SESSION['cart']) && isset($_GET['pid'])) {
    $productId = $_GET['pid'];
    $cart = $_SESSION['cart'];
    if (isset($_GET['pqty'])) {
        $cartProduct = $cart[$productId];
        if ($cartProduct->getQuantity() - 1 == 0) {
            unset($cart[$productId]);
        } else {
            $cartProduct->setQuantity($cartProduct->getQuantity() - 1);
            $cart[$productId] = $cartProduct;
        }
        $_SESSION['cart'] = $cart;
    } else {
        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]);
            $_SESSION['cart'] = $cart;
        } else {
            header('HTTP/1.1 404 Not Found', true, 404);
            die();
        }
    }
} else {
    header('HTTP/1.1 404 Not Found', true, 404);
    die();
}