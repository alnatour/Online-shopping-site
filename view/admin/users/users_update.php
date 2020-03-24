<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$id = $_GET['id'];

$User_db = RegisterRepository::getInstance();
$User_info= $User_db->findById($id);

//echo '<pre>';print_r($view_contact);die;
if (isset($_POST['submit_edit'])) {

    $user = new User();
   
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setFirstname($_POST['firstname']);
    $user->setLastname($_POST['lastname']);
    $user->setPhone($_POST['phone']);
    $user->setId($id);
  
    $uptaded = $User_db->editUser($user);

        if ($uptaded){
            $_SESSION['message'] = "The user has been Updated.";
            header('location:  '.BASE_URL.'view/admin/users/users_view.php');
            exit;
        }else{
            echo '<br/>';
            $feedback = error_reporting(E_ALL);
        }
      
}

require (ROOT_PATH . '/view/elements/head_section.php');
?>
<br><br>
<div class="d-flex justify-content-center mt-4 mb-4">
    <form method="post" action='<?php echo BASE_URL . 'view/admin/users/users_update.php?id='?><?=$id;?>'>
        <h3>You can change here your data.</h3><br />
        <div class="form-group" >
            <label >Email address</label>
            <input type="email" class="form-control col-sm-9" name="email" value="<?= $User_info->getEmail();?>">
            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label>your First Name</label>
            <input type="text" class="form-control col-sm-9" name="firstname" value="<?=$User_info->getFirstname();?>"/>
        </div>
        <div class="form-group">
            <label>Last First Name</label>
            <input type="text" class="form-control col-sm-9" name="lastname" value="<?=$User_info->getLastname();?>"/>
        </div>
        <div class="form-group">
            <label>Telefon</label>
            <input type="number" class="form-control col-sm-9" name="phone" value="<?=$User_info->getPhone();?>"/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control col-sm-9" name="password" value="<?=$User_info->getPassword();?>"/>
        </div>


        <input type="submit" class="btn btn-primary" name="submit_edit" value="Save" />
        <a class='btn  btn-danger' href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>"><i class='fa fa-arrow-left' ></i> Back</a>
    </form>
</div>


<?php require (ROOT_PATH . '/view/elements/footer.php') ?>
