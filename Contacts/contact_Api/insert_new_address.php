<?php
require '../../include.php';

//fields submit
$data = false;

if (isset($_POST['submit_insert'])) {

    $contact = new Contact();
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

    if ($ok) {
        $feedback = 'Kontakt gespeichert.';
    } else {
        $feedback = $contactService->getLastError();
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
        <label>The Street</label>
        <input type="text" class="form-control col-sm-9" name="street"/>
    </div>
    <div class="form-group">
        <label>The Zip</label>
        <input type="text" class="form-control col-sm-9" name="zip" />
    </div>
    <div class="form-group">
        <label>The city</label>
        <input type="text" class="form-control col-sm-9" name="city" />
    </div>
    <div class="form-group">
        <label>The Country</label>
        <input type="text" class="form-control col-sm-9" name="country" />
    </div>
    <div class="form-group">
        <label>Telefon</label>
        <input type="number" class="form-control col-sm-9" name="phone" />
    </div>
    <div class="form-group">
        <label>The Fax</label>
        <input type="text" class="form-control col-sm-9" name="fax" />
    </div>
    <div class="form-group">
        <label>The Mobile</label>
        <input type="text" class="form-control col-sm-9" name="mobile" />
    </div>
    <div class="form-group">
        <label>The Internet</label>
        <input type="text" class="form-control col-sm-9" name="internet" />
    </div>
    <div class="form-group">
        <label> The Company</label>
        <input type="text" class="form-control col-sm-9" name="company" />
    </div>


    <input type="submit" class="btn btn-primary" name="submit_insert" value="Save" />
    <a class='btn  btn-danger' href='http://localhost:8888/kontakte_verwalten/index.php'><i class='fa fa-arrow-left' ></i> Zurück</a>
</form>
</div>

<?php

require '../../footer.php';