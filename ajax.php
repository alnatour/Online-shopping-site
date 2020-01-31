<?php
require 'include.php';

$articledb = ArticleDb::getInstance();
$artikelinfo = new ArticleInfo();

$CategoriesDb = CategoriesDb::getInstance();
$SubCategoriesDb = SubCategoriesDb::getInstance();

$categories = $CategoriesDb->getAllCategories();


$PageSize = stripslashes($_POST['PageSize']);

if(isset($_POST['PageSize'])){
    $_SESSION['PageSize'] = $PageSize ;
} 



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



$PageCount = ceil($total/$PageSize);

?>

              


<?php 
    foreach ($Products as $Product) { ?>


        <div class="card mr-2 mb-2 cart-responsive article" style="width:240px;height:380px;float:left;background-color:#ffffff!important;">
            <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product->getId(); ?>">
                <img  class="img-fluid rounded mt-4 mb-4" src="view/images/<?= $Product->getImagee(); ?>" alt="">
            </a>
            <div class="card-body">
                <h6 class="card-title text-center"><?= $Product->getTitle();  ?></h6>

                <p class="card-text mt-2 text-center">
                    <small class="text-muted"><?= $Product->getArticle();  ?></small> 
                </p>

                <p class="card-text mt-2 text-right ">
                    <?= $Product->getPrice(); ?> €  Pay
                </p>
                
            </div>
        </div>

    
<?php }?>