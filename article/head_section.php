
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="../view/css/index_css.css">
    <link rel="stylesheet" href="../view/css/artikel.css">
    
    <!-- <link rel="stylesheet" href="view/css/footer.css">-->

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
-->
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
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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



    <link rel="stylesheet" href="../view/css/cart.css">
          <!-- Script for adding product to favourites -->
    <script type="text/javascript" src="../view/js/favourites.js"></script>
    <!-- Cart JS -->
    <script type="text/javascript" src="../view/js/cartOnePage/add.cart.js"></script>
    <!-- Cart Hover JS -->
    <script type="text/javascript" src="../view/js/cartOnePage/cart.hover.js"></script>

    <script type="text/javascript" src="../view/js/cartOnePage/remove.cart.js"></script>
    <!-- Script for controlling cart quantity -->
    <script type="text/javascript" src="../view/js/cartOnePage/quantity.cart.js"></script>

    <style>
      body{
        font-family: "Museo Sans W01_300",Times,sans-serif;
        font-size: 16px;
      }

    
      .parallax-contact {
        /* The image used */
        background-image: url("https://marketpeima.com/wp-content/uploads/%D8%A8%D8%A7%D8%B2%D8%A7%D8%B1%DB%8C%D8%A7%D8%A8%DB%8C-%D9%85%D8%B3%D8%AA%D9%82%DB%8C%D9%85-1.jpg");
        /* Set a specific height */
        min-height: 400px; 

        /* Create the parallax scrolling effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .parallax-artikel {
        /* The image used */
        background-image: url("https://marketpeima.com/wp-content/uploads/%D8%A8%D8%A7%D8%B2%D8%A7%D8%B1%DB%8C%D8%A7%D8%A8%DB%8C-%D9%85%D8%B3%D8%AA%D9%82%DB%8C%D9%85-1.jpg");
        /* Set a specific height */
        min-height: 300px; 

        /* Create the parallax scrolling effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }

      @media only screen and (max-width: 1020px)  {
            .hidden{
              display:none;
            }
          }
      @media only screen and (max-width: 451px)  {
        .cart-responsive{
          width:90%!important;
          margin-left:5% !important;
          margin-top:5px !important;
        }
      }

      .remove{
        display:none;
      }
      #pagination{
        float:left;
      }
      .page-active{
        background-color: #4285f4;
        color : #fff;
        border-radius :5px;
      }
      .inner {
        min-width: 850px;
        margin: auto;
        padding-top: 68px;
        padding-bottom: 48px;
        background: url("https://www.utshockey.org/wp-content/uploads/2015/11/RegisterNow_small.jpg"); }
      .inner h3 {
        text-transform: uppercase;
        font-size: 22px;
        font-family: "Muli-Bold";
        text-align: center;
        margin-bottom: 32px;
        color: #333;
        letter-spacing: 2px; }
        
      @import url('https://fonts.googleapis.com/css?family=Numans');
      
      .card{
        height: auto;
        margin-top: auto;
        margin-bottom: auto;
        width: auto;
        background-color:#ffffff!important;
      }
      .support{
        float:right
      }
      .nav-item a{
        color:white
      }
      .nav-link .active {
        background-color: #4285f4!important;
      }
      .hover-navbar a:hover  {
        border-radius :5px;
        margin-top:10px;
				padding-bottom: 5px; background: #ccc; transition: 0.1s;
			}

      .content .menu .card .card-content a {
          display: block;
          box-sizing: border-box;
          padding: 8px 10px;
          border-bottom: 1px solid #e4e1e1;
          color: #444;
        }
        .content .menu .card .card-content a:hover {
          padding-left: 20px; background: #ccc; transition: 0.1s;
        }

    </style>


</head>
<body>

<nav class="navbar navbar-expand-lg  navbar-dark fixed-top btn-group-toggle bg-primary" >
  <a class="navbar-brand" href="<?php echo BASE_URL . 'index.php' ?>">
  <img src='#' height='40px'></a>
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
                      <li class="nav-item support"><a href="<?php echo BASE_URL . 'registration/register.php' ?>" class="nav-link">Register</a> </li>
                      <li class="nav-item support"><a href="<?php echo BASE_URL . 'registration/login.php' ?>" class="nav-link">Login</a> </li>
                 <?php  } ?>
  
                  <?php if( isset($_SESSION['user']) ) { ?>
                    <li class="nav-item support"><a class="nav-link bg-info">Welcom <?php echo $_SESSION['user']->getLastname()?></a> </li>
                    <li class="nav-item support"><a href="<?php echo BASE_URL . 'article/posts.php'?>" class="nav-link"> Admin Plan</a></li>
                    <li class="nav-item support"><a href="<?php echo BASE_URL . 'registration/log_out.php' ?>" class="nav-link">LogOut</a></li>
                <?php } ?>
          </ul>
    </div>
</nav>


<?php if ($feedback != '') { ?>
    <div class="alert alert-danger d-flex justify-content-center" style="margin-top:200px"><?=$feedback;?></div>
<?php } ?> 
