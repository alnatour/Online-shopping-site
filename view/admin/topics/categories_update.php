<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$id =$_GET['id'];
$categoryDb = CategoriesDb::getInstance();
$category_show = $categoryDb->getCategoryById($id);

if (isset($_POST['submit'])) {

    $category = new Category();
    $category->setId($_GET['id']);
    $category->setName($_POST['category']);
    
    $neuCategory = $categoryDb->editCategory($category);
    $_SESSION['message'] = array("Category has been Updated");
    header('location: '.BASE_URL.'view/admin/topics/topics_view.php');

}


require (ROOT_PATH . '/view/elements/head_section.php');
?>


<html>

<body>
<div style="height:70px"></div>

<div class="container">
    <div align="center">
        <form method="post" action='Categories_update.php?id=<?= $id; ?>' class="col-5" >
            <h3 align="center"> Create Neu Category</h3><br>
            <input type="text" name="category" class="form-control" value="<?= $category_show->getName();?>"><br>
            <a class='btn  btn-danger' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Back</a>
            <input type="submit" name="submit" value="Update" class="btn btn-primary">

        </form>
    </div>
</div>

<div style="height:70px"></div>

<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
