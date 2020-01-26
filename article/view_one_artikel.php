<?php
require '../include.php';

$id = $_GET['id'];
$Articledb = ArticleDb::getInstance();
$article = $Articledb->GetByid($id);


$contact_id = $article->getContactId();


$GetAuthors = $Articledb->GetContactID($contact_id);

/* Comment */


require '../header.php';
?>

<div style='margin-top:60px' >
</div>

  <!-- Page Content -->
<div class="container">

    <div class="row d-flex justify-content-center">

      <!-- article Content Column -->
      <div class="col-8">

        <!-- Title -->
        <h1 class="mt-4"><?= $article->getTitle(); ?></h1>

        <!-- Author -->
        <p class="lead mt-4">
          
          <small>by <a style="color:blue"><?= $GetAuthors->getFirstname(); ?> <?= $GetAuthors->getLastname(); ?></a></small>

          <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
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
    <div class="row d-flex justify-content-center">
        <!-- Preview Image -->
        <div class="col-4">
            <img class="img-fluid rounded" src="../view/images/<?= $article->getImagee(); ?>" alt="" width = '900px' >
        </div>
          <!-- article Content Column -->
        <div class="col-4">
          <p ><?= $article->getarticle(); ?></p>
        </div>
    </div>

  </div>
</div>

<br><br><br><br>
<div  align="center" style='margin-bottom:76px' >
<a class='btn  btn-danger mt-4' href="<?php echo BASE_URL . 'index.php' ?>"><i class='fa fa-arrow-left' ></i> Zurück</a>
</div>


<?php include(ROOT_PATH . '/footer.php') ?>