<?php
require 'include.php';
require 'controlle/indexControlle.php';
require 'header.php';
?>


<div class ="smooth">
    <div class="parallax-artikel"  style="margin-top:66px">
        <br><br><br><br><br><br>
        <!---Logo---->
        <div class="col-4 text-center mx-auto" style="background-color:#ccc !important">
            <a href="#" style="font-size:33px; ;color:red;font-family: Lucida Grande" title="Startseite">
                <h2>Abdul Shopping Site</h2>
            </a>
            <!--
            <div class="">
                <form method="post" action="Contact_from_db.php" class="form-inline"> 
                    <input type="text" name="Search" class="form-control mr-sm-0" value="<?=$Search;?>">
                    <input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-1" />
                </form>
            </div>
        -->
        </div>

        <!---Categori---->
        <nav class="navbar navbar-expand-lg navbar-light bg-light ml-4 mr-4 mt-4 hover-navbar" style="background-color:#fff !important;">
            <a class="navbar-brand" href="index.php">All Articles</a>
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
                        <a class="nav-link" href="<?php echo BASE_URL . 'index.php?cid='?><?= $category->getId() ?>"><?= $category->getName() ?></a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </nav>
    </div>
</div>


    <!-- Cart button -->
<div class="container-fluid">
    <div class="header_right col-2" style="float: right;margin-top: 1em;position: relative;">

        <!-- Cart page button -->
        <div id="cartToHover" class="cart box_1" style="height:60px;">
            <a href="cart/cart.php">
                <div class="total" style="display: inline-block;vertical-align: middle; color: #18C9D2;">$
                    <div id="cartTotalPrice" style="display: inline;"><?= $cartTotalPrice ?></div>
                    <br>
                    (<div id="cartItems" style="display: inline;"><?= $cartItems ?></div> items )
                </div>
                <i class="fas fa-shopping-cart"></i>
            </a>

            <div class="clearfix"></div>
        </div>
        <div id="cartDivHover" style="margin-top:-27px;margin-left:-30px;"></div>
    </div>
    <div class="clearfix"></div>
</div>
            

<!---Filter---->
<br>
<div class="container-fluid">
    <select id="PageSize" name="PageSize"  class="form-control form-control-sm " style="width:100px;float:right">
    <option <?php if ($PageSize == 4 ) echo 'selected' ; ?> value="4">4</option>
    <option <?php if ($PageSize == 8 ) echo 'selected' ; ?> value="8">8</option>
    <option <?php if ($PageSize == 16 ) echo 'selected' ; ?> value="16">16</option>
    </select>
</div>

<br><br>
<!---1---->



<div class="container-fluid content">
    <div class="row "> 

        <div class="col-12 col-md-2 menu" style="width:200px;background-color:#ffffff!important; ">
            <div class="card cart-responsive">
                <?php if (isset($_GET['cid'])) {?>
                    <p style="font-weight: bold" class="mt-3 text-center card-header">Sub Gategories </p>
                    <?php foreach ($subcategories as $subcategory) { ?>
                    <div class="card-content">
                            <a href="index.php?subcid=<?= $subcategory->getId() ?>"  class="list-group-item list-group-item-action">
                                <?= $subcategory->getName() ?>
                            </a>
                     </div>
                <?php  }}  
                    
                if (isset($_GET['subcid']))  {?>
                    <p style="font-weight: bold" class="mt-3 text-center card-header">Sub Gategories </p>
                        <a  class="list-group-item list-group-item-action">
                            <?= $getSubCategoryById['name'] ?>
                        </a>
                <?php } 
                
                if (empty($_GET)){ ?>
                    <p style="font-weight: bold" class="mt-3 text-center card-header">Gategories </p>
                    <?php  foreach ($categories as $category) {?>
                        <div class="card-content">
                            <a href="index.php?cid=<?= $category->getId() ?>"  >
                                <?= $category->getName() ?>
                            </a>
                        </div>
                    <?php  }} ?>
            </div>
        </div>

        <?php if(isset($_GET['cid'])){ ?>
            <div class="col-12 col-md-10 " id="postsdiv">
                <?php 
                foreach ($Products as $Product) {
                //  echo '<pre>'; print_r($Product);die();
                ?>
                        <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product['productId']; ?>">
                            <div class="card mr-2 mb-2 cart-responsive article" style="width:240px;height:410px;float:left;background-color:#ffffff!important;">
                                <img  class="img-fluid rounded mt-4 mb-4" src="view/images/<?= $Product['imagee']; ?>" alt="">
                            <div class="card-body">

                                <h5 class="card-title text-center"><?= $Product['title'];  ?></h5>
                                
                            <div  class="card-text mt-2 text-center"  style="height:35px">
                                <small class="text-muted">
                                    <?php echo substr($Product['article'] ,0 ,75);?>
                                    <?php if(strlen($Product['article']) > 75){?>
                                    <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product['productId']; ?>">...</a>
                                    <?php } ?>
                                </small> 
                            </div>

                                <div class="mt-2">
                                    <small>
                                        <span>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-muted"></i>
                                            <i class="fa fa-star text-muted"></i>
                                        </span>
                                    </small> 
                                </div>
                        </a>
                                <span class="mb-2">
                                   <?= $Product['price']; ?> € 
                                </span>
                                <div align="right" class="">
                                    <a id="addButtonBlock" class="btn btn-info btn-sm" style="margin-top:-25px; font-size:9px"
                                    onclick="addToCart(<?= $Product['productId'] . "," . $Product['price'] ?>)" >
                                        <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
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
                    <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product->getId(); ?>">
                        <div class="card mr-2 mb-2 cart-responsive article" style="width:240px;height:410px;float:left;background-color:#ffffff!important;">
                                <img  class="img-fluid rounded mt-4 mb-4" src="view/images/<?= $Product->getImagee(); ?>" alt="">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $Product->getTitle();  ?></h5>
                                
                                <div  class="card-text mt-2 text-center"  style="height:35px">
                                    <small class="text-muted">
                                        <?php echo substr($Product->getArticle() ,0 ,75);?>
                                        <?php if(strlen($Product->getArticle()) > 75){?>
                                        <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product->getId(); ?>">...</a>
                                        <?php } ?>
                                    </small> 
                                </div>
                                <div class="mt-2">
                                    <small>
                                        <span>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-muted"></i>
                                            <i class="fa fa-star text-muted"></i>
                                        </span>
                                    </small> 
                                </div>

                                <span class="mb-2">
                                 <?= $Product->getPrice(); ?> € 
                                </span>

                                <div align="right" class="">
                                    <a id="addButtonBlock" class="btn btn-info btn-sm" style="margin-top:-25px; font-size:9px"
                                    onclick="addToCart(<?= $Product->getId() . "," . $Product->getPrice() ?>)" >
                                        <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </a>

                  
                <?php }?>
            </div>
        <?php }?>

    </div>
</div>



<?php include(ROOT_PATH . '/pages.php') ?>

<br><br><br>

<?php include(ROOT_PATH . '/footer.php') ?>

