<?php
require '../include.php';
require_once (ROOT_PATH . "/controlle/cart/cart_navi_controller.php");

$id = $_GET['id'];
$Articledb = ArticleDb::getInstance();
$article = $Articledb->GetByid($id);

$contact_id = $article->getContactId();

// Rating
if(isset($_SESSION['user']) )
{
  $user_id = $_SESSION['user']->getId() ;
  $rating = $Articledb->viewRating($user_id, $id);
}


$GetAuthors = $Articledb->GetContactID($contact_id);

/* Comment */


require (ROOT_PATH . "/header.php");
?>

<div style='margin-top:100px' >
</div>
    <!-- Cart button -->
    <div class="container-fluid">
 <div  class="row justify-content-end mb-4" id="Cart-button" >
        <div class="header_right " style="margin-top: 10em;position: absolute;width:180px">

            <!-- Cart page button -->
            <ul class="item">
                <li style="list-style:none">
                <div align="right" id="cartToHover" class="box_1">
                    <a href="../cart/cart.php">
                        <span id="cartItems" class="notify-badge"><?= $cartItems ?></span>
                        <i class="fa fa-shopping-cart" style="font-size:30px;"></i>
                    </a>
                </div>
                <div id="cartDivHover" class="cart-hover">
                    
                    <div id="cartDivHover2" class="cart-items"></div>

                    <div class="cart-total" style='background-color:#fff'>
                        <span>total:</span>$
                        <h5 id="cartTotalPrice"><?= $cartTotalPrice ?></h5>
                        <br>
                    </div>
                    <div class="select-button" style='background-color:#fff'>
                        <a href="cart/cart.php" class="btn btn-dark">VIEW CARD</a>
                        <a href="cart/checkout.php" class="btn btn-info">CHECK OUT</a>
                    </div>
                </div>
                </li>$
                <li class="cart-price"  id="cartTotalPrice2"><?= $cartTotalPrice ?></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
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
    </div>
    <div class="row d-flex justify-content-center" >
        <!-- Preview Image -->
        <div class="col-5" style="border:1px solid #ccc;background-color: #ffffff" >
            <img id="zoom_mw" class="img-fluid rounded zoom-img" src="<?php echo BASE_URL . 'view/images/'?><?= $article->getImagee(); ?>" alt="" width = '900px' data-zoom-image="<?php echo BASE_URL . 'view/images/'?><?= $article->getImagee(); ?>">
        </div>
          <!-- article Content Column -->
        <div class="col-4 details" id="details" style="border:1px solid #ccc;background-color: #ffffff;">
            <!-- Title -->
          <h3 class="mt-4"><?= $article->getTitle(); ?></h3>
          <h6><?= $article->getArticle(); ?></h6>

          <div id ="fa-star">
            <span class="mt-1">
              <?php if (isset($rating)) {
                  for ($i = 1 ; $i <=  5 ; $i++){
                    if($i <= $rating ){?>
                      <i class="fa fa-star text-muted text-success" data-index="<?= $i ?>"></i>
                    <?php } ?>
                    <?php if($i > $rating ){?>
                      <i class="fa fa-star text-muted" data-index="<?= $i ?>"></i>
                    <?php }
                  }
                } else { 
                  for ($i = 1 ; $i <=  5 ; $i++){?> 
                    <i class="fa fa-star text-muted" data-index="<?= $i ?>"></i>
                <?php }} ?>
            </span>
          </div>



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
      <a class='btn  btn-danger mt-4' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Zurück</a>
  </div>
</div>




<script>
    $('#zoom_mw').ezPlus({
        scrollZoom: true
    });

</script>

  <script type="text/javascript">
    $(document).ready(function(){ /* PREPARE THE SCRIPT */
      $(".fa-star").click(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
        var rating = $(this).data('index');
        var user_id = <?= $_SESSION['user']->getId() ?>;
        var product_id = <?=$_GET['id']?>;
        $.ajax({ /* THEN THE AJAX CALL */
          type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
          url: "http://localhost/xampp/2020/20.11.2019%20Produkts/kontakte_verwalten/controlle/ratingAjax.php", /* PAGE WHERE WE WILL PASS THE DATA */
          data:{"rating": rating, 'user_id':user_id, 'product_id':product_id}, /* THE DATA WE WILL BE PASSING */
          success: function(response){ /* GET THE TO BE RETURNED DATA */
            $("#fa-star").html(response);
            window.location.reload();
            console.log(response);
            /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
          },
        });
      }); 
    });
  </script>

<?php include(ROOT_PATH . '/footer.php') ?>