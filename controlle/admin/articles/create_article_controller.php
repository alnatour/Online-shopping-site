<?php

require (ROOT_PATH . '/controlle/admin/admin_session.php');

if(!isset($_SESSION['user']) )
{	// not logged in
    header('Location: '.BASE_URL.'index.php');
    die();
}
$errors = array();
$articledb = ArticleDb::getInstance();

$CategoryDb = CategoriesDb::getInstance();
$categories = $CategoryDb->getAllCategories();

$UsersDb = RegisterRepository::getInstance();
$Users = $UsersDb->GetAllUsers();

//echo'<pre>';print_r($SubCategories);die();

$datum = date("F j, Y, h:i a");

if (isset($_POST['submit_insert'])) {

  $artikelinfo = new ArticleInfo();
  
  $artikelinfo->setContactId($_POST['Authors']);
  $artikelinfo->setDatum($datum);
  
  //Check errors

      if (empty($_POST['title']) ) {
          array_push($errors, "title is required");
      }else{
        $artikelinfo->setTitle($_POST['title']);
      }

      if (empty($_POST['price']) ) {
          array_push($errors, "Price is required");
      }else{
        $artikelinfo->setPrice($_POST['price']);
      }

      $artikelinfo->setDiscount($_POST['discount']);
      

      if (empty($_POST['article'])) {
          array_push($errors, "article is required ");
      }else{
        $artikelinfo->setArticle($_POST['article']);
      }

      if (empty($_POST['subCategory'])) {
          array_push($errors, "subCategory is required");
      }else{
        $artikelinfo->setSubcategoryId($_POST['subCategory']);
      }

        //image loading

      if(!empty($_FILES['image']['tmp_name']) 
      && file_exists($_FILES['image']['tmp_name'])) {
        $uploads_dir = BASE_URL.'uploads/productImages';
        $filename = basename($_FILES["image"]["name"]);
        $filetmp= addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $imagee = move_uploaded_file($filetmp, "$uploads_dir/$filename");
        $artikelinfo->setImagee($filename);
      }else{
            array_push($errors, "Image is required");
        }
      

      //insert new user 
      if (count($errors) == 0) {
        $insert = $articledb->InsertNewArtikel($artikelinfo);
        header('location: '.BASE_URL.'view/main/single.php?id='.$insert.'');
      }


}

