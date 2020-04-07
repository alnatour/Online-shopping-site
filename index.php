<?php

require 'config.php';

require (ROOT_PATH . '/controlle/index_controlle.php');

require (ROOT_PATH . '/view/elements/head_section.php');

?>
<div style="height:66px"></div>
<!--logo && Search -->
<div class="container-fluid " style="background-color:#ffffff!important; ">
    <div  class="row">
        <div class="col-lg-3 col-md-3">
            <div class="logo">
                <a href="<?php echo BASE_URL . 'index.php' ?>">
                    <img src="<?php echo BASE_URL . 'public/uploads/profileImage/logo/logo_alnatour.png' ?>" alt="" width="50%">
                </a>
            </div>
        </div>
        <div class="col-lg-7 col-md-7 mt-4 ml-auto" style="margin-top:50px!important">
                <form method="post" action="index.php">
                    <div class="input-group ">
                        <input type="text" name="search" class="form-control col-8" placeholder="What do you need?" class="form-control" value="<?=$search;?>">
                        <div class="input-group-prepend">
                            <input type="submit" name="submit_search" value="Search" class="btn btn-outline-primary" />
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>

<!---Categori---->
<nav class="navbar navbar-expand-md bg-dark hover-navbar " style="background-color:#252525!important">
    <div class="container">
        <a class="navbar-brand" href="<?php echo BASE_URL . 'index.php' ?>">All Articles</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav " >
                <?php foreach ($categories as $category) { 
                if(isset($_GET['cid'])){
                $active = ($category->getId() == $_GET['cid']) ? ' page-active' : '';
                }?>
                <li style="padding:5px;border-left:1px solid #5a5a5a" class="nav-item  <?php if(isset($_GET['cid'])){echo $active;}?>">
                    <a class="nav-link" href="<?php echo BASE_URL . 'index.php?cid='?><?= $category->getId() ?>"><?= $category->getName() ?></a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>

<!---Logo Img; navbar Topics---->
<div class ="smooth">
    <div class="parallax-artikel" >
    <div style="height:150px"></div>
    </div>
</div>

<!---MOST RECENT ARTICLES---->
<div align="center" class="">
    <p>
        <h4>Most Recent Products</h4>
    </p>
    <?php include(ROOT_PATH . '/view/main/recent_product.php') ?>
</div>

<!--- content index ---->
<div class="container content" style="background-color:#ffffff!important; ">

    <!--- breadcrumb ---->
    <div class="row bg-secondary" style="height: 47.61px!important;">
        <?php include(ROOT_PATH . '/view/elements/breadcrumb.php') ?>
    </div>
    <!--- end breadcrumb ---->

    <div class="row "> 
        <!--- left Silder Categories ---->
        <div class="col-12 col-md-3 menu" style="background-color:#ffffff!important; ">
            <div class="filter-widget">
                <h4 class="fw-title mt-4">Categories</h4>
                <ul class="filter-catagories mt-4">
                <?php foreach ($categories as $category) {  
                    $subcatActiv = (isset($_GET['cid']) && $_GET['cid']== $category->getId()) ? ' page-active text-white' : ''; ?> 
                    <li>
                        <a class="<?=$subcatActiv?>" href="<?php echo BASE_URL . 'index.php?cid='?><?= $category->getId() ?>" style="letter-spacing: 3px;"><b><?= $category->getName() ?></b></a>
                        <ul class="filter-catagories">
                            <?php foreach ($subcategories as $subcategory) { 
                                if($category->getId() == $subcategory->getCategoryId()){
                                    $subcatActiv = (isset($_GET['subcid']) && $_GET['subcid']== $subcategory->getId()) ? ' page-active text-white' : ''; ?>
                                <li class="<?=$subcatActiv?>">
                                    <a style="padding-left:20px" class="<?=$subcatActiv?>" href="<?php echo BASE_URL . 'index.php?subcid='?><?= $subcategory->getId() ?>">
                                        <?= ucfirst($subcategory->getName()) ?>
                                    </a>
                                </li>
                            <?php  }} ?>
                        </ul>
                    </li>
                <?php } ?>
            </div>
        </div>

        <div class="col-12 col-md-9 mt-4" >
            <!---Products per page---->
            <div class="row">
                <div class="container-fluid ml-3" style="background-color:#eee">
                    <br>
                    <div align="right">
                        <label for="" class="mr-2"><small>Products per page</small> </label>
                        <select id="PageSize" name="PageSize"  class="form-control-sm ">
                        <option <?php if ($PageSize == 6 ) echo 'selected' ; ?> value="6">6</option>
                        <option <?php if ($PageSize == 9 ) echo 'selected' ; ?> value="9">9</option>
                        <option <?php if ($PageSize == 15 ) echo 'selected' ; ?> value="15">15</option>
                        </select>
                    </div>
                    <br>
                </div>
            </div>
            <!--- Right Silder Products ---->
            <div class="row" id="postsdiv">

                <!---1 with  cid---->
                <?php if(isset($_GET['cid'])){ ?>
                    
                        <?php foreach ($Products as $Product) { 
                            if(!empty($Product['discount'])){
                                $currentPrice= number_format( $Product['price']-(($Product['price']*$Product['discount'])/100), 2);
                            }else{
                                $currentPrice = $Product['price'];
                            }
                            ?>

                            <div class="col-12 col-md-4 menu  single-banner mb-4" style="float:left;background-color:#ffffff!important;">
                                <div class="card cart-responsive article">
                                    
                                    <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $Product['id']; ?>">
                                        <img  class="img-fluid rounded mt-1 mb-4" src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?= $Product['imagee']; ?>" alt="">
                                        <?php if(!empty($Product['discount'])){ ?>
                                            <span class="discount"><?= $Product['discount'];  ?>%</span>
                                        <?php } ?>
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
                                            <div style="width:65%; float:left" class="mt-2">
                                                <span class="mb-2 ml-1" <?php if(!empty($Product['discount'])){ ?> style="text-decoration: line-through;font-size:12px;color:#7E9AA6" <?php }?>>
                                                    <?= $Product['price']; ?> $ 
                                                </span>
                                                <?php if(!empty($Product['discount'])){ ?>
                                                    <span class="mb-2 ml-1" ><?= $Product['price']-(($Product['price']*$Product['discount'])/100); ?> $
                                                    </span>
                                                <?php }?>
                                            </div>

                                            <div align="right" style="width:35%;">
                                                <a id="addButtonBlock" class="btn btn-sm btn-outline-primary" style="font-size:12px"
                                                onclick="addToCart(<?= $Product['id'] . ',' . $currentPrice ?>)" >
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
                    
                        <?php foreach ($Products as $Product) { 
                            if(!empty($Product->getDiscount())){
                                $currentPrice= number_format( $Product->getPrice()-(($Product->getPrice()*$Product->getDiscount())/100), 2);
                            }else{
                                $currentPrice = $Product->getPrice();
                            }
                            ?>
                            
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
                                                    <span class="mb-2 ml-1" ><?= $currentPrice ?> $
                                                </span>
                                                <?php }?>
                                            </div>
                                            <div align="right" style="width:35%">
                                                <a id="addButtonBlock" class="btn btn-outline-primary" style="font-size:12px"
                                                onclick="addToCart(<?= $Product->getId() . ',' . $currentPrice ?>)" >
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

