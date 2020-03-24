<?php


class RegisterRepository
    {
    private static $instance;
    private $pdo;

    const SQL_INSERT        = "INSERT INTO users (email, psw, firstname, lastname, phone) VALUES (?, ?, ?, ?, ?)";

    const CHECK_USER_EXIST  = "SELECT * FROM users WHERE email = ?";
    const SQL_FIND_BY_ID    = "SELECT * FROM users WHERE id = ?";

    const ROLE              = "SELECT role FROM users WHERE email = ? AND psw = ?";

    const CHECK_LOGIN       = "SELECT * FROM users WHERE email =? AND psw=?";

    const GET_ALL_USERS     = "SELECT * FROM users ";
    const SQL_INDEX_SEARCH  = " WHERE email LIKE ? OR firstname LIKE ? OR lastname LIKE ?";

    const SQL_INDEX_COUNT   = "SELECT COUNT(*) FROM users";

    const SQL_UPDATE        = "UPDATE users set email = ?, psw = ?, firstname = ?, lastname = ?, phone = ? WHERE id = ?";    

    const SQL_DELETE        = "DELETE FROM users WHERE id = ?";

    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new RegisterRepository();
        }
        return self::$instance;
    }
    
    function findUserByEmail($user)
    {
        $statement = $this->pdo->prepare(self::CHECK_USER_EXIST);
        $statement->execute(array($user->getEmail()));

        if ($statement->rowCount()) {
            $user_check = $statement->fetchObject(User::class);
            return $user_check;
        } else {
            return false;
        }
    }

    function checkIfLoggedUserIsAdmin($user)
    {

        $statement = $this->pdo->prepare(self::ROLE);
        $statement->execute(array(
            $user->getEmail(),
            $user->getPassword()));

        $userRole = $statement->fetch();
        
        return (int)$userRole['role'];
    }

    function registerNewUser($user)
    {
        $statement = $this->pdo->prepare(self::SQL_INSERT);
        $statement->execute(array(
            $user->getEmail(),
            $user->getPassword(),
            $user->getFirstname(),
            $user->getLastname(),
            $user->getPhone(),
        ));

      return $this->pdo->lastInsertId();
    }


    function checkLogin($user)
    {
        $statement = $this->pdo->prepare(self::CHECK_LOGIN);
        $statement->execute(array(
        $user->getEmail(),
        $user->getPassword()
            ));

        if ($statement->rowCount()) {

            $userinfo = $statement->fetch();
            return $userinfo;
        } else {

            return false;
        }
    }
    function CountAllUsers()
    {
        $sql = self::SQL_INDEX_COUNT;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_NUM);

        return $row[0];
    }

    function GetAllUsers($page=1, $PageSize=10, $search='')
    {
        $sql = self::GET_ALL_USERS;
        $params = array();
        if ($search != '') {
            $sql .= self::SQL_INDEX_SEARCH;
            $params = array($search, $search, $search);
        }
        
        $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        $users = $statement->fetchAll(PDO::FETCH_CLASS, User::class);
        return $users;
    }

    function findById($id)
    {
        $sql = self::SQL_FIND_BY_ID;
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array($id));
        $user = $statement->fetchObject(User::class);
        return $user;

    }


    function InsertNewUser($user)
    {
        $statement = $this->pdo->prepare(self::SQL_INSERT);
        $statement->execute(array(
            $user->getEmail(),
            $user->getPassword(),
            $user->getFirstname(),
            $user->getLastname(),
            $user->getPhone(),
        ));

      return $this->pdo->lastInsertId();
    }
    function editUser($user)
    {
        $statement = $this->pdo->prepare(self::SQL_UPDATE);
        $statement->execute(array(
            $user->getEmail(),
            $user->getPassword(),
            $user->getFirstname(),
            $user->getLastname(),
            $user->getPhone(),
            $user->getId()
        ));
        return $statement;
    }

    function deleteUser($user)
    {
        $statement = $this->pdo->prepare(self::SQL_DELETE);
        $statement->execute(array($user->getId()));
        return $statement;
    }
    
}
