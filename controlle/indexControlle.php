<?php
require_once (ROOT_PATH . "/controlle/cart/cart_navi_controller.php");

$search='';
$data = false;

$articledb = ArticleDb::getInstance();
$artikelinfo = new ArticleInfo();
/* Get all Categories */
$CategoriesDb = CategoriesDb::getInstance();
$SubCategoriesDb = SubCategoriesDb::getInstance();

$categories = $CategoriesDb->getAllCategories();
//$subcategories = $SubCategoriesDb->getAllSubCategories();



(isset($_SESSION['PageSize'])) ? $PageSize = $_SESSION['PageSize'] : $PageSize=8;

if(!isset($_GET['page']))
{
    $page = 1;
}else{
    $page =$_GET['page'];
   
}


if(isset($_GET['cid']))
{
    $cid  =$_GET['cid'];
    $subcategories = $SubCategoriesDb->getSubCategoryByCategoryid($cid);
    $Products = $SubCategoriesDb->getAllProductsWithCategoryID($page, $PageSize,$cid);
    $countAllProducts = $SubCategoriesDb->countAllProductsWithCategoryID($cid);
    $total = count($countAllProducts);

    //echo '<pre>'; print_r($Products);die();
}else{
    $subcid ='';
    $Products = $articledb->GetProductsWithSubcat($page, $PageSize, $subcid);
    $total = $articledb->CountAllArtikels();
}

if(isset($_GET['subcid']))
{
    $subcid =$_GET['subcid'];
    $Subcategory = $SubCategoriesDb->getAllSubCategoriesAdmin();
    $getSubCategoryById = $SubCategoriesDb->getSubCategoryById($subcid );
    $Products = $articledb->GetProductsWithSubcat($page, $PageSize, $subcid);
    $total = count($Products);
}
/** end Categories */

if (isset($_POST['submit_search'])) {
    $search = trim($_POST['search']);
    $search = "%{$search}%";
    $Products = $articledb->GetProductsWithSearch($page, $PageSize, $search);
   // echo'<pre>';print_r($Products);die;
    $total = count($Products);

    if (empty($Products)){
        $feedback = ' nichts gefunden';
    }
}

$PageCount = ceil($total/$PageSize);





?>