<?php
require 'include.php';
require 'controlle/indexControlle.php';
require 'header.php';
?>


<div class ="smooth">
    <div class="parallax-artikel"  style="margin-top:50px">
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
            <a class="navbar-brand" href="<?php echo BASE_URL . 'index.php' ?>">All Articles</a>
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
<div class="container-fluid " >
    <div  class="row">
        <div class="col-lg-3 col-md-3">
            <div class="logo">
                <a href="./index.html">
                    <img src="public/img/logo-carousel/logo.png" alt="" width="100%">
                </a>
            </div>
        </div>
        <div class="col-lg-7 col-md-7 mt-4" style="margin-top:50px!important">
                <form method="post" action="index.php">
                    <div class="input-group mt-3">
                        <input type="text" name="search" class="form-control col-8" placeholder="What do you need?" class="form-control" value="<?=$search;?>">
                        <div class="input-group-prepend">
                            <input type="submit" name="submit_search" value="Search" class="btn btn-outline-primary" />
                        </div>
                    </div>
                </form>
        </div>
        <!-- Cart page button -->
        <div align="right" class="col-lg-2 col-md-2" style="margin-left:-70px!important">
            <ul class="item">
                <li style="list-style:none">
                    <div align="right" id="cartToHover" class="box_1">
                        <a href="cart/cart.php">
                            <span id="cartItems" class="notify-badge"><?= $cartItems ?></span>
                            <i class="fa fa-shopping-cart" style="font-size:30px;"></i>
                        </a>
                    </div>
                    <div id="cartDivHover" class="cart-hover">
                        
                        <div id="cartDivHover2" class="cart-items"></div>

                        <div class="cart-total mt-2" style='background-color:#fff'>
                            <span>total:</span><span style="color: #e7ab3c;float: right;margin-left:10px"> $</span>
                            <h5 id="cartTotalPrice"><?= $cartTotalPrice ?></h5>
                            <br>
                        </div>
                        <div class="select-button" style='background-color:#fff'>
                            <a href="<?php echo BASE_URL . 'cart/cart.php' ?>" class="btn btn-lg btn-dark">VIEW CARD</a>
                            <a href="<?php echo BASE_URL . 'cart/checkout.php' ?>" class="btn btn-lg btn-info mt-2">CHECK OUT</a>
                        </div>
                    </div>
                </li><span>$ </span>
                <li class="cart-price"  id="cartTotalPrice2"><?= $cartTotalPrice ?></li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid " style="background-color:#eee">
    <!-- Cart button -->

                
    <!---Filter---->
    <br>
    <div>
        <select id="PageSize" name="PageSize"  class="form-control form-control-sm " style="width:100px;float:right">
        <option <?php if ($PageSize == 4 ) echo 'selected' ; ?> value="4">4</option>
        <option <?php if ($PageSize == 8 ) echo 'selected' ; ?> value="8">8</option>
        <option <?php if ($PageSize == 16 ) echo 'selected' ; ?> value="16">16</option>
        </select>
    </div>
    <br><br>
</div>
<!---1---->



<div class="container-fluid content">
    <div class="row "> 

        <div class="col-12 col-md-2 menu" style="width:200px;background-color:#ffffff!important; ">
            <div class="card cart-responsive">
                <?php if (isset($_GET['cid'])) {?>
                    <p style="font-weight: bold" class="mt-3 text-center card-header">Sub Gategories </p>
                    <?php foreach ($subcategories as $subcategory) { ?>
                    <div class="card-content">
                            <a href="<?php echo BASE_URL . 'index.php?subcid='?><?= $subcategory->getId() ?>"  class="list-group-item list-group-item-action">
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
                            <a href="<?php echo BASE_URL . 'index.php?cid='?><?= $category->getId() ?>"  >
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
                            <div class="card mr-2 mb-2 cart-responsive article single-banner" style="width:260px;height:440px!important;float:left;background-color:#ffffff!important;">
                                <img  class="img-fluid rounded mt-4 mb-4" src="<?php echo BASE_URL . 'view/images/'?><?= $Product['imagee']; ?>" alt="">
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
                    
                    <div class="card mr-2 mb-2 cart-responsive article single-banner" style="width:240px;height:460px!important;float:left;background-color:#ffffff!important;">
                        <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product->getId(); ?>">
                            <img  class="img-fluid rounded mt-4 mb-4" src="<?php echo BASE_URL . 'view/images/'?><?= $Product->getImagee(); ?>" alt="">
                        </a>
                        <div class="card-body">
                            <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product->getId(); ?>">
                                <h5 class="card-title text-center"><?= $Product->getTitle();  ?></h5>
                                <div  class="card-text mt-2 text-center "  style="height:45px">
                                    <small class="text-muted">
                                        <?php echo substr($Product->getArticle() ,0 ,75);?>
                                        <?php if(strlen($Product->getArticle()) > 75){?>
                                        <a href="<?php echo BASE_URL . 'article/view_one_artikel.php?id='?><?= $Product->getId(); ?>">...</a>
                                        <?php } ?>
                                    </small> 
                                </div>
                            </a>
                            <div class="mt-4 ">
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
                                <a id="addButtonBlock" class="btn btn-info btn-sm" style="margin-top:-50px; font-size:9px"
                                onclick="addToCart(<?= $Product->getId() . "," . $Product->getPrice() ?>)" >
                                    <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd <i class="fas fa-shopping-cart"></i>
                                </a>
                            </div>
                                
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

