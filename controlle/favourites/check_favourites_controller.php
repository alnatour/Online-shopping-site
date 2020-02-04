<?php


if(isset($_SESSION['user'])) {

    $favouritesDao = FavouritesDao::getInstance();
    $favourites = new Favourites();

//Try to accomplish connection with the database
    try {

        $favourites->setUserId($_SESSION['user']);
        $favourites->setProductId($product['id']);

        $isFavourite = $favouritesDao->checkFavourites($favourites);


} catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '../../errors.log');
        header("Location: ../../view/error/error_500.php");
        die();
    }

} else {

    //When isFavourite is 3, it means user is not logged (using numbers, because we have 1 and 2)
    $isFavourite = 3;
}