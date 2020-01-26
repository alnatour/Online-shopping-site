<?php
require '../../include.php';
$apiaddress= new ApiAddress2($url, $username, $password);

//fields submit
$data = false;
$erfolgreich ='';

if (isset($_POST['submit_insert'])) {
    $ApiUser = new ApiUser();
    $ApiUser->setEmail($_POST['email']);
    $ApiUser->setFirstname($_POST['firstname']);
    $ApiUser->setLastname($_POST['lastname']);
    $ApiUser->setPhone($_POST['phone']);
    // TODO get fields from post
    $validation = $apiaddress->getAddressByEmail($ApiUser);
    if (!$validation){
            $xml = $apiaddress->insertAddress($ApiUser);
            $feedback = 'Die Daten wurden erfolgreich eingegeben';
            header('Refresh: 2; index.php');
        } else {
            $feedback= 'Diese E-Mail '.$ApiUser->getEmail().' ist schon vorhanden';

            }
    }




require '../../header.php';
?>

<div class="d-flex justify-content-center mt-4">
<form method="post" action='insert_new_address.php'>
    <h3>Sie können Ihre Daten hier eingeben.</h3><br /><br />

    <div class="form-group" >
        <label >Email address</label>
        <input type="email" class="form-control col-sm-9" name="email" >
        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label>your First Name</label>
        <input type="text" class="form-control col-sm-9" name="firstname" />
    </div>
    <div class="form-group">
        <label>Last First Name</label>
        <input type="text" class="form-control col-sm-9" name="lastname" />
    </div>
    <div class="form-group">
        <label>Telefon</label>
        <input type="number" class="form-control col-sm-9" name="phone" />
    </div>
 
    <input type="submit" class="btn btn-primary" name="submit_insert" value="Save" />
    <a class='btn  btn-danger' href='index.php'><i class='fa fa-arrow-left' ></i> Zurück</a>
</form>
</div>

<?php

require '../../footer.php';