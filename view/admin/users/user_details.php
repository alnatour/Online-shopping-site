<?php

require '../../../config.php';

// INIT

$id = $_GET['id'];

try {
    $AddressDao = RegisterRepository::getInstance();
    $contact = $AddressDao->findById($id );

    //echo '<pre>' ; print_r($GetAddressByid->getEmail());die();
    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '..//errors.log');
        die();
    }


require (ROOT_PATH . '/view/elements/head_section.php');
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
                <td>Frist Name</td>
                <td><?= $contact->getFirstname(); ?></td>
            </tr>
            <tr> 
                <td>Last Name</td>
                <td><?= $contact->getLastname(); ?></td>
            </tr>
            <tr> 
                <td>E-Mail</td>
                <td><?= $contact->getEmail(); ?></td>
            </tr>
            <tr> 
                <td>Phone</td>
                <td><?= $contact->getPhone(); ?></td>
            </tr>
            <tr> 
                <td>E-Mail</td>
                <td><?= $contact->getPassword(); ?></td>
            </tr>

        </tbody>
     </table>

    <br>

    <div>
        <a class='action btn btn-success' href="<?php echo BASE_URL . 'view/admin/users/users_update.php?id='?><?= $id; ?>"><i class="far fa-edit"></i> Edit</a>
        <a class='action btn btn-danger' href='<?php echo BASE_URL . 'view/admin/users/users_delete.php?id='?><?= $id; ?>'><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        <a class='btn  btn-secondary' href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>"><i class='fa fa-arrow-left' ></i> Zurück</a>
    </div>    
 </div>

<br /><br /><br />

<?php include(ROOT_PATH . '/view/elements/footer.php') ?>