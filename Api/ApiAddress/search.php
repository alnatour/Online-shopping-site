<?php
require '../../include.php';

$email='';
$data = false;

$AddressDao = AddressDao::getInstance();

// POST 
if (isset($_POST['submit_search'])) {

    $email = trim($_POST['email']);
    $getAddressByEmail = $AddressDao->getAddressByEmail($email);

    if (empty($getAddressByEmail)){
        $feedback = ' keine addresse gefunden';
    }
    
    //echo'<pre>';print_r($getAddressByEmail); die();
    
}


require '../../header.php';
?>

<h5 class='text-center ' style='margin-top:100px'> Sie können per Email über jeglichen Kontakt suchen</h5>
<div class='d-flex justify-content-center '>
    <form method="post" action='search.php' style='margin:50px 0' class="form-inline"> 
        <input type="text" name="email" class="form-control mr-sm-2" value="<?=$email;?>">
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
        if (!empty ($getAddressByEmail)){ ?>
            <tr>
                <td>Id</td>
                <td width="100%"><?= $getAddressByEmail->getId() ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td width="100%"><?= $getAddressByEmail->getEmail() ?></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td width="100%"><?= $getAddressByEmail->getFirstname() ?></td>
            </tr>
            <tr>
                <td>Last name</td>
                <td width="100%"><?= $getAddressByEmail->getLastname() ?></td>
            </tr>
            <tr>
                <td>Street</td>
                <td width="100%"><?= $getAddressByEmail->getStreet() ?></td>
            </tr>
            <tr>
                <td>Zip</td>
                <td width="100%"><?= $getAddressByEmail->getZip() ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td width="100%"><?= $getAddressByEmail->getCity() ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td width="100%"><?= $getAddressByEmail->getCountry() ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td width="100%"><?= $getAddressByEmail->getPhone() ?></td>
            </tr>
            <tr>
                <td>Fax</td>
                <td width="100%"><?= $getAddressByEmail->getFax() ?></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td width="100%"><?= $getAddressByEmail->getMobile() ?></td>
            </tr>
            <tr>
                <td>Internet</td>
                <td width="100%"><?= $getAddressByEmail->getInternet() ?></td>
            </tr>
            <tr>
                <td>Company</td>
                <td width="100%"><?= $getAddressByEmail->getCompany() ?></td>
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