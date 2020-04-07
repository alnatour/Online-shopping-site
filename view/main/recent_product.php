
<head>
    <link href="<?php echo BASE_URL . 'public/assets/js/owl-carousel/owl.carousel.css'?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'public/assets/js/owl-carousel/owl.theme.css'?>" rel="stylesheet">
</head>
<style>
        #owl-demo .owl-item2{
        margin: 3px;
        }
        #owl-demo .owl-item2 img{
        display: block;
        width: 100%;
        height: auto;
        }
        .owl-carousel .owl-item2{
            float: left;
        }
        .owl-page span{
            background-color:#007bff!important;
        }
</style>

<div id="demo">
    <div class="container ">
        <div class="row">
        <div class="span12 col-12">
            <div id="owl-demo" class="owl-carousel">
                <?php foreach($most_articles as $article){ ?>
                    <div class="owl-item2">
                        <a href="<?php echo BASE_URL . 'view/main/single.php?id='?><?= $article->getId(); ?>">
                            <img src="<?php echo BASE_URL . 'public/uploads/productImages/'?><?= $article->getImagee(); ?>" alt="">
                            <?php if(!empty($article->getDiscount())){ ?>
                                <span class="discount"><?= $article->getDiscount();  ?>%</span>
                            <?php } ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        </div>
    </div>
</div>


    <script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
        autoPlay: 3000,
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]
      });

    });
    </script>

<script type="text/javascript" src="<?php echo BASE_URL . 'public/assets/js/owl-carousel/owl.carousel.js'?>"></script>