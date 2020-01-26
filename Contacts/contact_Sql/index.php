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


// Database user
$UsersDb = RegisterRepository::getInstance();
$total = $UsersDb->CountAllUsers();
$PageCount = ceil($total/$PageSize);

$Users = $UsersDb->GetAllUsers($page, $PageSize, $Search);



require '../../header.php';

?>


<div class="parallax-contact"></div>


<div class="parallax-contact">

<div class="container table-responsive" style="background-color:#fff">
    <div class="table-wrapper" >  
        <div class="table-title mt-4">
            <div class="row" >
                    <div class="col">
                        <h4>Users in Database <b> verwalten</b></h4>
                    </div>
                    <div class="col">
                        <form method="post" action="Contact_from_db.php" class="form-inline"> 
                            <input type="text" name="Search" class="form-control mr-sm-0" value="<?=$Search;?>">
                            <input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-1" />
                        </form>
                    </div>
                    <div class="col">
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
                        <a href="insert_new_address.php" class="btn btn-success btn-md" ><i class="fa fa-plus-circle"></i><span>Add New</span></a>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th >First Name</th>
                    <th>Last Name</th>
                    <th>E-Mail</th>
                    <th class='hidden'>Phone</th>
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
                    <th width="100%" style="text-align:right;">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php foreach ($Users as $user) { ?>

                    <td><?= $user->getFirstname(); ?></td>
                    <td><?= $user->getLastname(); ?></td>
                    <td><?= $user->getEmail(); ?></td>
                    <td class='hidden'><?= $user->getPhone();?></td>

                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 3 )) { ?>
                    <td style="white-space:nowrap;" align="right" width="100%">
                        <a href="view_one_address.php?id=<?= $user->getId(); ?>" ><i class="material-icons text-info" title="View">&#xe0ba;</i></a>
                        <a href="edit.php?id=<?= $user->getId(); ?>"  ><i class="material-icons text-warning" title="Edit">&#xE254;</i></a>
                        <a href="delete.php?id=<?= $user->getId(); ?>"  ><i class="material-icons text-danger" title="Delete">&#xE872;</i></a>
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



<div class="parallax-contact"></div>

 <?php
require '../../footer.php';
