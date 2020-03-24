<?php


class ReviewsDb
{

    //Make Singleton
    private static $instance;
    private $pdo;

    const GET_ALL_COMMENT   = "SELECT * FROM reviews";

    const GET_REVIEW_BY_ID  = "SELECT * FROM reviews WHERE id=? ";
    
    const CREATE_COMMENT    = "INSERT INTO reviews (rating, comment, product_id, user_id, created_at ) VALUES (?,?,?,?, NOW())";

    const UPDATE_COMMENT    = "UPDATE reviews set comment= ? WHERE product_id = ? AND user_id = ? ";

    const GET_ALL_RATINGS   = "SELECT AVG(r.rating) average  FROM reviews r WHERE r.product_id = ?";
    
    const GET_RATINGS_FOR_PRODUCT = "SELECT r.*, u.firstname, u.lastname FROM reviews r 
                            LEFT JOIN users u ON u.id = r.user_id
                            LEFT JOIN products_tb p ON r.product_id = p.id WHERE p.id = ?";

    const GET_REVIEWS_WITH_AUTHOR = "SELECT r.*, u.firstname, u.lastname, u.email FROM reviews r 
                            LEFT JOIN users u ON u.id = r.user_id";

    const DELETE_REVIEWS = "DELETE FROM reviews WHERE id = ?" ;

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }
    //make Instance echo '<pre>'; print_r($review);die;
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ReviewsDb();
        }

        return self::$instance;
    }

    function CreateComment($rating_user, $comment="", $pid, $uid)
    {
        $statement = $this->pdo->prepare(self::CREATE_COMMENT);
        $statement->execute(array($rating_user, $comment, $pid, $uid));
    }

    function GetAllComment(){
        $statement = $this->pdo->prepare(self::GET_ALL_COMMENT);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_CLASS, Reviews::class);
        return $comments;
    }

    function GetReviewByid($id){
        $statement = $this->pdo->prepare(self::GET_REVIEW_BY_ID);
        $statement->execute(array($id));
        $review = $statement->fetchObject(Reviews::class);
        return $review;
    }

    /**
     * Function for getting Average Ratings reviews.
     * @return array - Returns Average Ratings reviews as associative array.
     */
    function UpdateComment($comment, $pid, $uid)
    {
        $statement = $this->pdo->prepare(self::UPDATE_COMMENT);
        $statement->execute(array($comment, $pid, $uid));
    }

    function GetRatingsForProduct($pid)
    {

        $statement = $this->pdo->prepare(self::GET_RATINGS_FOR_PRODUCT);
        $statement->execute(array($pid));
        $ratings = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $ratings;
    }

    /**
     * Function for getting Average Ratings reviews.
     * @return array - Returns Average Ratings reviews as associative array.
     */
    function getAverageRatingsForProduct($pid)
    {
        $statement = $this->pdo->prepare(self::GET_ALL_RATINGS);
        $statement->execute(array($pid));
        $ratings = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $ratings;
    }

    /**
     * relationship
     * Get All Comments with Authors
     */

    function GetAllCommentsWithAuthor($page, $PageSize){
        $sql=self::GET_REVIEWS_WITH_AUTHOR;
        $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    /**Delete Comment */
    function DeleteReview(Reviews $reviews){
        $statement = $this->pdo->prepare(self::DELETE_REVIEWS);
        $statement->execute(array($reviews->getId()));  
    }

}