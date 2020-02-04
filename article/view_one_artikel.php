<?php
require '../include.php';
require_once (ROOT_PATH . "/controlle/cart/cart_navi_controller.php");

$id = $_GET['id'];
$Articledb = ArticleDb::getInstance();
$article = $Articledb->GetByid($id);


$contact_id = $article->getContactId();


$GetAuthors = $Articledb->GetContactID($contact_id);

/* Comment */


require 'head_section.php';
?>

<div style='margin-top:100px' >
</div>
    <!-- Cart button -->
    <div class="container-fluid">
    <div class="header_right col-2" style="float: right;margin-top: 1em;position: relative;">

        <!-- Cart page button -->
        <div id="cartToHover" class="cart box_1" style="height:60px;">
            <a href="../cart/cart.php">
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

  <!-- Page Content -->
<div class="container" style="background-color: #f0f0f0;">

    <div class="row d-flex justify-content-center">

      <!-- article Content Column -->
      <div class="col-8">
        <!-- Author -->
        <p class="lead mt-4">
        <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
            <small>by <a style="color:blue"><?= $GetAuthors->getFirstname(); ?> <?= $GetAuthors->getLastname(); ?></a></small>
              <div align="right">
                <a class=" text-warning"href="<?php echo BASE_URL . 'article/EditArticle.php?id='?><?php echo $article->getId() ?>"> Edit 
                  <i class="fa fa-edit text-warning ml-1"></i>
                </a>
              </div>
          <?php } ?>
        </p>
        <hr>
        <!-- Date/Time -->
        <small><p>Posted on <?= $article->getDatum(); ?></p></small>
        <hr>
        
    </div>
    <div class="row d-flex justify-content-center" >
        <!-- Preview Image -->
        <div class="col-5" style="border:1px solid #ccc;background-color: #ffffff" >
            <img id="zoom_mw" class="img-fluid rounded zoom-img" src="../view/images/<?= $article->getImagee(); ?>" alt="" width = '900px' data-zoom-image="../view/images/<?= $article->getImagee(); ?>">
        </div>
          <!-- article Content Column -->
        <div class="col-4 details" id="details" style="border:1px solid #ccc;background-color: #ffffff;">
            <!-- Title -->
          <h3 class="mt-4"><?= $article->getTitle(); ?></h3>
          <h6><?= $article->getArticle(); ?></h6>

          <span class="mt-1">
              <i class="fas fa-star text-muted"></i>
              <i class="fas fa-star text-muted"></i>
              <i class="fas fa-star text-muted"></i>
              <i class="fas fa-star text-muted"></i>
              <i class="fas fa-star text-muted"></i>
          </span>

          <div class="mt-1">
            <span class="text-success"><small>
              Versand innerhalb von 48 Stunden</small>
            </span>
          </div>

          <div class="mt-4">
            <h4>
              <span class="price__currency">EUR</span>
              <span class="price__int"><?= $article->getPrice(); ?>
            </h4>
            </span>
          </div>

          <div class="mt-4">
            <small>
              <span class="price__subtext">Inkl. Abgaben und zzgl. 
                <u>
                  <b>
                    <a href="#">Versand- und Servicekosten</a>
                  </b>
                </u>
                .
                <br>
                Alle Infos dazu finden Sie auf unserer  
                <u><b><a href="#">Service-Seite</a></b></u>.
              </span>
            </small>
          </div>

          <div class="mt-4">
          <div align="right" class="mb-2">
                <a id="addButtonBlock" class="btn btn-info btn-sm" style="margin-top:-25px; font-size:9px"
                onclick="addToCart(<?= $article->getId() . "," . $article->getPrice() ?>)" >
                    <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd to cart <i class="fas fa-shopping-cart"></i>
                </a>

          </div>
        </div>

      </div>
  </div>

  <br><br>
  <div  align="center" style='margin-bottom:76px' >
      <a class='btn  btn-danger mt-4' href="<?php// echo BASE_URL . 'index.php' ?>" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Zurück</a>
  </div>
</div>




<script>
    $('#zoom_mw').ezPlus({
        scrollZoom: true
    });

</script>


<?php include(ROOT_PATH . '/footer.php') ?>