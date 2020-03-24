<?php

require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');
require (ROOT_PATH . '/controlle/admin/users/users_view.php');
require (ROOT_PATH . '/view/elements/head_section.php');

?>

<div class="parallax-contact"></div>

<div class="parallax-contact">

<div class="container table-responsive" style="background-color:#fff">
    <div class="table-wrapper" > 
        <div>
            <?php include(ROOT_PATH . '/view/elements/messages.php') ?>
        </div> 
        <div class="table-title mt-4">
            <div class="row" >
                    <div class="col">
                        <h4>Users Details</b></h4>
                    </div>
                    <div class="col">
                        <form method="post" action="users_view.php" class="form-inline"> 
                            <input type="text" name="search" class="form-control mr-sm-0" value="<?=$search;?>">
                            <input type="submit" name="submit_search" value="Search" class="btn btn-outline-success btn-rounded btn-sm my-1" />
                        </form>
                    </div>
                    <div class="col">
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' )) { ?>
                        <a href="<?php echo BASE_URL . 'view/admin/users/users_add.php'?>" class="btn btn-success btn-md" ><i class="fa fa-plus-circle"></i><span>Add New</span></a>
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
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' )) { ?>
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

                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' )) { ?>
                    <td style="white-space:nowrap;" align="right" width="100%">
                        <a href="<?php echo BASE_URL . 'view/admin/users/user_details.php?id='?><?= $user->getId(); ?>" ><i class="material-icons text-info" title="View">&#xe0ba;</i></a>
                        <a href="<?php echo BASE_URL . 'view/admin/users/users_update.php?id='?><?= $user->getId(); ?>"  ><i class="material-icons text-warning" title="Edit">&#xE254;</i></a>
                        <a href="<?php echo BASE_URL . 'view/admin/users/users_delete.php?id='?><?= $user->getId(); ?>"  ><i class="material-icons text-danger" title="Delete">&#xE872;</i></a>
                    </td>
                    <?php } ?>
                </tr>

                    <?php } ?>
            </tbody>
        </table>

        <?php include(ROOT_PATH . '/view/elements/pages.php') ?>

	</div>
</div>



<div class="parallax-contact"></div>


<?php include(ROOT_PATH . '/view/elements/footer.php') ?>
