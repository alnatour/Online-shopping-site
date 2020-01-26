<?php
require '../include.php';

$CategoryDb = CategoriesDb::getInstance();
$subCategoryDb = SubCategoriesDb::getInstance();
$allCategories = $CategoryDb->getAllCategories();

//echo '<pre>';print_r($allCategories);die();
if (isset($_POST['submit'])) {

    $Category = new Category();
    $Category->setName($_POST['category']);
    
    $neuCategory = $CategoryDb->createCategory($Category);
    header('location: ../article/posts.php');

}

if (isset($_POST['submit_sub'])) {

    $SubCategory = new SubCategory();

    $SubCategory->setName(htmlentities($_POST['subcategory']));
    $SubCategory->setCategoryId(htmlentities($_POST['category_id']));
    
    $neuSubCategory = $subCategoryDb->createSubCategory($SubCategory);
    header('location: ../article/posts.php');
}




include(ROOT_PATH . '/header.php');
?>


<html>

<body>

<div class="container" style='margin-top:95px'>
    <div align="center">
        <form method="post" action='creatCategory.php' class="col-5" >
            <h3 align="center"> Creat Neu Category</h3><br>
            <input type="text" name="category" class="form-control"><br>
            <input type="submit" name="submit" value="Creat" class="btn btn-primary">
        </form>
    </div>
</div>

<div class="container" style='margin-top:95px'>
    <div align="center">
        <form method="post" action='creatCategory.php' class="col-5" >
            <h3 align="center"> Creat Neu Sub Category</h3><br>
            <input type="text" name="subcategory" class="form-control"><br>

            <select name="category_id"  class='form-control col-6' required>
            <option  disabled selected value="">Choose Category</option>
            <?php
            foreach ($allCategories as $category) {
                echo "<option  value=\"" . $category->getId() . "\">" . $category->getName() . "</option>";
            }
            ?>
        </select><br>

            <input type="submit" name="submit_sub" value="Creat" class="btn btn-primary">
        </form>
    </div>
</div>

<?php include(ROOT_PATH . '/footer.php') ?>

</body>
</html>