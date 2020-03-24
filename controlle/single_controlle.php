<?php
$articledb = ArticleDb::getInstance();
$reviewsdb = ReviewsDb::getInstance();
$CategoriesDb = CategoriesDb::getInstance();

$categories = $CategoriesDb->getAllCategories();

$id = $_GET['id'];

/* Get Article with Id */
$article = $articledb->GetArticleByid($id);
//echo '<pre>'; print_r($article);die();

if(empty($article)){
    header('Location: '.BASE_URL.'index.php');
    die;
}
if(isset($_SESSION['user'])){
    $contact_id = $article['contact_id'];
    $GetAuthors = $articledb->GetContactID($contact_id);

    /* get Average Ratings For Product */
    $user_id = $_SESSION['user']->getId() ;
    $rating = $articledb->viewRating($user_id, $id);
}

/** GET Ratings for PRODUCT*/
$ratings="";
$AverageRatingsforproduct="";
$ratings = $reviewsdb->GetRatingsForProduct($id);
$AverageRatingsforproduct = $reviewsdb->getAverageRatingsForProduct($id);

/** GET RELATED PRODUCTS*/
$most_articles = $articledb->getRelated($article['category_id']);
?>