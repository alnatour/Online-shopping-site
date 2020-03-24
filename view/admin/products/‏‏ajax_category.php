<?php
require '../../../config.php';

(isset($_POST["cid"])) ? $cid = $_POST["cid"] : $cid=1;
$_SESSION['cid'] = $cid;

$SubCategoryDb = SubCategoriesDb::getInstance();
$subcategories = $SubCategoryDb->getSubCategoryByCategoryid($cid);


?>

          <?php  foreach ($subcategories as $subCategory) {  
              echo '<option value="' . $subCategory->getId() . '">' .$subCategory->getName(). '</option>';
            }  ?>

    <!---Ende subCategories-->