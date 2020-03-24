<?php
require '../../config.php';
require_once (ROOT_PATH . "/controlle/cart/cart_navi_controller.php");

require (ROOT_PATH . '/controlle/single_controlle.php');

require (ROOT_PATH . '/view/elements/head_section.php');
?>

<!-- logo Img -->
<div class ="smooth">
    <div class="parallax-artikel"  style="margin-top:50px">
        <br><br><br><br><br><br><br><br><br>
        
    </div>
</div>

    <!-- Cart button -->
<div class="container-fluid">
    <div  class="row justify-content-end mb-4" id="Cart-button" >
        <div class="header_right " style=";position: absolute;width:180px">

            <!-- Cart page button -->
            <ul class="item">
                <li style="list-style:none">
                    <div align="right" id="cartToHover" class="cartToHoverSingle">
                        <a href="<?php echo BASE_URL . 'view/main/cart/cart.php'?>">
                            <span id="cartItems" class="notify-badge"><?= $cartItems ?></span>
                            <i class="fa fa-shopping-cart" style="font-size:30px;"></i>
                        </a>
                    </div>
                    <div id="cartDivHover" class="cart-hover">
                        
                        <div id="cartDivHover1" class="cart-items"></div>

                        <div class="cart-total mt-2" style='background-color:#fff'>
                            <span>total:</span><span style="color: #e7ab3c;float: right;margin-left:10px"> $</span>
                            <h5 id="cartTotalPrice"><?= $cartTotalPrice ?></h5>
                            <br>
                        </div>
                        <div class="select-button" style='background-color:#fff'>
                            <a href="<?php echo BASE_URL . 'view/main/cart/cart.php'?>" class="btn btn-lg btn-dark">VIEW CARD</a>
                            <a href="<?php echo BASE_URL . 'view/main/cart/checkout.php'?>" class="btn btn-lg btn-info mt-2">CHECK OUT</a>
                        </div>
                    </div>
                </li style="float: left"><span class="ml-1">$ </span>
                <li class="cart-price"  id="cartTotalPrice2" ><?= $cartTotalPrice ?></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>



<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
  <div class="container bg-white"  class="">
        <!--- breadcrumb ---->
        <div class="row">
            <?php include(ROOT_PATH . '/view/elements/breadcrumb.php') ?>
        </div>
        <!--- end breadcrumb ---->
      <div class="row pt-4 pl-4 pt-4">
          <div class="col-lg-3">
              <div class="filter-widget">
                  <h4 class="fw-title">Categories</h4>
                  <ul class="filter-catagories">
                        <?php foreach ($categories as $category) { ?>
                            <li>
                                <a  href="<?php echo BASE_URL . 'index.php?cid='?><?= $category->getId() ?>">
                                    <?= $category->getName() ?>
                                </a>
                            </li>
                        <?php }?>
                  </ul>
              </div>
              <div class="filter-widget">
                  <h4 class="fw-title">Brand</h4>
                  <div class="fw-brand-check">
                      <div class="bc-item">
                          <label for="bc-calvin">
                              Calvin Klein
                              <input type="checkbox" id="bc-calvin">
                              <span class="checkmark"></span>
                          </label>
                      </div>
                      <div class="bc-item">
                          <label for="bc-diesel">
                              Diesel
                              <input type="checkbox" id="bc-diesel">
                              <span class="checkmark"></span>
                          </label>
                      </div>
                      <div class="bc-item">
                          <label for="bc-polo">
                              Polo
                              <input type="checkbox" id="bc-polo">
                              <span class="checkmark"></span>
                          </label>
                      </div>
                      <div class="bc-item">
                          <label for="bc-tommy">
                              Tommy Hilfiger
                              <input type="checkbox" id="bc-tommy">
                              <span class="checkmark"></span>
                          </label>
                      </div>
                  </div>
              </div>
              <div class="filter-widget">
                  <h4 class="fw-title">Price</h4>
                  <div class="filter-range-wrap">
                      <div class="range-slider">
                          <div class="price-input">
                              <input type="text" id="minamount">
                              <input type="text" id="maxamount">
                          </div>
                      </div>
                      <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                          data-min="33" data-max="98">
                          <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                          <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                          <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                      </div>
                  </div>
                  <a href="#" class="btn btn-primary">Filter</a>
              </div>
              <div class="filter-widget">
                  <h4 class="fw-title">Color</h4>
                  <div class="fw-color-choose">
                      <div class="cs-item">
                          <input type="radio" id="cs-black">
                          <label class="cs-black" for="cs-black">Black</label>
                      </div>
                      <div class="cs-item">
                          <input type="radio" id="cs-violet">
                          <label class="cs-violet" for="cs-violet">Violet</label>
                      </div>
              
                  </div>
              </div>
              <div class="filter-widget">
                  <h4 class="fw-title">Size</h4>
                  <div class="fw-size-choose">
                      <div class="sc-item">
                          <input type="radio" id="s-size">
                          <label for="s-size">s</label>
                      </div>
                      <div class="sc-item">
                          <input type="radio" id="m-size">
                          <label for="m-size">m</label>
                      </div>
                      <div class="sc-item">
                          <input type="radio" id="l-size">
                          <label for="l-size">l</label>
                      </div>
                      <div class="sc-item">
                          <input type="radio" id="xs-size">
                          <label for="xs-size">xs</label>
                      </div>
                  </div>
              </div>
              <div class="filter-widget">
                  <h4 class="fw-title">Tags</h4>
                  <div class="fw-tags">
                      <a href="#">Towel</a>
                      <a href="#">Shoes</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-9">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="product-pic-zoom">
                          <img id="zoom_mw" class="product-big-img img-fluid rounded zoom-img" src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?= $article['imagee']; ?>" alt="">
                          <div class="zoom-icon">
                              <i class="fa fa-search-plus"></i>
                          </div>
                      </div>
                      <div class="product-thumbs">
                          <div class="product-thumbs-track ps-slider owl-carousel">
                              <div class="pt active" data-imgbigurl="<?php echo BASE_URL . 'public/uploads/productImages/'?><?=$article['imagee']; ?>">
                                  <img src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?=$article['imagee']; ?>" alt="" width="120">
                              </div>
                                    
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="product-details">
                          <div class="pd-title">
                              <span><?=$article['subcatname']?></span>
                              <h3><?= $article['title']; ?></h3>
                              <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                          </div>
                          <div class="pd-rating">  
                            <?php if (isset($AverageRatingsforproduct)) {
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
                          <div class="pd-desc">
                              <p><?= $article['article']; ?></p>
                              <h4>$<?= $article['price']; ?> <span><?= $article['price']; ?></span></h4>
                              <p><small>Incl. Taxes and plus shipping and service costs. <br>
                              You can find all information on our service page.</small></p>
                          </div>
                                
                          <div class="quantity">
                                <div class="number-input">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                    <input type="number" id="buyQuantity" min="1" name="quantity" value="1" onKeyDown="return false">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                </div>
                              <a href="" class="btn btn-primary btn-lg ml-2" onclick="addToCartSingle(<?= $article['id'] . ',' . $article['price'] ?>)">Add To Cart</a>
                          </div>
                          <ul class="pd-tags">
                              <li><span>CATEGORIES</span>: <?= $article['catname']?>, <?= $article['subcatname']?></li>
                          </ul>
                          <div class="pd-share">
                              <div class="p-code">Sku : 00012</div>
                              <div class="pd-social">
                                  <a href="#"><i class="fa fa-facebook"></i></a>
                                  <a href="#"><i class="fa fa-twitter"></i></a>
                                  <a href="#"><i class="fa fa-linkedin"></i></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="product-tab">
                  <div class="tab-item">
                      <ul class="nav" role="tablist">
                          <li>
                              <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                          </li>
                          <li>
                              <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                          </li>
                          <li>
                              <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews (<?= count($ratings) ?>)</a>
                          </li>
                      </ul>
                  </div>
                  <div class="tab-item-content">
                      <div class="tab-content">
                          <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                              <div class="product-content">
                                  <div class="row">
                                      <div class="col-lg-7">
                                          <h5>Introduction</h5>
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                              ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                              aliquip ex ea commodo consequat. Duis aute irure dolor in </p>
                                          <h5>Features</h5>
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                              ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                              aliquip ex ea commodo consequat. Duis aute irure dolor in </p>
                                      </div>
                                      <div class="col-lg-5">
                                          <img src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?=$article['imagee']; ?>" alt="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="tab-pane fade" id="tab-2" role="tabpanel">
                              <div class="specification-table">
                                  <table>
                                      <tr>
                                          <td class="p-catagory">Customer Rating</td>
                                          <td>
                                          <?php if (isset($AverageRatingsforproduct)) {
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
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="p-catagory">Price</td>
                                          <td>
                                              <div class="p-price">$<?= $article['price']; ?></div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="p-catagory">Add To Cart</td>
                                          <td>
                                              <div class="cart-add">+ add to cart</div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="p-catagory">Availability</td>
                                          <td>
                                              <div class="p-stock">22 in stock</div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="p-catagory">Weight</td>
                                          <td>
                                              <div class="p-weight">1,3kg</div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="p-catagory">Size</td>
                                          <td>
                                              <div class="p-size">Xxl</div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="p-catagory">Color</td>
                                          <td><span class="cs-color"></span></td>
                                      </tr>
                                      <tr>
                                          <td class="p-catagory">Sku</td>
                                          <td>
                                              <div class="p-code">00012</div>
                                          </td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                          <div class="tab-pane fade" id="tab-3" role="tabpanel">
                              <div class="customer-review-option">
                                  <h4><?= count($ratings) ?> Comments</h4>
                                  <div class="comment-option">
                                      <div class="co-item">
                                      <?php
                                          foreach($ratings as $ratingusers){ ?>
                                          <div class="avatar-pic">
                                              <img src="<?php echo BASE_URL . 'public/assets/img/product-single/avatar-1.png'?>" alt="">
                                          </div>
                                          <div class="avatar-text">
                                              <?php 
                                                for ($i = 1 ; $i <=  5 ; $i++){
                                                    if($i <= $ratingusers['rating'] ){?>
                                                      <i class="fa fa-star text-warning" data-index="<?= $i ?>"></i>
                                                    <?php } else{ ?>
                                                      <i class="fa fa-star text-muted" data-index="<?= $i ?>"></i>
                                                    <?php }
                                                } ?>
                                              <h5><?= $ratingusers['firstname']; ?> <?= $ratingusers['lastname']; ?><span>27 Aug 2019</span></h5>
                                              
                                              <?php if(isset($_SESSION['user'])){ 
                                                         if($ratingusers['user_id'] == $user_id) { ?>
                                                <a id="edit_comment" class="text-warning" style="float:right; cursor:pointer ">Edit</a> 
                                                <?php } } ?>
                                              <div class="at-reply" ><?= $ratingusers['comment']; ?> !</div>
                                              <?php 
                                                if(isset($_SESSION['user'])){
                                                if($ratingusers['user_id'] == $user_id) { ?>
                                                <div class="at-reply comment-form mt-4" style="display:none">
                                                    <h6 class="at-reply">Edit your Comment</h6>
                                                    <?php require (ROOT_PATH . '/view/main/comment_form.php') ?>
                                                </div>
                                             <?php }  }?>
                                          </div><hr>
                                          <?php }  ?>
                                      </div>
                                  </div>
                                  <div class="personal-rating">
                                      <h4>Your Rating</h4>
                                      <div class="pd-rating rating" id="rating-star2">  
                                          <?php if (isset($rating)) {
                                            for ($i = 1 ; $i <=  5 ; $i++){
                                              if($i <= $rating ){?>
                                                <i class="rating-star fa fa-star text-warning" data-index="<?= $i ?>"></i>
                                              <?php } ?>
                                              <?php if($i > $rating ){?>
                                                <i class="rating-star fa fa-star text-muted" data-index="<?= $i ?>"></i>
                                              <?php }
                                            }
                                          } else { 
                                            for ($i = 1 ; $i <=  5 ; $i++){?> 
                                              <i class="rating-star fa fa-star text-muted" data-index="<?= $i ?>"></i>
                                          <?php }} ?>
                                        </div>
                                  </div>

                                  <!-- Comment -->
                                  <?php if(isset($_SESSION['user'])){ 
                                      foreach($ratings as $ratingusers){ 
                                      ?>
                                    <div class="leave-comment" style="display:<?php if($ratingusers['user_id'] == $user_id && !empty($ratingusers['comment'])) {echo 'none'; }?> ">
                                        <h4>Leave A Comment</h4>
                                        <form action="<?php echo BASE_URL . 'controlle/reviews_controlle.php'?>" method="post" class="comment-form">
                                            <div class="row">
                                                <input type="hidden" name="pid" value="<?= $id ?>">
                                                <div class="col-lg-12">
                                                    <textarea placeholder="Messages" name="comment"></textarea>
                                                    <button type="submit" name="comment_submit" class="site-btn">Send message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                  <?php } } ?>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!---MOST RECENT ARTICLES---->
<div align="center" class="">
    <p>
        <br>
        <h4> Related Products</h4>
    </p>
    <?php include(ROOT_PATH . '/view/main/recent_product.php') ?>
</div>

 <br><br>
<div  align="center" style='margin-bottom:76px' >
    <a class='btn  btn-danger mt-4' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Back</a>
</div>

<script>
    $('#zoom_mw').ezPlus({
        scrollZoom: true
    });

</script>

  <script type="text/javascript">
    $(document).ready(function(){ /* PREPARE THE SCRIPT */
      $(".rating-star").click(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
        var rating = $(this).data('index');
        var user_id = <?= $_SESSION['user']->getId() ?>;
        var product_id = <?=$_GET['id']?>;
        $.ajax({ /* THEN THE AJAX CALL */
          type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
          url: "http://localhost/xampp/2020/20.11.2019%20Produkts/kontakte_verwalten/controlle/rating_ajax.php", /* PAGE WHERE WE WILL PASS THE DATA */
          data:{"rating": rating, 'user_id':user_id, 'product_id':product_id}, /* THE DATA WE WILL BE PASSING */
          success: function(response){ /* GET THE TO BE RETURNED DATA */
            $("#rating-star,#rating-star2").html(response);
            window.location.reload();
            console.log(response);
            /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
          },
        });
      }); 
    });
  </script>

<script>
    $( "#edit_comment" ).click(function() {
    $('.comment-form').toggleClass( "show-comment" );
    });
</script>

<?php require (ROOT_PATH . '/view/elements/footer.php') ?>