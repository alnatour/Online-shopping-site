<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

date_default_timezone_set('Europe/Vienna');

require 'model/database/ConnectionDb.php';

require 'model/ContactDB.php';
require_once ('controlle/SessionManagement.php'); 


require 'model/RegisterDb.php';
require 'model/ContactService.php';
require 'model/Entity/User.php';
require 'model/RegisterService.php';

require 'model/ArticleDb.php';
require 'model/Entity/Article.php';

require 'model/ReviewsDb.php';
require 'model/Entity/Reviews.php';

require 'model/CategoriesDb.php';
require 'model/Entity/Category.php';
require 'model/SubCategoriesDb.php';
require 'model/Entity/SubCategory.php';

require 'view/main/contact_us/contactform.php';

//Cart
require 'model/Entity/CartProduct.php';



$feedback = '';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



// define global constants
define ('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost/xampp/2020/20.11.2019%20Produkts/kontakte_verwalten/');
