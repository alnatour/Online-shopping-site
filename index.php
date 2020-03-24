<?php

require 'config.php';

require (ROOT_PATH . '/controlle/index_controlle.php');

require (ROOT_PATH . '/view/elements/head_section.php');
?>


<!---Logo Img---->
<div class ="smooth">
    <div class="parallax-artikel"  style="margin-top:50px">
        <br><br><br><br><br><br><br><br><br>
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

<!--logo && Search && Cart page button -->
<div class="container-fluid " style="background-color:#ffffff!important; ">
    <div  class="row">
        <div class="col-lg-3 col-md-3">
            <div class="logo">
                <a href="<?php echo BASE_URL . 'index.php' ?>">
                    <img src="<?php echo BASE_URL . 'public/assets/img/logo-carousel/logo.png' ?>" alt="" width="80%">
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
        <div align="right" class="col-lg-2 col-md-2" style="margin-left:-70px!important">
            <ul class="item">
                <li style="list-style:none">
                    <div align="right" id="cartToHover" class="box_1">
                        <a href="<?php echo BASE_URL . 'view/main/cart/cart.php'?>">
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
                            <a href="<?php echo BASE_URL . 'view/main/cart/cart.php' ?>" class="btn btn-lg btn-dark">VIEW CARD</a>
                            <a href="<?php echo BASE_URL . 'view/main/cart/checkout.php' ?>" class="btn btn-lg btn-info mt-2">CHECK OUT</a>
                        </div>
                    </div>
                </li style="float: left"><span class="ml-1">$ </span>
                <li class="cart-price"  id="cartTotalPrice2" ><?= $cartTotalPrice ?></li>
            </ul>
        </div>
    </div>
</div>


<!---MOST RECENT ARTICLES---->
<div align="center" class="">
    <p>
        <br>
        <h4>Most Recent Products</h4>
    </p>
    <?php include(ROOT_PATH . '/view/main/recent_product.php') ?>
</div>

<!--- content index ---->
<div class="container content" style="background-color:#ffffff!important; ">

    <!--- breadcrumb ---->
    <div class="row">
        <?php include(ROOT_PATH . '/view/elements/breadcrumb.php') ?>
    </div>
    <!--- end breadcrumb ---->

    <div class="row "> 

        <div class="col-12 col-md-3 menu" style="background-color:#ffffff!important; ">
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
                
                if (empty($_GET) || isset($_GET['page'])){ ?>
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

        <div class="col-12 col-md-9 mt-4" >
            <!---Products per page---->
            <div class="row">
                <div class="container-fluid ml-3" style="background-color:#eee">
                    <br>
                    <div align="right">
                        <label for="" class="mr-2"><small>Products per page</small> </label>
                        <select id="PageSize" name="PageSize"  class="form-control form-control-sm " style="width:100px;float:right">
                        <option <?php if ($PageSize == 6 ) echo 'selected' ; ?> value="6">6</option>
                        <option <?php if ($PageSize == 9 ) echo 'selected' ; ?> value="9">9</option>
                        <option <?php if ($PageSize == 15 ) echo 'selected' ; ?> value="15">15</option>
                        </select>
                    </div>
                    <br>
                </div>
            </div>
            <div class="row" id="postsdiv">
                <!---1 with  cid---->
                <?php if(isset($_GET['cid'])){ ?>
                    
                        <?php foreach ($Products as $Product) { ?>

                            <div class="col-12 col-md-4 menu  single-banner mb-4" style="float:left;background-color:#ffffff!important;">
                                <div class="card cart-responsive article">
                                    
                                    <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $Product['id']; ?>">
                                        <img  class="img-fluid rounded mt-1 mb-4" src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?= $Product['imagee']; ?>" alt="">
                                    </a>
                                    <div class="card-body">
                                        <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $Product['id']; ?>">
                                            <h6 class="card-title text-center"><?= $Product['title'];  ?></h6>
                                            <div  class="card-text mt-2 text-center "  style="height: 60px!important;">
                                                <small class="text-muted">
                                                    <?php echo substr($Product['article'] ,0 ,75);?>
                                                    <?php if(strlen($Product['article']) > 75){?>
                                                    <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $Product['id']; ?>">...</a>
                                                    <?php } ?>
                                                </small> 
                                            </div>
                                        </a>
                                    </div>
                                    
                                    <div class="card-footer bg-transparent mt-2"style="height:70px" >
                                        <div class="pd-rating">  
                                        <?php
                                        $AverageRatingsforproduct = $reviewsdb->getAverageRatingsForProduct($Product['id']);
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

                                        <div class="row"> 
                                            <div style="width:50%; float:left">
                                                <span  style="font-size:14px!important">
                                                    <?= $Product['price']; ?> € 
                                                </span>
                                            </div>

                                            <div align="right" style="width:50%;">
                                                <a id="addButtonBlock" class="btn btn-sm btn-outline-primary" style="font-size:12px"
                                                onclick="addToCart(<?= $Product['id'] . ',' . $Product['price'] ?>)" >
                                                    <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd <i class="fa fa-shopping-cart" style="font-size:16px"></i>
                                                </a>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                            </div>

                        <?php }?>
                <?php }

                //--- 2 without GET ----
                else {?> 
                    
                        <?php foreach ($Products as $Product) { ?>
                            
                            <div class="col-12 col-md-4 menu  single-banner mb-4" style="float:left;background-color:#ffffff!important;">
                                <div class="card cart-responsive article">
                                    
                                    <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $Product->getId(); ?>">
                                        <img  class="img-fluid rounded mt-1 mb-4" src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?= $Product->getImagee(); ?>" alt="">
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
                                        <div class="row ml-1"> 
                                            <div style="width:50%; float:left">
                                                <span class="mb-2">
                                                    <?= $Product->getPrice(); ?> € 
                                                </span>
                                            </div>
                                            <div align="right" style="width:50%">
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
                <?php }?>
            </div>
        </div>

    </div>
    <br><br><br><br>
</div>



<?php include(ROOT_PATH . '/view/elements/pages.php') ?>

<br><br><br>

<?php include(ROOT_PATH . '/view/elements/footer.php') ?>

