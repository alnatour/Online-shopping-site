<?php
require '../config.php';

class RatingDb
    {
    private static $instance;
    private $pdo;
    
    const SAVE_RATING   = "INSERT INTO reviews (rating, user_id , product_id,created_at ) VALUES (?, ?, ?,NOW())";

    const GET_RATING_BY_USERID  = "SELECT * FROM reviews WHERE user_id = ? and product_id = ? ";
 
    const UPDATE_RATING  = "UPDATE reviews set rating = ? where id = ? ";


    //Get connection in construct
 private function __construct()
 {
     $this->pdo = Connection::getInstance()->getConnection();
 }

 public static function getInstance()
 {
     if (self::$instance === null) {
         self::$instance = new RatingDb();
     }
     return self::$instance;
 }

 function setRating($rating, $user_id, $product_id)
 {
    $statement = $this->pdo->prepare(self::SAVE_RATING);
    $statement->execute(array($rating, $user_id, $product_id));
 }
 function viewRating($user_id, $product_id)
 {
    $statement = $this->pdo->prepare(self::GET_RATING_BY_USERID);
    $statement->execute(array($user_id, $product_id));
    $rating = $statement->fetch(PDO::FETCH_ASSOC);
   // echo "<pre>";print_r($rating['rating']);die;
    return $rating;
 }
 function updateRating($ratingIndex, $ratingId)
 {
    $statement = $this->pdo->prepare(self::UPDATE_RATING);
    $statement->execute(array($ratingIndex, $ratingId));
 }
}


$user_id = $_POST['user_id'];
$product_id = $_POST['product_id'];
$rating = $_POST['rating'];
$ratingdb = RatingDb::getInstance();
$viewRating = $ratingdb->viewRating($user_id, $product_id);


//echo "<pre>";print_r($rating);die;
if( $viewRating > 0 ){
    $ratingId = $viewRating['id'];
    $updateRating = $ratingdb->updateRating($rating, $ratingId);
}else{
    $saveRating = $ratingdb->setRating($rating, $user_id, $product_id);
}

?>
    <?php if ($viewRating > 0) {
        for ($i = 1 ; $i <=  5 ; $i++){
            if($i <= $rating ){?>
                <i id="star" class="rating-star fa fa-star text-warning" data-index="<?= $i ?>"></i>
            <?php } 
            
            if($i > $rating ){?>
                <i id="star" class="rating-star fa fa-star text-muted" data-index="<?= $i ?>"></i>
            <?php }
        }
    } else { 
        for ($i = 1 ; $i <=  5 ; $i++){?> 
        <i id="star" class="rating-star fa fa-star text-muted" data-index="<?= $i ?>"></i>
        <?php }
    } ?>