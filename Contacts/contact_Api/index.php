<?php

require '../../include.php';

// INIT

$Search = '';
if (isset($_POST['Search'])) {
    $Search = trim($_POST['Search']);
}

$PageSize = 3;

if(!isset($_GET['page']))
{
    $page = 1;
}else{
    $page =$_GET['page'];
}


try {

    $AddressDao = ContactDb::getInstance();

    $total = $AddressDao->CountAllAddress($Search);
    $PageCount = ceil($total/$PageSize);

    $addresses = $AddressDao->GetAllAddress($page, $PageSize, $Search);

    //echo '<pre>'; print_r($addresses); die();

} catch (PDOException $e) {
    $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
    error_log($message, 3, '..//errors.log');
    die();
}

require '../../header.php';

?>


<div class="parallax-contact"></div>
<div class="parallax-contact">

<div class="container table-responsive" style="background-color:#fff">
    <div class="table-wrapper mt-4 mb-0">  

        <div class="table-title">
            <div class="row">
                <div class="col">
                    <h2>Kontakte <b> verwalten</b></h2>
                </div>
                <div class="col">
                        <div>
                            <form method="post" action="index.php" class="form-inline"> 
                                <input type="text" name="Search" class="form-control mr-sm-0" value="<?=$Search;?>">
                                <input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-1" />
                            </form>
                        </div>		
                </div>
                <div class="col">
                <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
                    <a href="insert_new_address.php" class="btn btn-success btn-md" ><i class="fa fa-plus-circle"></i><span>Add New</span></a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        <span class="custom-checkbox">
                            <input type="checkbox" onclick="toggle(this);" >
                            <label for="selectAll"></label>
                        </span>
                        <a href="#" class="btn btn-outline-danger remove btn-sm" id="myDIV">Remove All</a>
                    </th>
                    <th >Vorname</th>
                    <th>Nachname</th>
                    <th>Email</th>
                    <th class='hidden'>Phone</th>
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
                    <th width="100%" style="text-align:right;">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php foreach ($addresses as $contact) { ?>

                    <td>
                        <span class="custom-checkbox">
                            <input type="checkbox" value="">
                            <label for="checkbox1"></label>
                        </span>
                    </td>
                    <td><?= $contact->getFirstname(); ?></td>
                    <td><?= $contact->getLastname(); ?></td>
                    <td><?= $contact->getEmail(); ?></td>
                    <td class='hidden'><?= $contact->getPhone();?></td>
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
                    <td style="white-space:nowrap;" align="right" width="100%">
                        <a href="view_one_address.php?id=<?= $contact->getId(); ?>" ><i class="material-icons text-info" title="View">&#xe0ba;</i></a>
                        <a href="edit.php?id=<?= $contact->getId(); ?>" ><i class="material-icons text-warning" title="Edit">&#xE254;</i></a>
                        <a href="delete.php?id=<?= $contact->getId(); ?>"  ><i class="material-icons text-danger" title="Delete">&#xE872;</i></a>
                    </td>
                    <?php } ?>
                </tr>

                    <?php } ?>
            </tbody>
        </table>

        <?php
        include_once ('../../pages.php');
        ?>
        
        </div>
	</div>
</div>


<div class="parallax-contact"></div>


<script>
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
        
        var element = document.getElementById("myDIV");
        element.classList.toggle("remove");
    }
</script>


 <?php
require '../../footer.php';
