<?php

require '../../include.php';

$id = $_GET['id'];
// INIT
$AddressDao = AddressDao::getInstance();
$contact = $AddressDao->GetAddressByid($id);//view value in fields by get
$email = $contact->getEmail();
$externalId = $contact->getExternalId();
$ok = false;

 //echo '<pre>'; print_r($contact); die;

if (isset($_POST['submit_delete'])) {
    $contact = new Contact();
    $contact->setId($id);
    $contact->setExternalId($externalId);
    $contactService = new ContactService($api);
    
    $ok = $contactService->delete($contact);

    echo 'wurde gelöscht';
    header('Location: index.php');


}
// GET

require '../../header.php';
?>
<div class='container text-center' style="background-color:#e6eaeb; border-radius:180px;margin-bottom: 314px; margin-top: 150px" >

    <i class="fa fa-trash mt-4 mb-4" aria-hidden="true" style="color:red; font-size:72px"></i>
    <h4> Wollen Sie &quot;<?=$email;?>&quot; wirklich löschen?</h4>

    <form method="post" action='delete.php?id=<?=$id;?>'>
        <input  type="submit" class="btn btn-danger" name="submit_delete" value="Delete" />
        <a class="btn btn-primary" href="index.php">Cancel</a>
    </form>
    <br /> <br />
</div>


<?php

require '../../footer.php';