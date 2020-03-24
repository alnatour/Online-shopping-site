<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$CategoryDb = CategoriesDb::getInstance();
$allCategories = $CategoryDb->getAllCategories();

if (isset($_POST['submit'])) {

    $Category = new Category();
    $Category->setName($_POST['category']);
    
    $neuCategory = $CategoryDb->createCategory($Category);
    $_SESSION['message'] = array("Category has been Created");
    header('location: '.BASE_URL.'view/admin/topics/topics_view.php');

}


require (ROOT_PATH . '/view/elements/head_section.php');
?>


<html>

<body>
<div style="height:70px"></div>

<div class="container">
    <div align="center">
        <form method="post" action='Categories_create.php' class="col-5" >
            <h3 align="center"> Create Neu Category</h3><br>
            <input type="text" name="category" class="form-control"><br>
            <a class='btn  btn-danger' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Back</a>
            <input type="submit" name="submit" value="Create" class="btn btn-primary">

        </form>
    </div>
</div>

<div style="height:70px"></div>

<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
