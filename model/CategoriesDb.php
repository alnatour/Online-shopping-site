<?php


class CategoriesDb
{

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_CAT = "INSERT INTO categories (name) VALUES (?)";

    const GET_ALL_CATS  ="SELECT * FROM categories";

    const GET_CAT_BY_ID = "SELECT * FROM categories WHERE id = ?";

    const GET_TOPICS_FOR_ARTICLE = "SELECT *, sc.name AS subcatname, p.id AS pid  FROM subcategories sc
                            LEFT JOIN categories c ON sc.category_id = c.id 
                            LEFT JOIN products_tb p ON sc.id = p.subcategory_id 
                            WHERE p.id = ? ";

    const GET_ALL_CATS_ADMIN = "SELECT c.id AS catid, c.name AS catname, sc.category_id, sc.id AS subcat_id , sc.name AS subcatname FROM categories c 
                                LEFT JOIN subcategories sc ON c.id = sc.category_id";

    const EDIT_CAT = "UPDATE categories SET name = ? WHERE id = ?";

    const DELETE_CAT = "DELETE FROM categories WHERE id = ?";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new CategoriesDb();
        }

        return self::$instance;
    }

    /**
     * Function for creating category.
     * @param Category $category - Receives new category name and it's super category ID.
     * @return string - Returns the new category's ID.
     */
    function createCategory(Category $category)
    {

        $statement = $this->pdo->prepare(self::CREATE_CAT);
        $statement->execute(array(
            $category->getName() ));

        return $this->pdo->lastInsertId();
    }

    /** echo'<pre>';print_r($categories);die();
     * Function for getting categories.
     */
    function getAllCategories()
    {
        $statement = $this->pdo->prepare(self::GET_ALL_CATS);
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_CLASS, Category::class);
        return $categories;
    }

    function getCategoryById($catId)
    {
        $statement = $this->pdo->prepare(self::GET_CAT_BY_ID);
        $statement->execute(array($catId));
        $category = $statement->fetchObject(Category::class);

        return $category;
    }

    /**
     * Function to getting All Sections for One Article 
     */
    function getSectionsForArticle($pid)
    {
        $statement = $this->pdo->prepare(self::GET_TOPICS_FOR_ARTICLE);
        $statement->execute(array($pid));
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
        //echo'<pre>';print_r($categories[0]['category_id']);die();
        return $categories[0];
    }


    function getAllCategoriesAdmin()
    {
        $statement = $this->pdo->prepare(self::GET_ALL_CATS_ADMIN);
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    function editCategory(Category $category)
    {
        $statement = $this->pdo->prepare(self::EDIT_CAT);
        $statement->execute(array($category->getName(), $category->getId()));

        return true;
    }

    
    function deleteCategory($catId)
    {
        $statement = $this->pdo->prepare(self::DELETE_CAT);
        $statement->execute(array($catId));

        return true;
    }
}