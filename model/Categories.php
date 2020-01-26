<?php


class Categories
    {
    private static $instance;
    private $pdo;

    const CHECK_USER_EXIST  = "SELECT * FROM categories";


    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Register();
        }
        return self::$instance;
    }
    
    function GetAllUsers()
    {
        $sql = self::GET_ALL_USERS;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $categories = $statement->fetchAll();
        return $categories;
    }
}
