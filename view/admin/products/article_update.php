<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');
require (ROOT_PATH . '/controlle/admin/articles/edit_article_controller.php');
require (ROOT_PATH . '/view/elements/head_section.php');
?>


<div class="container" style='width:50%; margin-top:100px'><br />
    <h2>Article Update</h2><br />
    <?php  foreach($errors as $error){ ?>
        <p class="text-danger"><?= $error ?></p>
    <?php } ?>

        <form method="post" action='article_update.php?id=<?= $id; ?>' enctype="multipart/form-data">

        <div class="search-box form-group">
        <label ><b>The Author</b></label>
            <select name="Authors" size="1" class="form-control">
                <option value="0" selected="selected">Select Author</option>
                <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3)){
                    if (! empty($Users)) {
                      foreach ($Users as $user) {
                        $selected = ($user->getId() == $article->getContactId()) ? ' selected="selected"' : '';
                        echo '<option value="' . $user->getId() . '"'.$selected.'>' .$user->getFirstname() . ' ' . $user->getLastname() . '</option>';
                      }
                    }
                  }
                  if(isset($_SESSION['user'])){
                        $selected = ($_SESSION['user']->getId() == $article->getContactId()) ? ' selected="selected"' : '';
                        echo '<option value="' . $_SESSION['user']->getId() . '"'.$selected.'>' .$_SESSION['user']->getFirstname() . ' ' . $_SESSION['user']->getLastname() . '</option>';

                  }
                ?>
            </select>
        </div>

        <div class="form-group">
          <label for="Name"><b>Title</b></label>
          <input type="name" class="form-control inputstl" name='title' value="<?= $article->getTitle()  ?>">
        </div>    

         <!---Price-->
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="Name">Price</label>
              <input type="number"  value="<?= $article->getPrice()  ?>" name="price" step="0.01" placeholder="Price" min="0" maxlength="100000000" class="form-control" required/>
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Discount</label>
              <input type="number" value="<?= $article->getDiscount()  ?>" name="discount" step="0.01" placeholder="discount %" min="0" maxlength="100000000" class="form-control col-md-6"/>
          </div>
        </div>

        <!---Categories-->
        <div class="form-group">
            <label >Select Category</label>
            <select class="form-control custom-select" name="category" id="category">
            <option  disabled selected value="">Choose Category</option>
              <?php  foreach ($categories as $category) {  
                $selected = ($category->getId() == $sections['category_id']) ? ' selected="selected"' : '';
                echo '<option value="' . $category->getId() . '" '.$selected.'>' .$category->getname(). '</option>';
                }?>
            </select>
        </div>
        <!---Ende Categories-->

        <!---sub Categories-->
        <div class="form-group">
            <label >Select Sub Category</label>
            <select id="subCategory" class="form-control custom-select" name="subCategory" >
              <option  disabled selected value="">Choose Category</option>
              <?php 
                if ( isset($sub_categories[0])){ 
                foreach ($sub_categories as $subcategory) {  
                  $selected = ($subcategory->getId() == $sections['subcategory_id']) ? ' selected="selected"' : ''; 
                  echo '<option value="' . $subcategory->getId() . '" '.$selected.'>' .$subcategory->getname(). '</option>';
              } }?>
            </select>
        </div>
        <!---Ende subCategories-->


            <div class="form-group btn btn-outline-danger btn-rounded waves-effect btn-lg float-left">
              <label for="Name">Image Auswählen</label>
              <input type="file" class="form-control inputstl waves-effect btn-lg btn" name='image'>
            </div><br /><br /><br /><br /><br />
            <div class="form-group">
              <label for="Email1msg"><b>Message:</b></label><br />
              <textarea rows="12" name = 'article' class="form-control"><?= $article->getArticle()  ?></textarea>
          <!-- Add textarea here -->
            </div>
            
            <div  align="center" class="mb-4 mt-4">
              <input type="submit" name='submit_update' class="btn btn-info" value='Submit Update'>
              <a class='btn  btn-danger' href="<?php echo BASE_URL . 'view/admin/admin_panel.php' ?>" ><i class='fa fa-arrow-left' ></i> Back</a>
            </div>
        </form>
</div>


<?php include(ROOT_PATH . '/view/elements/footer.php') ?>