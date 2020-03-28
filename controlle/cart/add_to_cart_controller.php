<?php
require '../../config.php';


$productsDao = ArticleDb::getInstance();
$cartProduct = new CartProduct();

if (isset($_GET['pid'])) {

    $productId = $_GET['pid'];
    $quantity = $_GET['pqty'];
  
    
    $productDetails = $productsDao->GetByid($productId);

    $cartProduct->setId($productId);

    $cartProduct->setTitle($productDetails->getTitle());
    
    $cartProduct->setPrice($productDetails->getPrice());
 
    $cartProduct->setImage($productDetails->getImagee());

    $cartProduct->setDiscount($productDetails->getDiscount());

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        if (array_key_exists($cartProduct->getId(), $cart)) {
            $cartProduct->setQuantity($cart[$cartProduct->getId()]->getQuantity() + $quantity);
            $cart[$cartProduct->getId()] = $cartProduct;
        } else {
            $cartProduct->setQuantity($quantity);
            $cart[$cartProduct->getId()] = $cartProduct;
        }
        $_SESSION['cart'] = $cart;
    } else {
        $cartProduct->setQuantity($quantity);
        $cart[$cartProduct->getId()] = $cartProduct;
        $_SESSION['cart'] = $cart;
    }



    header("Location: /index.php");
    die();
} else {
    header('HTTP/1.1 404 Not Found', true, 404);
    die();
}