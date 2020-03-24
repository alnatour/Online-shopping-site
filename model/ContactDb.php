<?php

class ContactDb
    {
    private static $instance;
    private $pdo;

    const SQL_INDEX_COUNT       = "SELECT COUNT(*) FROM users";
    const SQL_INDEX             = "SELECT * FROM users";
    const SQL_INDEX_SEARCH      = " WHERE email LIKE ? OR firstname LIKE ? OR lastname LIKE ?";

    const Get_Address_ByID      = "SELECT * FROM users WHERE id = ?";
    const getAddressByEmail     = "SELECT * FROM users WHERE email = ?";

    const SQL_INSERT            = "INSERT INTO users (email, firstname, lastname, street, zip, city, country, phone, fax, mobile, internet, company) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    const SQL_SET_EXTERNALID    = "UPDATE users SET external_id = ? WHERE id = ?";
    const SQL_UPDATE            = "UPDATE users set email = ?, firstname = ?, lastname = ?, street = ?, zip = ?, city = ?, country = ?, phone = ?, fax = ?, mobile = ?, internet = ?, company = ? WHERE id = ?";    
   
    const SQL_DELETE            = "DELETE FROM users WHERE id = ?";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ContactDb();
        }
        return self::$instance;
    }
    
    function CountAllAddress($search='')
    {
        $sql = self::SQL_INDEX_COUNT;
        $params = array();

        if ($search != '') {
            $sql .= self::SQL_INDEX_SEARCH;
            $params = array($search, $search, $search);
        }

        
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        $row = $statement->fetch(PDO::FETCH_NUM);

        return $row[0];
    }

    function GetAllAddress($page=1, $PageSize=10, $search='')
    {
        $sql = self::SQL_INDEX;
        $params = array();

        if ($search != '') {
            $sql .= self::SQL_INDEX_SEARCH;
            $params = array($search, $search, $search);
        }

        $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        $contacts = $statement->fetchAll(PDO::FETCH_CLASS, Contact::class);
        return $contacts;
    }
    function GetAddressByid($id)
    {
        $statement = $this->pdo->prepare(self::Get_Address_ByID);
        $statement->execute(array($id));
        $contact = $statement->fetchObject(Contact::class);
 

        return $contact;
    }
    function getAddressByEmail($email)
    {
        $statement = $this->pdo->prepare(self::getAddressByEmail);
        $statement->execute(array($email));
        $contact = $statement->fetchObject(Contact::class);
 

        return $contact;
    }


    function InsertNewAddress($contact)
    {
        $statement = $this->pdo->prepare(self::SQL_INSERT);
        $statement->execute(array(
            $contact->getEmail(),
            $contact->getFirstname(),
            $contact->getLastname(),
            $contact->getStreet(),
            $contact->getZip(),
            $contact->getCity(),
            $contact->getCountry(),
            $contact->getPhone(),
            $contact->getFax(),
            $contact->getMobile(),
            $contact->getInternet(),
            $contact->getCompany()
        ));

      return $this->pdo->lastInsertId();
    }

    function UpdateExternalID($id, $external_id)
    {
        $statement = $this->pdo->prepare(self::SQL_SET_EXTERNALID);
        return $statement->execute(array($external_id, $id));
    }

    function editAddress($contact)
    {
        $statement = $this->pdo->prepare(self::SQL_UPDATE);
        $statement->execute(array(
            $contact->getEmail(),
            $contact->getFirstname(),
            $contact->getLastname(),
            $contact->getStreet(),
            $contact->getZip(),
            $contact->getCity(),
            $contact->getCountry(),
            $contact->getPhone(),
            $contact->getFax(),
            $contact->getMobile(),
            $contact->getInternet(),
            $contact->getCompany(),
            $contact->getId()
        ));
    }
    function deleteAddress($contact)
    {
        
        $statement = $this->pdo->prepare(self::SQL_DELETE);
        $statement->execute(array($contact->getId()));
        
    }
}
