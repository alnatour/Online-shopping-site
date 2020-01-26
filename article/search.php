<?php
//include(ROOT_PATH . '/include.php');

$search='';
$data = false;


// POST 
if (isset($_POST['submit_search'])) {

    $search = trim($_POST['search']);
    $getResult = $articledb->GetProductsUserWithAuthors($user_id,$page=1, $PageSize=50, $search);

    if (empty($getResult)){
        $feedback = ' nichts gefunden';
    }
    
    echo'<pre>';print_r($getResult); die();
    
}


?>

<h5 class='text-center ' style='margin-top:100px'> Sie können per Email über jeglichen Kontakt suchen</h5>
<div class='d-flex justify-content-center '>
    <form method="post" action='search.php' style='margin:50px 0' class="form-inline"> 
        <input type="text" name="search" class="form-control mr-sm-2" value="<?=$search;?>">
        <input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-0" />
        <br/><br /><br/>
    </form>
</div>

<div class="container">
    <table class="table" style=" margin-right:50px;">
        <thead class="thead-dark">
            <tr>
                <th>Field</th> 
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (!empty ($getResult)){ ?>
            <tr>
                <td>Id</td>
                <td width="100%"><?= $getResult->getId() ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td width="100%"><?= $getResult->getEmail() ?></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td width="100%"><?= $getResult->getFirstname() ?></td>
            </tr>
            <tr>
                <td>Last name</td>
                <td width="100%"><?= $getResult->getLastname() ?></td>
            </tr>
            <tr>
                <td>Street</td>
                <td width="100%"><?= $getResult->getStreet() ?></td>
            </tr>
            <tr>
                <td>Zip</td>
                <td width="100%"><?= $getResult->getZip() ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td width="100%"><?= $getResult->getCity() ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td width="100%"><?= $getResult->getCountry() ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td width="100%"><?= $getResult->getPhone() ?></td>
            </tr>
            <tr>
                <td>Fax</td>
                <td width="100%"><?= $getResult->getFax() ?></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td width="100%"><?= $getResult->getMobile() ?></td>
            </tr>
            <tr>
                <td>Internet</td>
                <td width="100%"><?= $getResult->getInternet() ?></td>
            </tr>
            <tr>
                <td>Company</td>
                <td width="100%"><?= $getResult->getCompany() ?></td>
            </tr>
        <?php } ?>
        </tbody>
     </table>

    <br>

    <div>
        <a class='action btn btn-success' href="http://localhost:8888/kontakte_verwalten/kontakte/edit.php?id=<?php echo $getAddressByEmail->getId(); ?>"><i class="far fa-edit"></i> Edit</a>
        <a class='action btn btn-danger' href='http://localhost:8888/kontakte_verwalten/kontakte/delete.php?id=<?php echo $getAddressByEmail->getId();?>'><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        <a class='action btn  btn-secondary' href="http://localhost:8888/kontakte_verwalten/index.php">Cancel</a>
    </div>    
 </div>
 
<div class='mt-3 mb-3'>
</div>

<?php

require '../../footer.php';