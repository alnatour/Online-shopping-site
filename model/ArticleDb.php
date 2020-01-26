<?php

class ArticleDb
    {
    private static $instance;
    private $pdo;
    
    const GET_All_PRODUCTS          = "SELECT * FROM products_tb";
    const PRODUCT_BY_SUBCATEGORY    = " WHERE subcategory_id = ?";
    const PRODUCTS_ORDER            =" ORDER BY datum ASC";

    const GET_POSTS_WITH_AUTH	= "SELECT p.id, p.title, p.article, u.firstname, u.id as userID FROM products_tb p LEFT JOIN users u ON u.id = p.contact_id";
    const GET_USER_POSTS_WITH_AUTH ="SELECT p.id, p.title, p.article, u.firstname, u.id as userID FROM products_tb p LEFT JOIN users u ON u.id = p.contact_id WHERE p.contact_id = ?";
    const GET_POSTS_WITH_AUTH_SEARCH   = " AND p.title LIKE  ? OR p.article LIKE ? ";
    const GET_POSTS_SEARCH   = " WHERE p.title LIKE  ? OR p.article LIKE ? ";

    const Get_All_Articles      = "SELECT * FROM products_tb ORDER BY datum DESC";

    const Get_ByID              = "SELECT * FROM products_tb WHERE id = ?";

    const SQL_INSERT            = "INSERT INTO products_tb (contact_id, title ,imagee,  article, datum, subcategory_id) VALUES (?, ?, ?, ?, ?, ?)";

    const SQL_MATCHING_VALUES   = "SELECT * FROM users
                                        INNER JOIN products_tb
                                        ON users.id = products_tb.contact_id ";

    const ARTICLE_BY_ID   = " WHERE products_tb.contact_id=?";
    const COUNT_ARTICLE         = "SELECT count(*) FROM users INNER JOIN products_tb ON users.id = products_tb.contact_id";

    const Articles_ORDER        =" ORDER BY products_tb.datum DESC";

    const SQL_GET_Authors       = 'SELECT * FROM users
                                        LEFT JOIN products_tb
                                        ON users.id = products_tb.contact_id ORDER BY products_tb.datum DESC ';
    
    const Get_ContactID         ="SELECT * FROM users 
                                        LEFT JOIN products_tb 
                                        ON users.id = products_tb.contact_id WHERE contact_id = ? ";
    
    const Get_Artikel_ByID      = "SELECT * FROM products_tb WHERE id = ?";
    
    const SQL_UPDATE            = "UPDATE products_tb set contact_id = ?, title = ?, imagee = ?, article = ?, update_datum = ?, subcategory_id=? WHERE id = ?";

    const SQL_DELETE            = "DELETE FROM products_tb WHERE id = ?";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ArticleDb();
        }
        return self::$instance;
    }

    //24
    function GetProductsUserWithAuthors($user_id,$page=1, $PageSize=50, $search='')
    {
            $sql = self::GET_USER_POSTS_WITH_AUTH;
            $params = array($user_id,);

            if ($search != '') {
                $sql .= self::GET_POSTS_WITH_AUTH_SEARCH;
                array_push($params,$search,$search);
            }

            $sql .= self::PRODUCTS_ORDER;
            $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
            
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $Products = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
            //echo'<pre>'; print_r($Products);die();
            return $Products;
    }
    //posts

    function GetProductsWithAuthors($page=1, $PageSize=50,$search='')
    {
            $sql = self::GET_POSTS_WITH_AUTH;
            $params = array();

            if ($search != '') {
                $sql .= self::GET_POSTS_SEARCH;
                $params = array($search,$search);
            }

            $sql .= self::PRODUCTS_ORDER;
            $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
            
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $Products = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
            return $Products;
    }

    //20,11

    function GetProductsWithSubcat($page=1, $PageSize=100, $subcid='')
    {
            $sql = self::GET_All_PRODUCTS;
            $params = array();

                if ($subcid != '') {
                    $sql .= self::PRODUCT_BY_SUBCATEGORY;
                    $params = array($subcid);
                   //echo'<pre>';print_r(array($sql)); die;
                }
            $sql .= self::PRODUCTS_ORDER;
            $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
            
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $Products = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
            return $Products;
    }
    //9.10
    function GetAllArtikels()
    {
        $sql = self::Get_All_Articles;

        $statement->execute();
        $artikelinfo = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
        return $artikelinfo;
    }

    function CountAllArtikels()
    {
        $sql = self::COUNT_ARTICLE ;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_NUM);
        return $row[0];
    }



    function GetByid($id)
    {
        $statement = $this->pdo->prepare(self::Get_ByID);
        $statement->execute(array($id));
        $artikel = $statement->fetchObject(ArticleInfo::class);
        
        return $artikel;
    }

    function InsertNewArtikel($artikelinfo)
    {
        $statement = $this->pdo->prepare(self::SQL_INSERT);
        $statement->execute(array(
            $artikelinfo->getContactId(),
            $artikelinfo->getTitle(),
            $artikelinfo->getImagee(),
            $artikelinfo->getArticle(),
            $artikelinfo->getDatum(),
            $artikelinfo->getSubcategoryId(),
        ));
        return $this->pdo->lastInsertId();
      //echo'<pre>'; print_r($artikelinfo->getCategorie());die();
    }

    function GetAuthors()
    {
        $statement = $this->pdo->prepare(self::SQL_GET_Authors);
        $statement->execute(array($id, $contact_id));
        $Authors = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
        return $Authors;
    }

    function GetAllArticlesWith($categorie='')
    {
            $statement = $this->pdo->prepare(self::COUNT_ARTICLE_CATE);
            $statement->execute(array($categorie));
            $row = $statement->fetch(PDO::FETCH_NUM);

            return $row[0];
    }


    function GetArticlesWithAuthor($page=1, $PageSize=10, $categorie='')
    {
            $sql = self::SQL_MATCHING_VALUES;
            $params = array();

                if ($categorie != '') {
                    $sql .= self::Artikel_ByCategorie;
                    $params = array($categorie);
                   //echo'<pre>';print_r(array($categorie)); die;
                }
            $sql .= self::Articles_ORDER;
            $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
            
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $Authors = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
            return $Authors;
    }

    function GetContactID($contact_id)
    {
        $statement = $this->pdo->prepare(self::Get_ContactID);
        $statement->execute(array($contact_id));
        $Authors = $statement->fetchObject(ArticleInfo::class);
        return $Authors;
    }
    
    function GetArtikelByid($id)
    {
        $statement = $this->pdo->prepare(self::Get_Artikel_ByID);
        $statement->execute(array($id));
        $artikel = $statement->fetchObject(ArticleInfo::class);
 
        return $artikel;
    }
    
    function editArticle($artikelinfo)
    {
        $statement = $this->pdo->prepare(self::SQL_UPDATE);
        $statement->execute(array(
            $artikelinfo->getContactId(),
            $artikelinfo->getTitle(),
            $artikelinfo->getImagee(),
            $artikelinfo->getArticle(),
            $artikelinfo->getUpdatedatum(),
            $artikelinfo->getSubcategoryId(),
            $artikelinfo->getId()
        ));
    }
    
    function deleteAddress($artikelinfo)
    {
        $statement = $this->pdo->prepare(self::SQL_DELETE);
        $statement->execute(array($artikelinfo->getId()));  
    }

}
