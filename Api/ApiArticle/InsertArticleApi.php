<?php
require 'IncludeApi.php';

$ApiArticle = new ApiArticleDb($url, $username, $password);

if (isset($_POST['submit_insert'])) {

          $articleinfo = new ApiArticleInfo();
          $articleinfo->setTitle($_POST['title']);
          $articleinfo->setDetail($_POST['detail']);

          $InsertArticle = $ApiArticle->ContentInsert($articleinfo );
        // echo '<pre>';print_r($InsertArticle); die();
    
          if($InsertArticle){
             $feedback=print_r($InsertArticle);
          }else{
            $feedback=$ApiArticle->getLastErrorMessage();
          }
 
  }

    
require '../../header.php';
?>


<div class="container" style='width:50%; margin-top:95px'>
<h1>Artikal Einfügen</h1><br /><br />

  <form method="post" action='insertArticleApi.php' enctype="multipart/form-data">
    <div class="form-group">
    </div>
    <br />
    <div class="form-group">
      <label for="Name">Title</label>
      <input type="text" class="form-control inputstl" name='title'>
    </div>

    <div class="form-group" id="sample">
          <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
        //<![CDATA[
                bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
          //]]>
          </script>
            <label for="Email1msg">Message:</label><br />
            <textarea rows="8" class="form-control" name='detail'></textarea>
    </div>

    <div class="form-group">
      <input type="submit" name= 'submit_insert' class="btn btn-primary" value='Submit Insert'>
      <a class='btn  btn-secondary' href='#'><i class='fa fa-arrow-left' ></i> Zurück</a>
    </div>

  </form>
</div>



<script>
// Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
</script>

<?php

require '../../footer.php';