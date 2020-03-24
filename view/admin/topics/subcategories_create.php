<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$CategoryDb = CategoriesDb::getInstance();
$subCategoryDb = SubCategoriesDb::getInstance();
$allCategories = $CategoryDb->getAllCategories();

if (isset($_POST['submit'])) {

    $SubCategory = new SubCategory();

    $SubCategory->setName(htmlentities($_POST['subcategory']));
    $SubCategory->setCategoryId(htmlentities($_POST['category_id']));
    
    $neuSubcategory = $subCategoryDb->createSubCategory($SubCategory);
                $_SESSION['message'] = array("Subcategory has been Created");
                header('location: '.BASE_URL.'view/admin/topics/topics_view.php');
}

require (ROOT_PATH . '/view/elements/head_section.php');
?>


<html>

<body>
<div style="height:70px"></div>
<div class="container" style='margin-top:50px'>
    <div align="center">
        <form method="post" action='subcategories_create.php' class="col-5" >
            <h3 align="center"> Create Neu Sub Category</h3><br>

            <select name="category_id"  class='form-control col-6' required>
                <option  disabled selected value="">Choose Category</option>
                <?php
                foreach ($allCategories as $category) {
                    echo "<option  value=\"" . $category->getId() . "\">" . $category->getName() . "</option>";
                }
                ?>
            </select><br>
            
            <input type="text" name="subcategory" class="form-control"><br>

            <a class='btn  btn-danger' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Back</a>
            <input type="submit" name="submit" value="Create" class="btn btn-primary">
        </form>
    </div>
</div>

<div style="height:70px"></div>
<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
