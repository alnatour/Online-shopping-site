<?php

require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$id = $_GET["id"];
$reviews_db = ReviewsDb::getInstance();
$view_review = $reviews_db->GetReviewByid($id);

if (isset($_POST["submit_delete"])) {
    $reviews = new Reviews();
    $reviews->setId($id);
    
    $delete_comment = $reviews_db->DeleteReview($reviews);
        $_SESSION['message'] = array("comment has been deleted.");
        header('location: '.BASE_URL.'view/admin/reviews/reviews_view.php');

}


require (ROOT_PATH . '/view/elements/head_section.php');
?>
<div class='container text-center' style="background-color:#e6eaeb; border-radius:180px;margin-bottom: 314px;margin-top: 150px" >
    <i class="fa fa-remove mt-4 mb-4" style="color:red; font-size:72px"></i>


    <h4> Do you really want to delete these Reviews? &quot; <?= $view_review->getComment(); ?> &quot; </h4>

    <form method="post" action='review_delete.php?id=<?= $id; ?>' class='mt-4'>
        <input  type="submit" class="btn btn-primary" name="submit_delete" value="Delete" />
        <a class='btn  btn-danger' href="" onclick="goBack()"><i class='fa fa-arrow-left' ></i> Back</a>
    </form>
    <br /> <br />
</div>


<?php include(ROOT_PATH . '/view/elements/footer.php') ?>