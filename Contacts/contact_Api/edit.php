<?php
require '../../include.php';

$id = $_GET['id'];

$AddressDao = ContactDb::getInstance();
$view_contact = $AddressDao->GetAddressByid($id);//view value in fields by get

//echo '<pre>';print_r($view_contact);die;
if (isset($_POST['submit_edit'])) {
    $contact = new Contact();
    
    $contact->setId($id);
    $contact->setEmail($_POST['email']);
    $contact->setFirstname($_POST['firstname']);
    $contact->setLastname($_POST['lastname']);
    $contact->setStreet($_POST['street']);
    $contact->setZip($_POST['zip']);
    $contact->setCity($_POST['city']);
    $contact->setCountry($_POST['country']);
    $contact->setPhone($_POST['phone']);
    $contact->setFax($_POST['fax']);
    $contact->setMobile($_POST['mobile']);
    $contact->setInternet($_POST['internet']);
    $contact->setCompany($_POST['company']);

    $contactService = new ContactService($api);

    $ok = $contactService->save($contact);

        echo 'Die Adresse wurde gespeichert.';
        header('Refresh: 1; index.php');
        exit;
}

require '../../header.php';
?>
<div class="d-flex justify-content-center mt-4 mb-4">
    <form method="post" action='edit.php?id=<?=$id;?>'>
        <h3>Sie können Ihre Daten änadern.</h3><br /><br />
        <div class="form-group" >
            <label >Email address</label>
            <input type="email" class="form-control col-sm-9" name="email" value="<?= $view_contact->getEmail();?>">
            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label>your First Name</label>
            <input type="text" class="form-control col-sm-9" name="firstname" value="<?=$view_contact->getFirstname();?>"/>
        </div>
        <div class="form-group">
            <label>Last First Name</label>
            <input type="text" class="form-control col-sm-9" name="lastname" value="<?=$view_contact->getLastname();?>"/>
        </div>
        <div class="form-group">
            <label>The Street</label>
            <input type="text" class="form-control col-sm-9" name="street" value="<?=$view_contact->getStreet();?>"/>
        </div>
        <div class="form-group">
            <label>The Zip</label>
            <input type="text" class="form-control col-sm-9" name="zip" value="<?=$view_contact->getZip();?>"/>
        </div>
        <div class="form-group">
            <label>The city</label>
            <input type="text" class="form-control col-sm-9" name="city" value="<?=$view_contact->getCity();?>"/>
        </div>
        <div class="form-group">
            <label>The Country</label>
            <input type="text" class="form-control col-sm-9" name="country" value="<?=$view_contact->getCountry();?>"/>
        </div>
        <div class="form-group">
            <label>Telefon</label>
            <input type="number" class="form-control col-sm-9" name="phone" value="<?=$view_contact->getPhone();?>"/>
        </div>
        <div class="form-group">
            <label>The Fax</label>
            <input type="text" class="form-control col-sm-9" name="fax" value="<?=$view_contact->getFax();?>"/>
        </div>
        <div class="form-group">
            <label>The Mobile</label>
            <input type="text" class="form-control col-sm-9" name="mobile" value="<?=$view_contact->getMobile();?>"/>
        </div>
        <div class="form-group">
            <label>The Internet</label>
            <input type="text" class="form-control col-sm-9" name="internet" value="<?=$view_contact->getInternet();?>"/>
        </div>
        <div class="form-group">
            <label> The Company</label>
            <input type="text" class="form-control col-sm-9" name="company" value="<?=$view_contact->getCompany();?>"/>
        </div>

        <input type="submit" class="btn btn-primary" name="submit_edit" value="Save" />
        <a class='btn  btn-danger' href='index.php'><i class='fa fa-arrow-left' ></i> Zurück</a>
    </form>
</div>


<?php

require '../../footer.php';