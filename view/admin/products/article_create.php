<?php
require '../../../config.php';

require_once (ROOT_PATH . '/controlle/admin/articles/create_article_controller.php');

require (ROOT_PATH . '/view/elements/head_section.php');
?>


<div class="container" style='width:50%; margin-top:95px'>
<h1>Add New Article</h1><br /><br />
    <?php  foreach($errors as $error){ ?>
        <p class="text-danger"><?= $error ?></p>
    <?php } ?>

  <form method="post" action='article_create.php' enctype="multipart/form-data">
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

    <!---Price-->
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="Name">Price</label>
          <input type="number" name="price" step="0.01" placeholder="Price" min="0" maxlength="100000000" class="form-control" required/>
      </div>
      <div class="form-group col-md-6">
        <label for="Name">Discount</label>
          <input type="number" name="discount" step="0.01" placeholder="discount %" min="0" maxlength="100000000" class="form-control col-md-6"/>
      </div>
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
      <a class='btn  btn-secondary' href='#' onclick="goBack()"><i class='fa fa-arrow-left' ></i> Zurück</a>
    </div>

  </form>
</div>



<script>
// Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
</script>

<?php include(ROOT_PATH . '/view/elements/footer.php') ?>