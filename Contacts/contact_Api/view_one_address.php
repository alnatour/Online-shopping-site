<?php

require '../../include.php';

// INIT

$id = $_GET['id'];

try {
    $AddressDao = ContactDb::getInstance();
    $contact = $AddressDao->GetAddressByid($id);

    //echo '<pre>' ; print_r($GetAddressByid->getEmail());die();
    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '..//errors.log');
        die();
    }


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
            <?php foreach($contact->getAsArray() as $field => $value) {
            ?>
            <tr>
                <td><?= $field; ?></td>
                <td width="100%"><?= $value; ?></td>
            </tr>
            <?php  }?>
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