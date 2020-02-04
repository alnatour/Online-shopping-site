<?php

if(!isset($_SESSION['user']) )
{	// not logged in
    header('Location: '.BASE_URL.'index.php');
    die();
}
$errors = array();
$edit ='';
$id = $_GET['id'];
$articledb = ArticleDb::getInstance();
$article = $articledb->GetByid($id);

$UsersDb = RegisterRepository::getInstance();
$Users = $UsersDb->GetAllUsers();


$CategoryDb = CategoriesDb::getInstance();
$categories = $CategoryDb->getAllCategories();

$SubCategoryDb = SubCategoriesDb::getInstance();
$SubCategories = $SubCategoryDb->getAllSubCategories();


$datum_update = date("F j, Y, h:i a");



if (isset($_POST['submit_update'])) {

    $article->setContactId($_POST['Authors']);
    $article->setUpdatedatum($datum_update);
    
    //Check errors

    if (empty($_POST['title']) ) {
      array_push($errors, "title is required");
    }else{
    $article->setTitle($_POST['title']);
    }
    if (empty($_POST['price']) ) {
        array_push($errors, "Price is required");
    }else{
      $article->setPrice($_POST['price']);
    }

    if (empty($_POST['article'])) {
      array_push($errors, "article is required ");
    }else{
    $article->setArticle($_POST['article']);
    }

    if (empty($_POST['subCategory'])) {
      array_push($errors, " Category and Sub Category are required");
    }else{
    $article->setSubcategoryId($_POST['subCategory']);
    }

    //image loading

    if(!empty($_FILES['image']['tmp_name']) 
    && file_exists($_FILES['image']['tmp_name'])) {
      $uploads_dir = 'C:\xampp\htdocs\xampp\2020\20.11.2019 Produkts\kontakte_verwalten/view/images';
      $filename = basename($_FILES["image"]["name"]);
      $filetmp= addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $imagee = move_uploaded_file($filetmp, "$uploads_dir/$filename");
      $article->setImagee($filename);
      }else{
          array_push($errors, "Image is required");
      }

    //insert new user 
    if (count($errors) == 0) {
      $edit = $articledb->editArticle($article);
      header('location: view_one_artikel.php?id='.$id.'');
    }
  }






