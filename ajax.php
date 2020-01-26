<?php
require 'include.php';

$userDb = RegisterRepository::getInstance();
$articledb = ArticleDb::getInstance();

(isset($_POST["PageSize"])) ? $PageSize = $_POST["PageSize"] : $PageSize=4;
$_SESSION['PageSize'] = $PageSize;

if(!isset($_GET['page']))
{
    $page = 1;
}else{
    $page =$_GET['page'];
   
}


if (isset($_GET['categorie'])) {
    $categorie = $_GET['categorie'];
    }else{
      $categorie = "";
}

$Articles_By_Categorie = $articledb->CountAllArtikels($categorie);

$GetArticlesWithAuthor = $articledb->GetArticlesWithAuthor($page, $PageSize, $categorie);

$total = $Articles_By_Categorie;
$PageCount = ceil($total/$PageSize);

?>

              


        <?php 
        foreach ($GetArticlesWithAuthor as $article_Author) {
          $user = $userDb->findById($article_Author->getContactId());
        ?>
            <div class="col-md-3 mt-1 pl-1 pr-1">
              <div class=" bg-white pl-2 pr-2">
                    <!-- Preview Image -->
                <div>
                    <a href="article/view_one_artikel.php?id=<?= $article_Author->getId(); ?>">
                    <img style="height: 172px;" class="img-fluid rounded mt-4 mb-4" src="view/images/<?= $article_Author->getImagee(); ?>" alt="" width="550px">
                    </a>
                </div>

                <!-- Title -->
                <h5><?= $article_Author->getTitle(); ?></h5>

                <!-- Author -->
                <div class="row mt-2">
                        <div class="col">
                            <small> by <a style="color:blue;text-transform: capitalize;"> <?= $article_Author->getFirstname(); ?> <?= $article_Author->getLastname(); ?></a></small>
                        </div>

                            <!-- edit & delete -->
                        <div class="col">
                            <?php if( (isset($_SESSION['role']) && ($_SESSION['role'] == 3)) || (isset($_SESSION['user']) and $_SESSION['user']->getId() == $user->getId())   ) { 
                                  ?>
                            <a  href ='article/EditArticle.php?id=<?= $article_Author->getId(); ?>'><i class="material-icons  col-sm-2" title="Edit">&#xE254; </i></a>
                          
                            <a href="article/delete.php?id=<?= $article_Author->getId(); ?>" style="color:red;"><i class="material-icons col-sm-2" title="Delete">&#xE872;</i></a>
                            <?php  }?>
                        </div>
                        <!-- end edit & delete -->
                </div>

                  <hr>
                  <!-- Date/Time -->
                  <a style="color: #77777F;"> <small>Posted on <?= $article_Author->getDatum(); ?> </small></a>
                  <hr>
                  <!-- Post Content -->
                  <p style="color:  #4d4d4d"><?php
                  echo substr(strip_tags($article_Author->getArticle()) ,0 ,130);?>
                  <?php if(strlen($article_Author->getArticle()) > 130){?>
                    <a href="article/view_one_artikel.php?id=<?= $article_Author->getId(); ?>">... Read More</a>
                    <?php } ?>
                  </p>
              </div>
            </div>
        <?php }?>