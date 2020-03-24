<?php
require '../../../config.php';

require (ROOT_PATH . '/controlle/admin/admin_session.php');

$id = $_GET['id'];

$user_db = RegisterRepository::getInstance();
$user_info= $user_db->findById($id);

if (isset($_POST['submit_delete'])) {
    $user = new User();
    $user->setId($id);
    
    $delete_user = $user_db->deleteUser($user);

    if($delete_user){
        $_SESSION['message'] = "The user has been deleted";
        header('location:  '.BASE_URL.'view/admin/users/users_view.php');
        exit;
    }else{
        echo '<br/>';
        $feedback = error_reporting(E_ALL);
    }
}
// GET

require (ROOT_PATH . '/view/elements/head_section.php');
?>
<div class='container text-center' style="background-color:#e6eaeb; border-radius:180px;margin-bottom: 314px; margin-top: 150px" >

    <i class="fa fa-trash mt-4 mb-4" aria-hidden="true" style="color:red; font-size:72px"></i>
    <h4> Wollen Sie &quot;<?=$user_info->getEmail();;?>&quot; wirklich löschen?</h4>

    <form method="post" action='delete.php?id=<?=$id;?>'>
        <input  type="submit" class="btn btn-danger" name="submit_delete" value="Delete" />
        <a class="btn btn-primary" href="<?php echo BASE_URL . 'view/admin/users/users_view.php' ?>">Cancel</a>
    </form>
    <br /> <br />
</div>


<?php include(ROOT_PATH . '/view/elements/footer.php') ?>