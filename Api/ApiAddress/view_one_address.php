<?php

require '../../include.php';

// INIT

$id = $_GET['id'];

//fields submit
$data = false;
$email = '';
$firstname='';
$lastname = '';
$telefon = '';
$erfolgreich='';

$xml = $api->getAddressById($id);
$emailDb = $xml->data->address->email;
$firstnameDb = $xml->data->address->firstname;
$lastnameDb = $xml->data->address->lastname;
$telefonDb = $xml->data->address->phone;
require '../../header.php';
?>
<br /><br /><br />
<div class="container ">
    <table class="table" style=" margin-right:50px;">
        <thead class="thead-dark">
            <tr>
                <th>Field</th> 
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>E-Mail</td>
                <td width="100%"><?= $emailDb; ?></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td width="100%"><?= $firstnameDb; ?></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td width="100%"><?= $lastnameDb; ?></td>
            </tr>
            <tr>
                <td>Phone>
                <td width="100%"><?= $telefonDb; ?></td>
            </tr>
        </tbody>
     </table>

    <br>

    <div>
        <a class='action btn btn-success' href="edit.php?id=<?= $id; ?>"><i class="far fa-edit"></i> Edit</a>
        <a class='action btn btn-danger' href='delete.php?id=<?= $id; ?>'><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        <a class='btn  btn-secondary' href='index.php'><i class='fa fa-arrow-left' ></i> Zurück</a>
    </div>    
 </div>

<br /><br /><br />
<?php

require '../../footer.php';