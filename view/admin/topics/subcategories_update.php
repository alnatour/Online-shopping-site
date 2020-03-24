<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$id =$_GET['id'];
$CategoryDb = CategoriesDb::getInstance();
$subCategoryDb = SubCategoriesDb::getInstance();

$allCategories = $CategoryDb->getAllCategories();
$subcategory_show = $subCategoryDb->getSubCategoryById($id);

if (isset($_POST['submit'])) {

    $subCategory = new SubCategory();

    $subCategory->setName($_POST['subcategory']);
    $subCategory->setCategoryId($subcategory_show['category_id'] );
    $subCategory->setId($_GET['id']);
    
    $neuSubcategory = $subCategoryDb->editSubCategory($subCategory);
                $_SESSION['message'] = array("Subcategory has been Updated");
                header('location: '.BASE_URL.'view/admin/topics/topics_view.php');
}

require (ROOT_PATH . '/view/elements/head_section.php');
?>


<html>

<body>
<div style="height:70px"></div>
<div class="container" style='margin-top:50px'>
    <div align="center">
        <form method="post" action='subcategories_update.php?id=<?= $id ?>' class="col-5" >
            <h3 align="center"> Create Neu Sub Category</h3><br>

            <label for="">Select Category</label>
            <select name="category_id"  class='form-control col-6' required>
                <option  disabled selected value="">Choose Category</option>
                <?php
                foreach ($allCategories as $category) {
                    $selected = ($category->getId() == $subcategory_show['id']) ? ' selected="selected"' : '';
                    echo "<option  value=\"" . $category->getId() . "\" '.$selected.'>" . $category->getName() . "</option>";
                }
                ?>
            </select><br>
            
            <input type="text" name="subcategory" class="form-control" value="<?= $subcategory_show['name']?>"><br>

            <a class='btn  btn-danger' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Back</a>
            <input type="submit" name="submit" value="Update" class="btn btn-primary">
        </form>
    </div>
</div>

<div style="height:70px"></div>
<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
