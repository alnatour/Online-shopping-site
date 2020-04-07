<?php
$CategoriesDb = CategoriesDb::getInstance();
$SubCategoriesDb = SubCategoriesDb::getInstance();
/* Get all Categories */
if( isset($_GET['cid']) ){
    $categories_breadcrumb = $CategoriesDb->getAllCategories($_GET['cid']);
}
/* Get all Subcategories with Caategory */
if( isset($_GET['subcid']) ){
    $subcategories_breadcrumb = $SubCategoriesDb->getSubCategoryById($_GET['subcid']);
}

// echo '<pre>'; print_r($subcategories_breadcrumb);die();
?>
    <!--- breadcrumb ---->
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-secondary">
        <li class="breadcrumb-item"><a href="<?php echo BASE_URL . 'index.php' ?>" ><i class="fa fa-home"></i> Home</a></li>
        <!--- Categories breadcrumb ---->
        <?php if( isset($_GET['cid']) ){
            foreach ($categories_breadcrumb as $category) { 
                if($category->getId() == $_GET['cid'] ){ ?> 
               <li class="breadcrumb-item"><i class="fa fa-angle-right text-white pr-4" ></i><a  href="<?php echo BASE_URL . 'index.php?cid='?><?= $category->getId() ?>"><?= $category->getName() ?></a></li>
        <?php } } }?>
        <!--- Subcategories breadcrumb ---->
        <?php if( isset($_GET['subcid']) ){  ?>
                <li class="breadcrumb-item"><i class="fa fa-angle-right text-white pr-4"></i><a  href="<?php echo BASE_URL . 'index.php?cid='?><?= $subcategories_breadcrumb['catId']; ?>"><?= ucfirst($subcategories_breadcrumb['catname']); ?></a></li>

                <li class="breadcrumb-item"><i class="fa fa-angle-right text-white pr-4" ></i><a  href="<?php echo BASE_URL . 'index.php?subcid='?><?= $subcategories_breadcrumb['id']; ?>"><?= ucfirst($subcategories_breadcrumb['name']); ?></a></li>
        <?php  }?>
        <!--- Single product ---->
        <?php if( isset($_GET['id']) ){  ?>
                <li class="breadcrumb-item"><i class="fa fa-angle-right text-white pr-4" ></i><a  href="<?php echo BASE_URL . 'index.php?cid='?><?= $article['category_id']; ?>"><?= ucfirst($article['catname']); ?></a></li>

                <li class="breadcrumb-item"><i class="fa fa-angle-right text-white pr-4" ></i><a  href="<?php echo BASE_URL . 'index.php?subcid='?><?= $article['subcategory_id']; ?>"><?= ucfirst($article['subcatname']); ?></a></li>
        <?php  }?>
    </ol>
</nav>