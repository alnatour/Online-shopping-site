<?php


class SpecificationDb
{

    //Make Singleton
    private static $instance;
    private $pdo;

    const CREATE_SPECI    = "INSERT INTO specification (weight, stock, color, user_id ) VALUES (?,?,?)";

    const GET_ALL_SPECI   = "SELECT * FROM specification";

    const GET_SPECI_BY_ID  = "SELECT * FROM specification WHERE id=? ";
    
    const GET_SPECI_WITH_PRODUCT = "SELECT * FROM specification s
                            LEFT JOIN products_tb p ON p.specification_id = s.id WHERE p.id = ?";

    const UPDATE_SPECI    = "UPDATE specification set comment= ? WHERE product_id = ? AND user_id = ? ";
    
    const DELETE_SPECI = "DELETE FROM specification WHERE id = ?" ;

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }
    //make Instance echo '<pre>'; print_r($review);die;
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new SpecificationDb();
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

    
    function GetSpeciWithProduct($pid)
    {

        $statement = $this->pdo->prepare(self::GET_SPECI_WITH_PRODUCT);
        $statement->execute(array($pid));
        $specification = $statement->fetch(PDO::FETCH_ASSOC);

        return $specification;
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

    /**Delete Comment */
    function DeleteReview(Reviews $reviews){
        $statement = $this->pdo->prepare(self::DELETE_REVIEWS);
        $statement->execute(array($reviews->getId()));  
    }

}