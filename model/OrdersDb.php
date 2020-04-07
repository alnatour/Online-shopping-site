<?php


class OrdersDb
{

    //Make Singleton
    private static $instance;
    private $pdo;

    const ADD_NEW_ORDER         = "INSERT INTO orders (user_id, created_at, status) VALUES (?, now(), ?)";

    const CREATE_ORDER_PRODUCT  = "INSERT INTO order_products (order_id, product_id, quantity, created_at ) VALUES (?, ?, ?, now())";
    
    const GET_ORDER_BY_ID      = "SELECT * FROM orders WHERE id=? ";

    const GET_ORDER_PRODUCTS_BY_ORDER_ID = "SELECT * FROM order_products op 
                                        LEFT JOIN orders o ON o.id = op.order_id
                                        LEFT JOIN products_tb p ON p.id = op.product_id
                                        WHERE o.id=?
                                        ";

    const GET_ALL_ORDER       = "SELECT * FROM order_products op 
                                    LEFT JOIN orders o ON o.id = op.order_id
                                    LEFT JOIN products_tb p ON p.id = op.product_id";

    const UPDATE_COMMENT    = "UPDATE reviews set comment= ? WHERE product_id = ? AND user_id = ? ";

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
            self::$instance = new OrdersDb();
        }

        return self::$instance;
    }

    function newOrder(Order $order)
    {
        //create new order and get id
        $statement = $this->pdo->prepare(self::ADD_NEW_ORDER);
        $statement->execute(array(
            $order->getUser_id(),
            $order->getStatus()
        ));
        return $this->pdo->lastInsertId();
    }

    function CreateOrder(Order $order)
    {
        $statement = $this->pdo->prepare(self::CREATE_ORDER_PRODUCT);
        $statement->execute(array(
            $order->getOrder_id(),
            $order->getProduct_id(),
            $order->getQuantity(),
        ));
    }

    function GetOrderById($id){
        $statement = $this->pdo->prepare(self::GET_ORDER_BY_ID);
        $statement->execute(array($id));
        $order = $statement->fetchAll(PDO::FETCH_CLASS, Order::class);
        return $order;
    }

    function GetOrderProductsByOrderId($order_id)
    {

        $statement = $this->pdo->prepare(self::GET_ORDER_PRODUCTS_BY_ORDER_ID);
        $statement->execute(array($order_id));
        $OrderProducts = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $OrderProducts;
    }


    function GetAllOrder($page, $pageSize){
        $sql=self::GET_ALL_ORDER;
        $sql .= " LIMIT " . $pageSize . " OFFSET " . ($pageSize*($page-1));
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $orders;

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