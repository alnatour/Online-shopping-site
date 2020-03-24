<?php

require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$id = $_GET["id"];
$subCategoryDb = SubCategoriesDb::getInstance();
$subcategory_show = $subCategoryDb->getSubCategoryById($id);

if (isset($_POST["submit_delete"])) {

    $delete_subcategory = $subCategoryDb->deleteSubCategory($id);
                $_SESSION['message'] = array("Subcategory has been Deleted");
                header('location: '.BASE_URL.'view/admin/topics/topics_view.php');

}


require (ROOT_PATH . '/view/elements/head_section.php');
?>
<div class='container text-center' style="background-color:#e6eaeb; border-radius:180px;margin-bottom: 314px;margin-top: 150px" >
    <i class="fa fa-remove mt-4 mb-4" style="color:red; font-size:72px"></i>


    <h4> Do you really want to delete these Category?&quot; <?= $subcategory_show['name'];?> &quot;</h4>

    <form method="post" action='subcategories_delete.php?id=<?= $id; ?>' class='mt-4'>
        <input  type="submit" class="btn btn-primary" name="submit_delete" value="Delete" />
        <a class='btn  btn-danger' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Back</a>
    </form>
    <br /> <br />
</div>


<?php include(ROOT_PATH . '/view/elements/footer.php') ?>