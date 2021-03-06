<?php


class SubCategoriesDb
{

    private static $instance;
    private $pdo;

    const GET_ALL_SUBCATS               = "SELECT * FROM subcategories";

    const GET_SUBCAT_BY_CATEGORY_ID     = "SELECT * FROM subcategories WHERE category_id = ?";

    const GET_ARTICLES_BY_CATEGORY_ID   = "SELECT p.*, sc.id AS subcategory_id, c.id AS category_id FROM products_tb p
                                            LEFT JOIN subcategories sc ON p.subcategory_id = sc.id 
                                            LEFT JOIN categories c ON sc.category_id = c.id 
                                            WHERE c.id = ?";


    const CREATE_SUBCAT                 = "INSERT INTO subcategories (name, category_id) VALUES (?, ?)";

    const GET_SUBCAT_BY_ID               = "SELECT sc.id, sc.name, c.name AS catname, c.id AS catId, category_id FROM subcategories sc
                                                LEFT JOIN categories c ON sc.category_id = c.id
                                                WHERE sc.id = ?";

    const GET_ALL_SUBCATS_ADMIN         = "SELECT sc.id, sc.name, c.name AS catname, c.id AS catId, category_id FROM subcategories sc 
                                            LEFT JOIN categories c ON sc.category_id = c.id";

    const GET_ALL_SUBCATS_WITHOUT_PRODUCTS = "SELECT c.* FROM categories c 
                                          WHERE NOT EXISTS(SELECT * FROM products_tb p 
                                          WHERE p.subcategory_id = c.id)";

    const EDIT_SUBCAT                   = "UPDATE subcategories SET name = ?, category_id = ? WHERE id = ?";

    const DELETE_SUBCAT                 = "DELETE FROM subcategories WHERE id = ?";


    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new SubCategoriesDb();
        }

        return self::$instance;
    }


    function getAllProductsWithCategoryID($page,$PageSize, $cid)
    {

        $sql =self::GET_ARTICLES_BY_CATEGORY_ID;

        $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
        $statement = $this->pdo->prepare($sql);

        $statement->execute(array($cid));
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    function countAllProductsWithCategoryID($subcid)
    {
        $statement = $this->pdo->prepare(self::GET_ARTICLES_BY_CATEGORY_ID);
        $statement->execute(array($subcid));
        $products = $statement->fetchall();
        return $products;
    }

    //not bind subcategories with Categories
    function getAllSubCategories()
    {
        $statement = $this->pdo->prepare(self::GET_ALL_SUBCATS);
        $statement->execute();
        $subcategories = $statement->fetchAll(PDO::FETCH_CLASS, SubCategory::class);
        return $subcategories;
    }
    
    //bind subcategories with Categories
    function getAllSubCategoriesAdmin()
    {

        $statement = $this->pdo->prepare(self::GET_ALL_SUBCATS_ADMIN);
        $statement->execute();
        $subcategories = $statement->fetchAll();

        return $subcategories;
    }

    function getSubCategoryByCategoryid($subId)
    {
        $statement = $this->pdo->prepare(self::GET_SUBCAT_BY_CATEGORY_ID);
        $statement->execute(array($subId));
        $subcategories = $statement->fetchAll(PDO::FETCH_CLASS, SubCategory::class);
        return $subcategories;
    }

    function getSubCategoryById($subcid)
    {
        $statement = $this->pdo->prepare(self::GET_SUBCAT_BY_ID);
        $statement->execute(array($subcid));
        $category = $statement->fetch();

        return $category;
    }


    function editSubCategory(SubCategory $subcat)
    {
        $statement = $this->pdo->prepare(self::EDIT_SUBCAT);
        $statement->execute(array($subcat->getName(), $subcat->getCategoryId(), $subcat->getId()));

        return true;
    }

    function deleteSubCategory($subcatId)
    {
        $statement = $this->pdo->prepare(self::DELETE_SUBCAT);
        $statement->execute(array($subcatId));

        return true;
    }
//-------------------------------------------------------

    function getSubCategoryName($subId)
    {

        $statement = $this->pdo->prepare(self::GET_SUBCAT_BY_ID);
        $statement->execute(array($subId));
        $subcategory = $statement->fetch();

        return $subcategory[0];
    }

    function createSubCategory(SubCategory $subCategory)
    {
        $statement = $this->pdo->prepare(self::CREATE_SUBCAT);
        $statement->execute(array(
            $subCategory->getName(),
            $subCategory->getCategoryId()));

        return $this->pdo->lastInsertId();
    }





    //-------------------- check --------------------
    function getAllSubCategoriesWithoutProducts()
    {

        $statement = $this->pdo->prepare(self::GET_ALL_SUBCATS_WITHOUT_PRODUCTS);
        $statement->execute();
        $subcategories = $statement->fetchAll();

        return $subcategories;
    }

}