<?php

$ArticleDb = ArticleDb::getInstance();
$UsersDb = RegisterRepository::getInstance();
$SubCategoryDb = SubCategoriesDb::getInstance();
$CategoryDb = CategoriesDb::getInstance();

$errors = array();
$edit ='';
$id = $_GET['id'];

//getting All Article 
$article = $ArticleDb->GetByid($id);
//getting All Users
$Users = $UsersDb->GetAllUsers();

//getting All Sections for One Article 
$sections = $CategoryDb->getSectionsForArticle($id);
//getting All Categories
$categories = $CategoryDb->getAllCategories();

//getting All SubCategories
$sub_categories = $SubCategoryDb->getAllSubCategories();


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

    $article->setDiscount($_POST['discount']);

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
      $uploads_dir = BASE_URL.'uploads/productImages';
      $filename = basename($_FILES["image"]["name"]);
      $filetmp= addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $imagee = move_uploaded_file($filetmp, "$uploads_dir/$filename");
      $article->setImagee($filename);
      }else{
          array_push($errors, "Image is required");
      }

    //insert new user 
    if (count($errors) == 0) {
      $edit = $ArticleDb->editArticle($article);
      header('location: '.BASE_URL.'view/main/single.php?id='.$id.'');
    }
  }






