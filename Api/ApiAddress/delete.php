<?php

require '../../include.php';
$apiaddress= new ApiAddress2($url, $username, $password);


$id = $_GET['id'];
// INIT
$xml = $apiaddress->getAddressById($id);

if (!$xml) {
    // TODO: $feedback = ...
    $feedback = $apiaddress->getLastErrorMessage();
}

$email = $xml->data->address->email;

// POST

if (isset($_POST['submit_delete'])) {

    $xml = $api->deleteAddress($id);

    if ($xml) {
        header("Location: index.php");
        exit;
    }

    echo 'Adresse konnte nicht gelöscht werden.';
    $feedback = $api->getLastErrorMessage();
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