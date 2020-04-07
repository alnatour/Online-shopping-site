<?php


class AdressesDb
{

    //Make Singleton
    private static $instance;
    private $pdo;

    const GET_ADDRESS_BY_USER_ID  = "SELECT * FROM adresses WHERE user_id=? ";

    const CREATE_ADDRESS    = "INSERT INTO adresses (user_id, country, state, zip, address ) VALUES (?,?,?,?,?)";
    
    const UPDATE_ADDRESS    = "UPDATE adresses set country= ?, state=?, zip=?, address=? WHERE user_id = ?";


    const GET_ALL_COMMENT   = "SELECT * FROM reviews";
    
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
            self::$instance = new AdressesDb();
        }

        return self::$instance;
    }


    function GetAddressUser($user_id)
    {

        $statement = $this->pdo->prepare(self::GET_ADDRESS_BY_USER_ID);
        $statement->execute(array($user_id));
        $address = $statement->fetchObject(Address::class);
        return $address;
    }

    function CreateAddress(Address $address)
    {
        $statement = $this->pdo->prepare(self::CREATE_ADDRESS);
        $statement->execute(array(
            $address->getUser_id(),
            $address->getCountry(),
            $address->getState(),
            $address->getZip(),
            $address->getAddress()

        ));
    }

    function UpdateAddress(Address $address)
    {
        $statement = $this->pdo->prepare(self::UPDATE_ADDRESS);
        $statement->execute(array(
            $address->getCountry(),
            $address->getState(),
            $address->getZip(),
            $address->getAddress(),
            $address->getUser_id(),
        ));
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