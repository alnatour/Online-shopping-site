<?php


class Connection {

    //Make Singleton
    private static $instance;
    private $pdo;


    //Make connection between server and database
    private function __construct() {

            $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=kontakte', 'root', '');

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
