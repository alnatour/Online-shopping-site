<?php
$articledb = ArticleDb::getInstance();
$reviewsdb = ReviewsDb::getInstance();
$CategoriesDb = CategoriesDb::getInstance();
$SubCategoriesDb = SubCategoriesDb::getInstance();
$artikelinfo = new ArticleInfo();

$search='';
$data = false;

/* Get Topics */
$categories = $CategoriesDb->getAllCategories();
$subcategories = $SubCategoriesDb->getAllSubCategories();
/* End  Get Topics */

/*  set PageSize And Page*/
(isset($_SESSION['PageSize'])) ? $PageSize = $_SESSION['PageSize'] : $PageSize=9;
if(!isset($_GET['page'])) { $page = 1;}else{ $page =$_GET['page'];}
/* End set PageSize And Page*/

/* Get Products Home without Topics*/

$Products = $articledb->GetProductsWithSubcat($page, $PageSize, $subcid='');
$total = $articledb->CountAllArtikels();
/* End Get Products Home*/

/* Get Products With Category ID*/
if(isset($_GET['cid']))
{
    $cid  =$_GET['cid'];
    $Products = $SubCategoriesDb->getAllProductsWithCategoryID($page, $PageSize,$cid);
    $countAllProducts = $SubCategoriesDb->countAllProductsWithCategoryID($cid);
    $total = count($countAllProducts);
}
/* End Get Products With Category ID*/

if(isset($_GET['subcid']))
{
    $subcid =$_GET['subcid'];
    $Subcategory = $SubCategoriesDb->getAllSubCategoriesAdmin();
    $getSubCategoryById = $SubCategoriesDb->getSubCategoryById($subcid );
    $Products = $articledb->GetProducts($page, $PageSize, $subcid);
    $total = count($Products);
}

/* Get Products With Search*/
if (isset($_POST['submit_search'])) {
    $search = trim($_POST['search']);
    $search = "%{$search}%";
    $Products = $articledb->GetProductsWithSearch($page, $PageSize, $search);
    $total = count($Products);

    if (empty($Products)){
        $feedback = ' nichts gefunden';
    }
}

$PageCount = ceil($total/$PageSize);

$AverageRatingsforproduct="";

/** Most Recent Articles*/
$most_articles = $articledb->getMostRecent();


 //echo'<pre>';print_r($most_articles);die;
?>