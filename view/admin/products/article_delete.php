<?php

require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$id = $_GET['id'];
$artikeldb = ArticleDb::getInstance();
$view_item = $artikeldb->GetByid($id);

$title = $view_item->getTitle();

if (isset($_POST['submit_delete'])) {
    $artikelinfo = new ArticleInfo();
    $artikelinfo->setId($id);
    
    $ok = $artikeldb->deleteAddress($artikelinfo);
        echo 'Der Artikel wurde gelöscht.';
        header('Refresh: 1; ../index.php');

}


require (ROOT_PATH . '/view/elements/head_section.php');
?>
<div class='container text-center' style="background-color:#e6eaeb; border-radius:180px;margin-bottom: 314px;margin-top: 150px" >
    <i class="fa fa-remove mt-4 mb-4" style="color:red; font-size:72px"></i>


    <h4> Do you really want to delete these articles? &quot;<?=$title;?>&quot; </h4>

    <form method="post" action='article_delete.php?id=<?=$id;?>' class='mt-4'>
        <input  type="submit" class="btn btn-primary" name="submit_delete" value="Delete" />
        <a class='btn  btn-danger' href="<?php echo BASE_URL . 'view/admin/admin_panel.php' ?>" >Cancel</a>
    </form>
    <br /> <br />
</div>


<?php include(ROOT_PATH . '/view/elements/footer.php') ?>