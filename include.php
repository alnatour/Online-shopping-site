<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

date_default_timezone_set('Europe/Vienna');


require 'model/ContactDB.php';
require_once('controlle/SessionManagement.php'); 

require 'model/Contact.php';
require 'model/ContactService.php';
require 'model/ArticleDb.php';
require 'model/ArticleInfo.php';

require 'model/CategoriesDb.php';
require 'model/Category.php';
require 'model/SubCategoriesDb.php';
require 'model/SubCategory.php';

require 'model/RegisterRepository.php';
require 'model/Users.php';
require 'model/RegisterService.php';

require 'contact_with_us/contactform.php';

//Cart
require 'model/CartProduct.php';
require 'model/FavouritesDao.php';
require 'model/Favourites.php';



$feedback = '';

$user = new User();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// define global constants
define ('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost/xampp/2020/20.11.2019%20Produkts/kontakte_verwalten/');
