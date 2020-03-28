<?php
require '../../config.php';

$articledb = ArticleDb::getInstance();
$artikelinfo = new ArticleInfo();

$CategoriesDb = CategoriesDb::getInstance();
$SubCategoriesDb = SubCategoriesDb::getInstance();

$categories = $CategoriesDb->getAllCategories();


$PageSize = stripslashes($_POST['PageSize']);

if(isset($_POST['PageSize'])){
    $_SESSION['PageSize'] = $PageSize ;
} 

(isset($_GET['page'])) ? $page = $_GET['page'] : $page=1;


if(isset($_GET['cid']))
{
    $cid  =$_GET['cid'];
    $subcategories = $SubCategoriesDb->getSubCategoryByCategoryid($cid);
    $Products = $SubCategoriesDb->getAllProductsWithCategoryID($page, $PageSize,$cid);
    $countAllProducts = $SubCategoriesDb->countAllProductsWithCategoryID($cid);
    $total = count($countAllProducts);
    
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

$reviewsdb = ReviewsDb::getInstance();
$AverageRatingsforproduct="";
?>

     
<?php 
foreach ($Products as $Product) { ?>

<div class="col-12 col-md-4 menu  single-banner mb-4" style="float:left;background-color:#ffffff!important;">
    <div class="card cart-responsive article">
        
        <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $Product->getId(); ?>">
            <img  class="img-fluid rounded mt-1 mb-4" src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?= $Product->getImagee(); ?>" alt="">
            <?php if(!empty($Product->getDiscount())){ ?>
                <span class="discount"><?= $Product->getDiscount();  ?>%</span>
            <?php } ?>
        </a>
        <div class="card-body">
            <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $Product->getId(); ?>">
                <h6 class="card-title text-center"><?= $Product->getTitle();  ?></h6>
                <div  class="card-text mt-2 text-center "  style="height: 60px!important;">
                    <small class="text-muted">
                        <?php echo substr($Product->getArticle() ,0 ,75);?>
                        <?php if(strlen($Product->getArticle()) > 75){?>
                        <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $Product->getId(); ?>">...</a>
                        <?php } ?>
                    </small> 
                </div>
            </a>
        </div>
        
        <div class="card-footer bg-transparent mt-2 " style="height: 70px!important;">
            <div class="pd-rating">  
                <?php
                    $AverageRatingsforproduct = $reviewsdb->getAverageRatingsForProduct($Product->getId());
                    if (isset($AverageRatingsforproduct)) {
                        foreach ($AverageRatingsforproduct as $average){
                        for ($i = 1 ; $i <=  5 ; $i++){
                            if($i <= round($average['average']) ){?>
                            <i class="fa fa-star text-warning" data-index="<?= $i ?>"></i>
                            <?php } ?>
                            <?php if($i > round($average['average']) ){?>
                            <i class="fa fa-star text-muted" data-index="<?= $i ?>"></i>
                            <?php }
                        } echo "(" . round($average['average'], 2) .")";
                        } 
                    }else { 
                    for ($i = 1 ; $i <=  5 ; $i++){?> 
                        <i class="fa fa-star text-muted" data-index="<?= $i ?>"></i>
                <?php }} ?>
            </div>
            <div class="row "> 
                <div style="width:65%; float:left" class="mt-2">
                    <span class="mb-2 ml-1" <?php if(!empty($Product->getDiscount())){ ?> style="text-decoration: line-through;font-size:12px;color:#7E9AA6" <?php }?>>
                        <?= $Product->getPrice(); ?> $ 
                    </span>
                    <?php if(!empty($Product->getDiscount())){ ?>
                        <span class="mb-2 ml-1" ><?= $Product->getPrice()-(($Product->getPrice()*$Product->getDiscount())/100); ?> $
                    </span>
                    <?php }?>
                </div>
                <div align="right" style="width:35%">
                    <a id="addButtonBlock" class="btn btn-outline-primary" style="font-size:12px"
                    onclick="addToCart(<?= $Product->getId() . ',' . $Product->getPrice() ?>)" >
                        <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd <i class="fa fa-shopping-cart" style="font-size:16px"></i>
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php }?>