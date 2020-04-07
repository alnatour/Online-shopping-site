<?php
//counter Visitor
require (ROOT_PATH . '/view/elements/counter.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Abdul Shopping</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" href="<?php echo BASE_URL . 'public/assets/ico/logo.png'?>"  sizes="50x50" type="image/x-icon">

    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/index_css.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/artikel.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/cart.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/header.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/styles.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/style.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/single.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/assets/css/font-awesome.min.css'?> ">

    <!-- Script jquery -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/jquery.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/jquery-ui.min.js'?>"></script>
    
    <!-- Script Bootstrap -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/bootstrap.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/popper.min.js'?>"></script>

    <!-- add to Cart -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/cart/add_cart.js'?>"></script>
    <!-- Cart Hover JS -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/cart/cart_hover.js'?>"></script>
    <!--remove article from Cart -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/cart/remove_cart.js'?>"></script>
    <!-- Script for controlling cart quantity -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/cart/quantity_cart.js'?>"></script>
    <!-- Script ajax for page Size -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/ajax/page_size.js'?>"></script>
    <!-- Script ajax for categories -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/ajax/categories.js'?>"></script>
  
    <!-- Script Scroll von navbar to Section in Page -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/ScrollToPlugin.min.js'?>"></script>
    <!-- Script Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>

    <!-- Script Img zoom for Single Page -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/jquery.ez-plus.js'?>"></script>

</head>
<body>
<div class="fixed-top">
  <nav class="navbar navbar-expand-lg  navbar-dark btn-group-toggle bg-primary p-2" >
    <a class="navbar-brand" href="<?php echo BASE_URL . 'index.php' ?>">
    <img src="<?php echo BASE_URL . 'public/uploads/profileImage/logo/logo_alnatour.png' ?>" height='40px'></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo BASE_URL . 'index.php'?>">Home <span class="sr-only"></span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link"  href="<?php echo BASE_URL . 'index.php' ?>">Articles</a>
          </li>
      </ul>

      <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
  
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL . 'view/main/contact_us/contact.php' ?>"><i class="fa fa-envelope" ></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
              </li> 
                <?php if (!isset($_SESSION['user'] )) { ?>
                        <li class="nav-item support"><a href="<?php echo BASE_URL . 'view/user/register.php' ?>" class="nav-link"><i class="fa fa-registered"></i> Register</a> </li>
                        <li class="nav-item support"><a href="<?php echo BASE_URL . 'view/user/login.php' ?>" class="nav-link"><i class="fa fa-user"></i> Login</a> </li>
                  <?php  } ?>
    
                    <?php if( isset($_SESSION['user']) ) { ?>
                      <li class="nav-item support"><a class="nav-link">Welcom <?php echo $_SESSION['user']->getLastname()?></a> </li>
                      <li class="nav-item support" style="display:none"><a href="<?php echo BASE_URL . 'view/admin/admin_panel.php'?>" class="nav-link"> Admin Panel</a></li>
                      <li class="nav-item support" style="display:<?php if($_SESSION['user']->getRole() !== 'admin'){echo 'none';} ?>"><a href="<?php echo BASE_URL . 'view/admin/dashboard.php'?>" class="nav-link"> dashboard</a></li>
                      <li class="nav-item support"><a href="<?php echo BASE_URL . 'view/user/log_out.php' ?>" class="nav-link">LogOut</a></li>
                  <?php } ?>

                  <li class="nav-item">
                  <?php require (ROOT_PATH . '/view/elements/cart.php') ?>
                </li>
            </ul>
      </div>
  </nav>
</div>

<?php if ($feedback != '') { ?>
    <div class="alert alert-danger d-flex justify-content-center" style="margin-top:200px"><?=$feedback;?></div>
<?php } ?> 
