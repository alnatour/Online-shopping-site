<?php
require '../../../config.php';
require (ROOT_PATH . '/controlle/admin/admin_session.php');

$newUser = RegisterRepository::getInstance();

//fields submit
$data = false;

if (isset($_POST['submit_insert'])) {

    $user = new User();
    $user->setEmail($_POST['email']);
    $user->setFirstname($_POST['firstname']);
    $user->setLastname($_POST['lastname']);
    $user->setPhone($_POST['phone']);
    $user->setPassword($_POST['password']);


    $SaveNewUser = $newUser->InsertNewUser($user);

    if ($SaveNewUser) {
        $_SESSION['message'] = 'The User has been created.';
        header('Location: '.BASE_URL.'index.php');
    } else {
        $feedback = $contactService->getLastError();
    }
}


require (ROOT_PATH . '/view/elements/head_section.php');
?>

<div class="d-flex justify-content-center mt-4">
<form method="post" action='insert_new_address.php'>
    <h3>You can register new users here.</h3><br /><br />

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
        <label>Telefon</label>
        <input type="number" class="form-control col-sm-9" name="phone" />
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control col-sm-9" name="password" />
    </div>
  


    <input type="submit" class="btn btn-primary" name="submit_insert" value="Save" />
    <a class='btn  btn-danger' href='<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>'><i class='fa fa-arrow-left' ></i> Back</a>
</form>
</div>

<?php include(ROOT_PATH . '/view/elements/footer.php') ?>