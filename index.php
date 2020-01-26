<?php
require 'include.php';

$userDb = RegisterRepository::getInstance();
$articledb = ArticleDb::getInstance();
$artikelinfo = new ArticleInfo();
/* Get all Categories */
$CategoriesDb = CategoriesDb::getInstance();
$SubCategoriesDb = SubCategoriesDb::getInstance();

$categories = $CategoriesDb->getAllCategories();
//$subcategories = $SubCategoriesDb->getAllSubCategories();



(isset($_SESSION['PageSize'])) ? $PageSize = $_SESSION['PageSize'] : $PageSize=4;

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


//echo '<pre>'; print_r($GetArticlesWithAuthor);die();
require 'header.php';
?>

<div class ="smooth">
    <div class="parallax-artikel"></div>
<!---Logo---->
<div class="d-flex justify-content-center parallax-artikel">
<a href="#" style="font-size:33px; ;color:red" title="Startseite">Abdul Store</a>
</div>


<!---Categori---->

<nav class="navbar navbar-expand-lg navbar-light bg-light ml-4 mr-4 mt-4" style="background-color:#999999 !important;">
  <a class="navbar-brand" href="index.php">Categories</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ">
        <?php foreach ($categories as $category) { 
        if(isset($_GET['cid'])){
        $active = ($category->getId() == $_GET['cid']) ? ' page-active' : '';
        }?>
        <li class="nav-item  <?php if(isset($_GET['cid'])){echo $active;}?>">
            <a class="nav-link text-white" href="<?php echo BASE_URL . 'index.php?cid='?><?= $category->getId() ?>"><?= $category->getName() ?></a>
        </li>
        <?php }?>
    </ul>
  </div>
</nav>

<!---Filter---->
<br>
<div class="container-fluid">
    <select id="PageSize" name="PageSize"  class="form-control form-control-sm " style="width:100px;float:right">
    <option <?php if ($PageSize == 3 ) echo 'selected' ; ?> value="3">3</option>
    <option <?php if ($PageSize == 4 ) echo 'selected' ; ?> value="4">4</option>
    <option <?php if ($PageSize == 8 ) echo 'selected' ; ?> value="8">8</option>
    </select>
</div>

<br><br>
<!---1---->
<div class="container-fluid">
    <div class="row "> 

        <div class="list-group col-12 col-md-2" style="width:200px; ">
                <?php if (isset($_GET['cid'])) {?>
                    <p style="font-weight: bold" class="mt-3 text-center">Sub Gategories </p>
                    <?php foreach ($subcategories as $subcategory) { ?>
                            <a href="index.php?subcid=<?= $subcategory->getId() ?>"  class="list-group-item list-group-item-action">
                                <?= $subcategory->getName() ?></a>
                <?php  }}  
                    
                if (isset($_GET['subcid']))  {?>
                    <p style="font-weight: bold" class="mt-3 text-center">Sub Gategories </p>
                        <a  class="list-group-item list-group-item-action">
                            <?= $getSubCategoryById['name'] ?>
                        </a>
                <?php } 
                
                if (empty($_GET)){ ?>
                    <p style="font-weight: bold" class="mt-3 text-center">Gategories </p>
                    <?php  foreach ($categories as $category) {?>
                        <a href="index.php?cid=<?= $category->getId() ?>"  class="list-group-item list-group-item-action" >
                            <?= $category->getName() ?>
                        </a>
                    <?php  }} ?>
            
        </div>

        <?php if(isset($_GET['cid'])){ ?>
            <div class="col-12 col-md-10" id="postsdiv">
                <?php 
                foreach ($Products as $Product) {
                //  echo '<pre>'; print_r($Product);die();
                ?>
                    <div class=" mt-4 pl-1 pr-1 ml-1 " style="width:267px;float:left">
                    <div class=" bg-white pl-1 pr-1">
                            <!-- Preview Image -->
                        <div>
                            <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product['productId']; ?>">
                            <img  class="img-fluid rounded mt-4 mb-4" src="view/images/<?= $Product['imagee']; ?>" alt="" width="550px">
                            </a>
                        </div>
                        <!-- Title -->
                        <div align="center"  style="color:  #000; height:40px">
                            <p><?= $Product['title'];  ?></p>
                        </div>
                        <!-- Author -->
                        <hr>
                        <!-- Post Content -->
                        <div align="center" style="color:  #4d4d4d; height:30px">
                            <p ><?= $Product['article']; ?>
                            </p>
                        </div>
                        <hr>
                        <!-- Price -->
                        <div align="center">
                            <a style="color: #f50c20;"> <?= $Product['price']; ?> €  Pay</a>
                        </div>
                        <br>
                    </div>
                    </div>
                <?php }?>
            </div>
        <?php }

        else {?> <!---2---->
            <div class="col-12 col-md-10" id="postsdiv">
                <?php 
                foreach ($Products as $Product) {
                // echo '<pre>'; print_r($Products);die();
                ?>
                    <div class="mt-4 pl-1 pr-1 ml-1" style="width:267px;float:left">
                    <div class=" bg-white pl-1 pr-1">
                            <!-- Preview Image -->
                        <div>
                            <a href="article/view_one_artikel.php?id=<?= $Product->getId(); ?>">
                            <img  class="img-fluid rounded mt-4 mb-4" src="view/images/<?= $Product->getImagee(); ?>" alt="" width="550px">
                            </a>
                        </div>
                        <!-- Title -->
                        <div align="center"  style="color:  #000; height:40px">
                            <p><?= $Product->getTitle();  ?></p>
                        </div>
                        <!-- Author -->
                        <hr>
                        <!-- Post Content -->
                        <div align="center" style="color:  #4d4d4d; height:30px">
                            <p ><?= $Product->getArticle(); ?>
                            </p>
                        </div>
                        <hr>
                        <!-- Price -->
                        <div align="center">
                            <a style="color: #f50c20;"> <?= $Product->getPrice(); ?> €  Pay</a>
                        </div>
                        <br>
                    </div>
                    </div>
                <?php }?>
            </div>
        <?php }?>

    </div>
</div>



<?php include(ROOT_PATH . '/pages.php') ?>

<br><br><br>

<?php include(ROOT_PATH . '/footer.php') ?>

