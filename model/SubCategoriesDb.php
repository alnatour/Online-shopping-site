<?php


class SubCategoriesDb
{

    private static $instance;
    private $pdo;

    const GET_ALL_SUBCATS = "SELECT * FROM subcategories";

    const GET_SUBCAT_BY_CATEGORY_ID = "SELECT * FROM subcategories WHERE category_id = ?";

    const GET_ARTICLE_BY_CATEGORY_ID = "SELECT *, p.id AS productId FROM products_tb p  LEFT JOIN subcategories sub ON p.subcategory_id = sub.id WHERE sub.category_id = ?";


    const CREATE_SUBCAT = "INSERT INTO subcategories (name, category_id) VALUES (?, ?)";

    const GET_SUBCAT_NAME = "SELECT name FROM subcategories WHERE id = ?";

    const GET_ALL_SUBCATS_ADMIN = "SELECT sc.id, sc.name, c.name AS catname, c.id AS catId, category_id FROM subcategories sc 
                                    LEFT JOIN categories c ON sc.category_id = c.id";

    const GET_ALL_SUBCATS_WITHOUT_PRODUCTS = "SELECT c.* FROM categories c 
                                          WHERE NOT EXISTS(SELECT * FROM products_tb p 
                                          WHERE p.subcategory_id = c.id)";

    const GET_SUBCAT_BY_ID = "SELECT * FROM subcategories WHERE id = ?";

    const EDIT_SUBCAT = "UPDATE subcategories SET name = ?, category_id = ? WHERE id = ?";

    const DELETE_SUBCAT = "DELETE FROM subcategories WHERE id = ?";


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

    function getAllSubCategories()
    {

        $statement = $this->pdo->prepare(self::GET_ALL_SUBCATS);
        $statement->execute();
        $subcategories = $statement->fetchAll(PDO::FETCH_CLASS, SubCategory::class);

        return $subcategories;
    }

    function getSubCategoryByCategoryid($subId)
    {
        $statement = $this->pdo->prepare(self::GET_SUBCAT_BY_CATEGORY_ID);
        $statement->execute(array($subId));
        $categories = $statement->fetchAll(PDO::FETCH_CLASS, SubCategory::class);

        return $categories;
    }
    function countAllProductsWithCategoryID($subcid)
    {

        $statement = $this->pdo->prepare(self::GET_ARTICLE_BY_CATEGORY_ID);
        $statement->execute(array($subcid));
        $products = $statement->fetchall();
        //echo '<pre>'; print_r(count($products));die();
        return $products;
    }
    function getAllProductsWithCategoryID($page,$PageSize, $subcid)
    {

        $sql =self::GET_ARTICLE_BY_CATEGORY_ID;

        $sql .= " LIMIT " . $PageSize . " OFFSET " . ($PageSize*($page-1));
        $statement = $this->pdo->prepare($sql);

        $statement->execute(array($subcid));
        $products = $statement->fetchAll();
       // echo '<pre>'; print_r($products);die();
        return $products;
    }


//-------------------------------------------------------
    function createSubCategory(SubCategory $subCategory)
    {

        $statement = $this->pdo->prepare(self::CREATE_SUBCAT);
        $statement->execute(array(
            $subCategory->getName(),
            $subCategory->getCategoryId()));

        return $this->pdo->lastInsertId();
    }

    function getAllSubCategoriesWithoutProducts()
    {

        $statement = $this->pdo->prepare(self::GET_ALL_SUBCATS_WITHOUT_PRODUCTS);
        $statement->execute();
        $subcategories = $statement->fetchAll();

        return $subcategories;
    }

    function getAllSubCategoriesAdmin()
    {

        $statement = $this->pdo->prepare(self::GET_ALL_SUBCATS_ADMIN);
        $statement->execute();
        $subcategories = $statement->fetchAll();

        return $subcategories;
    }


    function getSubCategoryName($subId)
    {

        $statement = $this->pdo->prepare(self::GET_SUBCAT_NAME);
        $statement->execute(array($subId));
        $subcategory = $statement->fetch();

        return $subcategory[0];
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
}