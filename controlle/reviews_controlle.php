<?php
require '../config.php';

$Articledb = ArticleDb::getInstance();
$reviewsdb = ReviewsDb::getInstance();

/* Reviews  Rating && comment*/
if(isset($_SESSION['user']) )
{
  $pid = $_POST['pid'];
  $user_id = $_SESSION['user']->getId() ;
  $rating2 = $Articledb->viewRating($user_id, $pid);
    if(empty($rating2)){
        if(isset($_POST['comment_submit'])) {
            $rating_user = "1";
            $comment = $_POST['comment'];
            $update_comment = $reviewsdb->CreateComment($rating_user, $comment, $pid, $user_id);
            header('location: '.BASE_URL.'view/main/single.php?id='.$pid.'');
        }
    }elseif (isset($_POST['comment_submit'])) {
        $comment = $_POST['comment'];
        $update_comment = $reviewsdb->UpdateComment($comment, $pid, $user_id);
        header('location: '.BASE_URL.'view/main/single.php?id='.$pid.'');
    }
}


?>