<?php

class ArticleDb
    {
    private static $instance;
    private $pdo;
    
    const GET_ALL_PRODUCTS          = "SELECT * FROM products_tb p";
    const PRODUCT_BY_SUBCATEGORY    = " WHERE subcategory_id = ?";
    const PRODUCTS_ORDER            = " ORDER BY datum ASC";

    const GET_ALL_ARTICLES          = "SELECT * FROM products_tb ORDER BY datum DESC";

    const GET_MOST_RECENT_ARTICLES  = "SELECT * FROM products_tb p
                                        ORDER BY p.datum ASC 
                                        LIMIT 8";

    const GET_RELATED_ARTICLES      = "SELECT p.*, sc.id AS subcategory_id, c.id AS category_id FROM products_tb p
                                        LEFT JOIN subcategories sc ON sc.id = p.subcategory_id
                                        LEFT JOIN categories c ON sc.category_id = c.id 
                                        WHERE c.id = ?
                                        ORDER BY p.datum ASC 
                                        LIMIT 8";

    const COUNT_ALL_ARTICLES        = "SELECT count(*) FROM users INNER JOIN products_tb ON users.id = products_tb.contact_id";

    const GET_BY_ID                 = "SELECT * FROM products_tb WHERE id = ?";

    const GET_ARTICLE_BY_ID          = "SELECT p.*, sc.id AS subcategory_id, c.id AS category_id, c.name AS catname, sc.name AS subcatname FROM products_tb p
                                        LEFT JOIN subcategories sc ON sc.id = p.subcategory_id
                                        LEFT JOIN categories c ON sc.category_id = c.id 
                                        WHERE p.id = ?";

    const SQL_INSERT                = "INSERT INTO products_tb (contact_id, title, price, discount,  imagee, article, datum, subcategory_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    const SQL_UPDATE                = "UPDATE products_tb set contact_id = ?, title = ?, price = ?, discount =?, imagee = ?, article = ?, update_datum = ?, subcategory_id=? WHERE id = ?";

    const SQL_DELETE                = "DELETE FROM products_tb WHERE id = ?";


    const GET_ARTICLES_WITH_AUTH	= "SELECT p.id, p.title, p.article, u.firstname, u.id as userID FROM products_tb p
                                        LEFT JOIN users u ON u.id = p.contact_id";
    const ARTICLES_ORDER            = " ORDER BY p.datum DESC";
    const GET_ARTICLES_SEARCH       = " WHERE p.title LIKE  ? OR p.article LIKE ? ";

    const GET_USER_ARTICLES         = "SELECT p.id, p.title, p.article, u.firstname, u.id as userID FROM products_tb p 
                                        LEFT JOIN users u ON u.id = p.contact_id WHERE p.contact_id = ?";
    const GET_USER_ARTICLES_SEARCH  = " AND p.title LIKE  ? OR p.article LIKE ? ";

    const GET_AUTHOR_BY_ID          = "SELECT * FROM users 
                                        LEFT JOIN products_tb ON users.id = products_tb.contact_id 
                                        WHERE contact_id = ? ";

    const GET_RATING_BY_USERID      = "SELECT rating FROM reviews WHERE user_id = ? and product_id = ? ";

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


    //
    function viewRating($user_id, $product_id)
    {
       $statement = $this->pdo->prepare(self::GET_RATING_BY_USERID);
       $statement->execute(array($user_id, $product_id));
       $rating = $statement->fetch(PDO::FETCH_ASSOC);
       return $rating['rating'];
    }

    //
    function GetProductsWithSubcat($page=1, $PageSize, $subcid='')
    {
            $sql = self::GET_ALL_PRODUCTS;
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

    function GetAllArtikels()
    {
        
        $statement = $this->pdo->prepare(self::GET_ALL_ARTICLES);
        $statement->execute();
        $artikes = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
        return $artikes;
    }

    /** echo '<pre>'; print_r($products);die;
     * Function for getting most recent products
     * @return array
     */
    function getMostRecent()
    {

        $statement = $this->pdo->prepare(self::GET_MOST_RECENT_ARTICLES);
        $statement->execute();
        $artikes = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);

        return $artikes;
    }

    function getRelated($cid)
    {

        $statement = $this->pdo->prepare(self::GET_RELATED_ARTICLES);
        $statement->execute(array($cid));
        $products = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
        return $products;
    }

    function CountAllArtikels()
    {
        $sql = self::COUNT_ALL_ARTICLES ;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_NUM);
        return $row[0];
    }

    function GetByid($id)
    {
        $statement = $this->pdo->prepare(self::GET_BY_ID);
        $statement->execute(array($id));
        $artikel = $statement->fetchObject(ArticleInfo::class);
        return $artikel;
    }
    function GetArticleByid($id)
    {
        $statement = $this->pdo->prepare(self::GET_ARTICLE_BY_ID);
        $statement->execute(array($id));
        $artikel = $statement->fetch(PDO::FETCH_ASSOC);
        return $artikel;
    }

    function InsertNewArtikel($artikelinfo)
    {
        $statement = $this->pdo->prepare(self::SQL_INSERT);
        $statement->execute(array(
            $artikelinfo->getContactId(),
            $artikelinfo->getTitle(),
            $artikelinfo->getPrice(),
            $artikelinfo->getDiscount(),
            $artikelinfo->getImagee(),
            $artikelinfo->getArticle(),
            $artikelinfo->getDatum(),
            $artikelinfo->getSubcategoryId(),
        ));
        return $this->pdo->lastInsertId();
      //echo'<pre>'; print_r($artikelinfo->getCategorie());die();
    }
    
    function editArticle($artikelinfo)
    {
        $statement = $this->pdo->prepare(self::SQL_UPDATE);
        $statement->execute(array(
            $artikelinfo->getContactId(),
            $artikelinfo->getTitle(),
            $artikelinfo->getPrice(),
            $artikelinfo->getDiscount(),
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
    
    /* *Search */
    function GetProductsWithSearch($page, $PageSize, $search)
    {
            $sql = self::GET_ALL_PRODUCTS;
            $params = array();

            if ($search != '') {
                $sql .= self::GET_ARTICLES_SEARCH;
                $params = array($search,$search);
            }

            $sql .= self::ARTICLES_ORDER;
            $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
            
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $Products = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
            return $Products;
    }

    //View in page admin All Artickle With Authors
    function GetProductsWithAuthors($page=1, $PageSize=50,$search='')
    {
            $sql = self::GET_ARTICLES_WITH_AUTH;
            $params = array();

            if ($search != '') {
                $sql .= self::GET_ARTICLES_SEARCH;
                $params = array($search,$search);
            }

            $sql .= self::ARTICLES_ORDER;
            $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
            
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $Products = $statement->fetchAll(PDO::FETCH_CLASS, ArticleInfo::class);
            return $Products;
    }

    //View All User Artickles in page admin User
    function GetProductsUserWithAuthors($user_id,$page=1, $PageSize=50, $search='')
    {
            $sql = self::GET_USER_ARTICLES;
            $params = array($user_id,);

            if ($search != '') {
                $sql .= self::GET_USER_ARTICLES_SEARCH;
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

    function GetContactID($contact_id)
    {
        $statement = $this->pdo->prepare(self::GET_AUTHOR_BY_ID);
        $statement->execute(array($contact_id));
        $Authors = $statement->fetchObject(ArticleInfo::class);
        return $Authors;
    }

}
