<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="<?php echo BASE_URL . 'view/css/index_css.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'view/css/artikel.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'view/css/cart.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'view/css/header.css'?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'view/css/styles.css'?>">
    
    <!-- <link rel="stylesheet" href="view/css/footer.css">-->

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Kontakte verwalten</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap core CSS MDB-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/ScrollToPlugin.min.js"></script>

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>


  <script type="text/javascript">
      $(document).ready(function(){ /* PREPARE THE SCRIPT */
        $("#PageSize").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
          var Pagesize = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
         
          $.ajax({ /* THEN THE AJAX CALL */
            type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
            url: "ajax.php", /* PAGE WHERE WE WILL PASS THE DATA */
            data:{"PageSize": Pagesize}, /* THE DATA WE WILL BE PASSING */
            success: function(response){ /* GET THE TO BE RETURNED DATA */
              $("#postsdiv").html(response);
              //window.location.reload();
              console.log(response);
              /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
            },
          });
        }); 

         $("#category").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
          var cid = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
         
          $.ajax({ /* THEN THE AJAX CALL */
            type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
            url: "‏‏ajax_category.php", /* PAGE WHERE WE WILL PASS THE DATA */
            data:{"cid": cid}, /* THE DATA WE WILL BE PASSING */
            success: function(response){ /* GET THE TO BE RETURNED DATA */
             $("#subCategory").html(response);
             console.log(response);
              /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
            },
          });
        });  

      });
  </script>




          <!-- Script for adding product to favourites -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'view/js/favourites.js'?>"></script>
    <!-- Cart JS -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'view/js/cart/add.cart.js'?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . 'view/js/cart/add.cart.js'?>"></script>
    <!-- Cart Hover JS -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'view/js/cart/cart.hover.js'?>"></script>

    <script type="text/javascript" src="<?php echo BASE_URL . 'view/js/cart/remove.cart.js'?>"></script>
    <!-- Script for controlling cart quantity -->
    <script type="text/javascript" src="<?php echo BASE_URL . 'view/js/cart/quantity.cart.js'?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>


    <style>
      .single-banner:hover::before {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
      }

      .single-banner::before {
        position: absolute;
        left: 50px;
        top: 75px;
        border: 13px solid #ffffff;
        content: "";
        opacity: 0.3;
        width: calc(100% - 100px);
        height: calc(40% - 100px);
        -webkit-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.5s;
      }

    </style>
</head>
<body>
<div class="fixed-top">
  <nav class="navbar navbar-expand-lg  navbar-dark btn-group-toggle bg-primary" >
    <a class="navbar-brand" href="<?php echo BASE_URL . 'index.php' ?>">
    <img src="<?php echo BASE_URL . 'public/img/logo-carousel/logo.png' ?>" height='40px'></a>
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

          <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Contacts Panel
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo BASE_URL . 'Contacts/contact_Sql/index.php' ?>">Contacts SQL</a>
              <a class="dropdown-item" href="<?php echo BASE_URL . 'Api/ApiAddress/index.php' ?>">Contacts API</a>
              <a class="dropdown-item" href="<?php echo BASE_URL . 'Contacts/contact_Api/index.php' ?>">Contacts SQL+API</a>
              <a class="dropdown-item" href="<?php echo BASE_URL . 'Api/ApiArticle/InsertArticleApi.php' ?>">Article API</a>
            </div>
          </li>
          <?php } ?>

      </ul>

      <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
  
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL . 'contact_with_us/contact.php' ?>"><i class="fas fa-envelope" ></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
              </li> 
                <?php if (!isset($_SESSION['user'] )) { ?>
                        <li class="nav-item support"><a href="<?php echo BASE_URL . 'registration/register.php' ?>" class="nav-link"><i class="fa fa-registered"></i> Register</a> </li>
                        <li class="nav-item support"><a href="<?php echo BASE_URL . 'registration/login.php' ?>" class="nav-link"><i class="fa fa-user"></i> Login</a> </li>
                  <?php  } ?>
    
                    <?php if( isset($_SESSION['user']) ) { ?>
                      <li class="nav-item support"><a class="nav-link bg-white">Welcom <?php echo $_SESSION['user']->getLastname()?></a> </li>
                      <li class="nav-item support"><a href="<?php echo BASE_URL . 'article/posts.php'?>" class="nav-link"> Admin Plan</a></li>
                      <li class="nav-item support"><a href="<?php echo BASE_URL . 'registration/log_out.php' ?>" class="nav-link">LogOut</a></li>
                  <?php } ?>
            </ul>
      </div>
  </nav>
</div>

<?php if ($feedback != '') { ?>
    <div class="alert alert-danger d-flex justify-content-center" style="margin-top:200px"><?=$feedback;?></div>
<?php } ?> 
