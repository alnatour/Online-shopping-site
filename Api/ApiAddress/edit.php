<?php
require '../../include.php';
$apiaddress= new ApiAddress2($url, $username, $password);


$id = $_GET['id'];

//fields submit
$data = false;
$email = '';
$firstname='';
$lastname = '';
$telefon = '';
$erfolgreich='';

$xml = $apiaddress->getAddressById($id);

$emailDb = $xml->data->address->email;
$firstnameDb = $xml->data->address->firstname;
$lastnameDb = $xml->data->address->lastname;
$telefonDb = $xml->data->address->phone;


if (isset($_POST['submit_edit'])) {

    $ApiUser = new ApiUser();
    $ApiUser->setEmail($_POST['email']);
    $ApiUser->setFirstname($_POST['firstname']);
    $ApiUser->setLastname($_POST['lastname']);
    $ApiUser->setPhone($_POST['phone']);

    $xml = $apiaddress->insertAddress($ApiUser);
        if (!$xml) {
            $feedback = $apiaddress->getLastErrorMessage();
            echo 'Die Daten wurden nicht eingegeben';
            
        }else{
            $erfolgreich = 'Die Daten wurden geändert';
            header('Refresh: 2; index.php');
        }
}

require '../../header.php';
?>
<div class="d-flex justify-content-center mt-4 mb-4">
    <form method="post" action='edit.php?id=<?=$id;?>'>
        <h3>Sie können Ihre Daten änadern.</h3><br /><br />
        <div class="form-group" >
            <label >Email address</label>
            <input type="email" class="form-control col-sm-9" name="email" value="<?= $emailDb;?>">
            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label>your First Name</label>
            <input type="text" class="form-control col-sm-9" name="firstname" value="<?=$firstnameDb;?>"/>
        </div>
        <div class="form-group">
            <label>Last First Name</label>
            <input type="text" class="form-control col-sm-9" name="lastname" value="<?=$lastnameDb;?>"/>
        </div>
        <div class="form-group">
            <label>Telefon</label>
            <input type="number" class="form-control col-sm-9" name="phone" value="<?=$telefonDb;?>"/>
        </div>
    

        <input type="submit" class="btn btn-primary" name="submit_edit" value="Save" />
        <a class='btn  btn-danger' href='index.php'><i class='fa fa-arrow-left' ></i> Zurück</a>
    </form>
</div>


<?php

require '../../footer.php';