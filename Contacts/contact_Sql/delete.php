<?php

require '../../include.php';
if(!isset($_SESSION['user']) )
{	// not logged in
    header('Location: '.BASE_URL.'index.php');
    die();
}
$id = $_GET['id'];

$User_db = RegisterRepository::getInstance();
$User_info= $User_db->findById($id);

if (isset($_POST['submit_delete'])) {
    $user = new User();
    $user->setId($id);
    
    $delete_user = $User_db->deleteUser($user);

    if($delete_user){
        header('Location: index.php');
        exit;
    }else{
        echo '<br/>';
        $feedback = error_reporting(E_ALL);
    }
}
// GET

require '../../header.php';
?>
<div class='container text-center' style="background-color:#e6eaeb; border-radius:180px;margin-bottom: 314px; margin-top: 150px" >

    <i class="fa fa-trash mt-4 mb-4" aria-hidden="true" style="color:red; font-size:72px"></i>
    <h4> Wollen Sie &quot;<?=$User_info->getEmail();;?>&quot; wirklich löschen?</h4>

    <form method="post" action='delete.php?id=<?=$id;?>'>
        <input  type="submit" class="btn btn-danger" name="submit_delete" value="Delete" />
        <a class="btn btn-primary" href="index.php">Cancel</a>
    </form>
    <br /> <br />
</div>


<?php

require '../../footer.php';