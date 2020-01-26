<?php
require '../include.php';

$articledb = ArticleDb::getInstance();

$CategoryDb = CategoriesDb::getInstance();
$categories = $CategoryDb->getAllCategories();

//$SubCategoryDb = SubCategoriesDb::getInstance();
//$SubCategories = $SubCategoryDb->getAllSubCategories();
//$subcategories = $SubCategoryDb->getSubCategoryByCategoryid($cid);

$UsersDb = RegisterRepository::getInstance();
$Users = $UsersDb->GetAllUsers();

//echo'<pre>';print_r($SubCategories);die();

$datum = date("F j, Y, h:i a");

if (isset($_POST['submit_insert'])) {

  $artikelinfo = new ArticleInfo();
  
  $artikelinfo->setContactId($_POST['Authors']);
  $artikelinfo->setTitle($_POST['title']);
  $artikelinfo->setArticle($_POST['article']);
  $artikelinfo->setDatum($datum);
  $artikelinfo->setSubcategoryId($_POST['subCategory']);


  //image loading
    $filename = basename($_FILES["image"]["name"]);
    $filetype = $_FILES['image']['type'];
    $filetmp= addslashes(file_get_contents($_FILES['image']['tmp_name']));
    
    $imagee = move_uploaded_file($filetmp, "images/$filename");

    $artikelinfo->setImagee($filename);

  $insert = $articledb->InsertNewArtikel($artikelinfo);

    header('location: ../index.php');

}


require '../header.php';
?>


<div class="container" style='width:50%; margin-top:95px'>
<h1>Artikal Einfügen</h1><br /><br />

  <form method="post" action='insertArticle.php' enctype="multipart/form-data">
    <div class="form-group">
    <label >Select Author</label>
    <select class="form-control custom-select" name="Authors" >

    <?php if(isset($_SESSION['role']) ) { 
            if (! empty($Users)) {
              foreach ($Users as $user) { 
                      echo '<option value="' . $user->getId() . '">' .$user->getFirstname(),' ', $user->getLastname() . '</option>';
                  }
              }
        }
        if(isset($_SESSION['loggedUser']) ) { 
            echo '<option value="' . $_SESSION['user']->getId() . '">' .$_SESSION['user']->getFirstname() ,' ', $_SESSION['user']->getLastname() . '</option>';
        }

          ?>
    </select>
    </div>
    <br />
    <div class="form-group">
      <label for="Name">Title</label>
      <input type="text" class="form-control inputstl" name='title'>
    </div>

        <!---Categories-->
        <div class="form-group">
        <label >Select Category</label>
        <select class="form-control custom-select" name="category" id="category">
        <option  disabled selected value="">Choose Category</option>
          <?php  foreach ($categories as $category) {  
            echo '<option value="' . $category->getId() . '">' .$category->getName(). '</option>';
            }?>
        </select>
    </div>

    <!---Ende Categories-->

    <!---sub Categories-->
    <div class="form-group">
        <label >Select Sub Category</label>
        <select id="subCategory" class="form-control custom-select" name="subCategory" >
          <option  disabled selected value="">Choose Category</option>


        </select>
    </div>

    <!---Ende subCategories-->

    <div class="form-group ">
      <label for="Name">Image Auswählen</label>
        <div class="btn btn-outline-danger btn-rounded waves-effect btn-lg float-left form-control" style="height:auto">
          <input type="file"name='image' class="btn">
        </div>
    </div><br /><br /><br /><br /><br />

    <div class="form-group" id="sample">
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
  //<![CDATA[
          bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    //]]>
    </script>
      <label for="Email1msg">Message:</label><br />
      <textarea rows="8" class="form-control" name = 'article'></textarea>
  </div>

    <div class="form-group">
      <input type="submit" name= 'submit_insert' class="btn btn-primary" value='Submit Insert'>
      <a class='btn  btn-secondary' href='http://localhost:8888/kontakte_verwalten/index.php'><i class='fa fa-arrow-left' ></i> Zurück</a>
    </div>

  </form>
</div>



<script>
// Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
</script>

<?php

require '../footer.php';
?>