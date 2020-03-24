<?php

require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$id = $_GET["id"];
$categoryDb = CategoriesDb::getInstance();
$category_show = $categoryDb->getCategoryById($id);

if (isset($_POST["submit_delete"])) {

    $delete_category = $categoryDb->deleteCategory($id);
                $_SESSION['message'] = array("Category has been Deleted");
                header('location: '.BASE_URL.'view/admin/topics/topics_view.php');

}


require (ROOT_PATH . '/view/elements/head_section.php');
?>
<div class='container text-center' style="background-color:#e6eaeb; border-radius:180px;margin-bottom: 314px;margin-top: 150px" >
    <i class="fa fa-remove mt-4 mb-4" style="color:red; font-size:72px"></i>


    <h4> Do you really want to delete these Category?&quot; <?= $category_show->getName();?> &quot;</h4>

    <form method="post" action='categories_delete.php?id=<?= $id; ?>' class='mt-4'>
        <input  type="submit" class="btn btn-primary" name="submit_delete" value="Delete" />
        <a class='btn  btn-danger' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Back</a>
    </form>
    <br /> <br />
</div>


<?php include(ROOT_PATH . '/view/elements/footer.php') ?>