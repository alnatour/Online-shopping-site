<?php
require '../include.php';
if(!isset($_SESSION['user']) )
{	// not logged in
    header('Location: '.BASE_URL.'index.php');
    die();
}
$edit ='';
$id = $_GET['id'];
$articledb = ArticleDb::getInstance();
$article = $articledb->GetByid($id);

$UsersDb = RegisterRepository::getInstance();
$Users = $UsersDb->GetAllUsers();


$CategoryDb = CategoriesDb::getInstance();
$categories = $CategoryDb->getAllCategories();

$SubCategoryDb = SubCategoriesDb::getInstance();
$SubCategories = $SubCategoryDb->getAllSubCategories();


$datum_update = date("F j, Y, h:i a");



if (isset($_POST['submit_update'])) {

    $article->setContactId($_POST['Authors']);
    $article->setTitle($_POST['title']);
    $article->setArticle($_POST['article']);
    $article->setUpdatedatum($datum_update);
    $article->setSubcategoryId($_POST['subCategory']);
    


  //image loading
  $uploads_dir = 'C:\xampp\htdocs\xampp\test\20.11.2019 Produkts\kontakte_verwalten/view/images';

  $filename = basename($_FILES["image"]["name"]);
  $filetype = $_FILES['image']['type'];
  $filetmp= $_FILES['image']['tmp_name'];
  //$filetmp= addslashes(file_get_contents($_FILES['image']['tmp_name']));

  $imagee = move_uploaded_file($filetmp, "$uploads_dir/$filename");

  //echo $imagee;die;
  $article->setImagee($filename);


  $edit = $articledb->editArticle($article);

    header('Location: ../index.php');

}

require '../header.php';
?>


<div class="container" style='width:50%; margin-top:100px'><br />
    <h2>Article Update</h2><br />

        <form method="post" action='EditArticle.php?id=<?= $id; ?>' enctype="multipart/form-data">

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


            <div class="form-group btn btn-outline-danger btn-rounded waves-effect btn-lg float-left">
              <label for="Name">Image Auswählen</label>
              <input type="file" class="form-control inputstl waves-effect btn-lg btn" name='image'>
            </div><br /><br /><br /><br /><br />
            <div class="form-group">
            <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
          //<![CDATA[
                  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
            //]]>
            </script>
              <label for="Email1msg"><b>Message:</b></label><br />
              <textarea rows="12" name = 'article' class="form-control"><?= $article->getArticle()  ?></textarea>
          <!-- Add textarea here -->
            </div>
            
            <div  align="center" class="mb-4 mt-4">
              <input type="submit" name='submit_update' class="btn btn-info" value='Submit Update'>
              <a class='btn  btn-danger' href="<?php echo BASE_URL . 'index.php' ?>"><i class='fa fa-arrow-left' ></i> Zurück</a>
            </div>
        </form>
</div>


<?php include(ROOT_PATH . '/footer.php') ?>